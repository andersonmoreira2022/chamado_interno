<?php

declare(strict_types=1);

namespace App\Http\Traits;

use App\Filament\Resources\TicketsResource;
use App\Models\ChamadoInterno;
use App\Models\Ticket;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait TicketsRulesTraits
{

    public function NewNotificationTicket(string $titulo, int $id):void
    {
        Notification::make()
            ->title('Novo Ticket')
            ->icon('heroicon-o-sparkles')
            ->body("** Nr.: {$titulo}.**")
            ->actions([Action::make('Visualizar')->url(TicketsResource::getUrl('edit', ['record' => $id]))])
            ->sendToDatabase(auth()->user());
    }

    public function SerialTicket():string
    {
        return 'SIT' . str_pad( (string)Ticket::count(), 5 ,'0', STR_PAD_LEFT). date('y');
    }

    public function CloseChamadoInternoWhenAllTicketsClosed(int $chamado_interno_id):void
    {
        $verificaStatusFechadoTicket = Ticket::where("chamado_interno_id", $chamado_interno_id)
                                                ->where("status", "!=", "Fechado")
                                                ->count();

        $chamado_interno = ChamadoInterno::find($chamado_interno_id);

        if($verificaStatusFechadoTicket === 0){
            $chamado_interno->status = 'Fechado';
            $chamado_interno->save();
        }else{
            $chamado_interno->status = 'Atendimento';
            $chamado_interno->save();
        }
    }

    public function ChangedStatusChamadoInternoWhenStatusTicketIsAtendimento(int $chamado_interno_id):void
    {
        $verificaStatusChamadoInterno = ChamadoInterno::find($chamado_interno_id);

        if($verificaStatusChamadoInterno->status === 'Novo'){
            $chamado_interno = ChamadoInterno::find($chamado_interno_id);
            $chamado_interno->status = 'Atendimento';
            $chamado_interno->save();
        }
    }

    public function WhaticketNotification(int $user_id, string $body):string
    {
       $ticket_user = User::find($user_id);

        if(is_null($ticket_user->telefone))
            return 'Telefone não informado';

        Log::info(
            ' number=>' . $ticket_user->telefone .
            ' name=>'            . $ticket_user->name .
            ' body=>'            . $body );

        $response = Http::withHeaders([
            'Authorization' => 'Bearer 4f52b62d-712d-421b-967a-b5f6da32123e',
            'Content-Type' => 'application/json'
        ])->post("https://zapapi.sitelbra.net/api/messages/send", [
            'number' => $ticket_user->telefone,
            'name'   => $ticket_user->name,
            'body'   => $body
        ]);

        Log::info('Response Status Code: ' . $response->getStatusCode());     

        Log::info(' Response Body: ' . $response->body());

        if($response->successful()) {
            Log::info('Mensagem enviada com sucesso');
            return 'Mensagem enviada com sucesso';
        } else {
            Log::info('Mensagem enviada com sucesso');

            return 'Erro ao enviar mensagem';
        }
    }

}
