<?php

namespace App\Filament\Resources\TicketsResource\Pages;

use App\Filament\Resources\TicketsResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;
use App\Models\ChamadoInterno;

class EditTickets extends EditRecord
{
    protected static string $resource = TicketsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public static function view(): string
    {
        return 'resources.tickets.edit';
    }

    public function title(): string
    {
        $motivo_chamado = $this->record->chamadoInterno ? $this->record->chamado_interno->motivo_chamado->descricao : 'N/A';
        return 'Edit ' . $this->record->nr_ticket . ' - ' . $motivo_chamado ;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {

         // Assuming chamadoInterno is a relationship and motivo_chamado is its attribute
        $chamadoInterno = ChamadoInterno::find($data['chamado_interno_id']);
        $data['motivo_chamado_titulo'] = $chamadoInterno ? $chamadoInterno->motivo_chamado->titulo : null;

        return $data;
    }

}
