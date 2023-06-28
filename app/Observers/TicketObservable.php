<?php

namespace App\Observers;

use App\Filament\Resources\TicketsResource;
use App\Models\Setor;
use App\Models\Ticket;
use \App\Http\Traits\TicketsRulesTraits;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class TicketObservable
{
    use TicketsRulesTraits;

    /**
     * @param Ticket $ticket
     * @return void
     */
    public function creating(Ticket $ticket)
    {
        $ticket->nr_ticket  = $this->SerialTicket();
        $ticket->criado_por_usuario = auth()->user()->name;
    }

    public function created(Ticket $ticket)
    {
        $this->NewNotificationTicket($ticket->nr_ticket, $ticket->id);

        $user                           = User::find($ticket->user_id);
        $chamado_interno                = $ticket->chamado_interno;
        $titulo_chamado                 = $ticket->chamado_interno->motivo_chamado->titulo;


        Log::info("entrou aqui");

        if($ticket->user_id){
            $body = "Olá, {$user->name}! ".PHP_EOL.
                "Um novo ticket no chamado *{$chamado_interno->id} - {$titulo_chamado}*, foi aberto com sucesso.".PHP_EOL.
                "Nº: {$ticket->nr_ticket}".PHP_EOL.
                "Para acompanhar o andamento, acesse o link abaixo: ".PHP_EOL.
                url(TicketsResource::getUrl('edit', ['record' => $ticket->id]));

            if(!is_null($user->telefone)) {
                Log::info("Enviar mensagem!");
                $this->WhaticketNotification($ticket->user_id, $body);
            }
        } else {
            //enviar para todas as pessoas do setor
            $setor = $ticket->setor_id;
            $users = User::where('setor_id', $setor)->get();
            foreach( $users as $user){
                $body = "Olá, {$user->name}! ".PHP_EOL.
                    "Um novo ticket no chamado *{$chamado_interno->id} - {$titulo_chamado}*, foi aberto com sucesso.".PHP_EOL.
                    "Nº: {$ticket->nr_ticket}".PHP_EOL.
                    "Para acompanhar o andamento, acesse o link abaixo: ".PHP_EOL.
                    url(TicketsResource::getUrl('edit', ['record' => $ticket->id]));

                if(!is_null($user->telefone)) {
                    Log::info("Enviar mensagem!");
                    $this->WhaticketNotification($user->id, $body);
                }
            }
        }
    }

    /**
     * @param Ticket $ticket
     * @return void
     */
    public function updating(Ticket $ticket){

        if($ticket->status === 'Atendimento' && is_null($ticket->data_atendimento))
            $ticket->data_leitura = date('Y-m-d H:i:s');

        if($ticket->status === 'Fechado' &&  is_null($ticket->data_fechamento))
            $ticket->data_fechamento = date('Y-m-d H:i:s');

    }

    public function updated(Ticket $ticket)
    {
        if($ticket->status === 'Atendimento')
            $this->ChangedStatusChamadoInternoWhenStatusTicketIsAtendimento($ticket->chamado_interno_id);


        if($ticket->status === 'Fechado')
            $this->CloseChamadoInternoWhenAllTicketsClosed($ticket->chamado_interno_id);

    }
}
