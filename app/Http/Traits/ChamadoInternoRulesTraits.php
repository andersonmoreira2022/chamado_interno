<?php

declare(strict_types=1);

namespace App\Http\Traits;

use App\Filament\Resources\ChamadoInternoResource;
use App\Models\ClienteTecnico;
use App\Models\LogClienteTecnico;
use Carbon\Carbon;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;

trait ChamadoInternoRulesTraits
{
    public function NewNotificationChamadoInterno(string $titulo, int $id):void
    {
        Notification::make()
            ->title('Novo chamado interno')
            ->icon('heroicon-o-sparkles')
            ->body("**Titulo: {$titulo}.**")
            ->actions([
                Action::make('Visualizar')
                    ->url(ChamadoInternoResource::getUrl('edit', ['record' => $id]))
            ])
            ->sendToDatabase(auth()->user());
    }

    public function InfoChamadoInternoExists(String $designacao):void
    {
        /**
         * Existir chamadointerno informar na tabela cliente_tecnicos a coluna btn_existe_chamadointerno
         */
        if(!is_null($designacao))
            ClienteTecnico::where('designacao', $designacao)->update(['btn_existe_chamadointerno' => true]);
    }

    public function InsertLogClienteTecnico(String $designacao, String $situacao, String $comentario):void
    {
        LogClienteTecnico::create(
            [
                'usuario'           => auth()->user()->name,
                'avatar'            => auth()->user()->foto,
                'designacao'        => $designacao,
                'situacao'          => $situacao,
                'comentario'        => $comentario,
                'data_abertura'     => new Carbon(date('Y-m-d H:i:s')),
                'created_at'        => new Carbon(date('Y-m-d H:i:s'))
            ]
        );
    }

    public function UpdatedSituacaoCircuito(string $designacao, String $situacao):void
    {
        ClienteTecnico::where('designacao', $designacao)->update(['situacao' => $situacao]);
    }

    public function WhaticketNotification(string $whatsapp, string $author, string $body):string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 4f52b62d-712d-421b-967a-b5f6da32123e',
            'Content-Type' => 'application/json'
        ])->post("https://zapapi.sitelbra.net/api/messages/send", [
            'number' => $whatsapp,
            'name'   => $author,
            'body'   => $body
        ]);

        if($response->getStatusCode() === 200)
            return 'Mensagem enviada com sucesso';
        else
            return 'Erro ao enviar mensagem';
    }
}
