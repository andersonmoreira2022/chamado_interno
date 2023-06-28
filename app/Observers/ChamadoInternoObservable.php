<?php

namespace App\Observers;

use App\Filament\Resources\ChamadoInternoResource;
use App\Http\Traits\ChamadoInternoRulesTraits;
use App\Models\ChamadoInterno;
use App\Models\ClienteTecnico;

class ChamadoInternoObservable
{
    use ChamadoInternoRulesTraits;
    /**
     * Handle the ChamadoInterno "created" event.
     *
     * @param  \App\Models\ChamadoInterno  $chamadoInterno
     * @return void
     */
    public function created(ChamadoInterno $chamadoInterno)
    {
        $existsClienteTecnico = ClienteTecnico::where('designacao', $chamadoInterno->designacao)->exists();
        
        if($existsClienteTecnico)
            $this->InfoChamadoInternoExists($chamadoInterno->designacao);

        $this->NewNotificationChamadoInterno($chamadoInterno->motivo_chamado->titulo, $chamadoInterno->id);

        if(!is_null(auth()->user()->telefone)){
            $body = "Novo Chamado Interno com título: *".$chamadoInterno->motivo_chamado->titulo."*" . PHP_EOL
                . "Para acompanhar o andamento, acesse o link abaixo: " . PHP_EOL
                . url(ChamadoInternoResource::getUrl('edit', ['record' => $chamadoInterno->id]));

            $this->WhaticketNotification(auth()->user()->telefone, auth()->user()->name, $body);
        }


        # Alterar automaticamente situação do circuito
        if(! is_null($chamadoInterno->motivo_chamado->situacao_inicial) and $existsClienteTecnico) {
            $this->UpdatedSituacaoCircuito(
                $chamadoInterno->designacao,
                $chamadoInterno->motivo_chamado->situacao_inicial->situacao
            );
        }

        # Quando aberto um Chamado realizar comentário Inicial.
        if($chamadoInterno->status == 'Novo' and $existsClienteTecnico){
            $this->InsertLogClienteTecnico(
                $chamadoInterno->designacao,
                $chamadoInterno->motivo_chamado->situacao_inicial->situacao,
                $chamadoInterno->motivo_chamado->comentario_inicial . PHP_EOL .
                "Para acompanhar o andamento, acesse o link abaixo: " . PHP_EOL .
                url(ChamadoInternoResource::getUrl('edit', ['record' => $chamadoInterno->id]))
            );

        }
    }

    /**
     * Handle the ChamadoInterno "updated" event.
     *
     * @param  \App\Models\ChamadoInterno  $chamadoInterno
     * @return void
     */
    public function updated(ChamadoInterno $chamadoInterno)
    {
        # Se status fechado altera situação do Circuito
        if(($chamadoInterno->status == 'Fechado') and ($chamadoInterno->getOriginal()['status'] != 'Fechado')) {
            if(! is_null($chamadoInterno->motivo_chamado->situacao_final) and !is_null($chamadoInterno->designacao))
            {
                $this->UpdatedSituacaoCircuito(
                    $chamadoInterno->designacao,
                    $chamadoInterno->motivo_chamado->situacao_final->situacao
                );
                # Quando fechado o Chamado realizar o comentário Final.
                $this->InsertLogClienteTecnico(
                    $chamadoInterno->designacao,
                    $chamadoInterno->motivo_chamado->situacao_final->situacao,
                    $chamadoInterno->motivo_chamado->comentario_final. PHP_EOL .
                    "Para acompanhar o andamento, acesse o link abaixo: " . PHP_EOL .
                    url(ChamadoInternoResource::getUrl('edit', ['record' => $chamadoInterno->id]))
                );
            }
        }

        if($chamadoInterno->status == 'Cancelado' and $chamadoInterno->getOriginal()['status'] != 'Cancelado') {
            if(! is_null($chamadoInterno->motivo_chamado->situacao_inicial) and !is_null($chamadoInterno->designacao))
            {
                $this->UpdatedSituacaoCircuito($chamadoInterno->designacao, 'Ativo');

                # Quando Cancelado o Chamado realizar comentário avisando que chamado foi cancelado.
                $this->InsertLogClienteTecnico(
                    $chamadoInterno->designacao,
                    'Ativo',
                    'Cancelamento do chamado interno.'. PHP_EOL .
                    "Para acompanhar o andamento, acesse o link abaixo: " . PHP_EOL .
                    url(ChamadoInternoResource::getUrl('edit', ['record' => $chamadoInterno->id]))
                );
            }
        }
    }
}
