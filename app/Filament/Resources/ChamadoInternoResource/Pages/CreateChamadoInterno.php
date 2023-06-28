<?php

namespace App\Filament\Resources\ChamadoInternoResource\Pages;

use App\Filament\Resources\ChamadoInternoResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;


class CreateChamadoInterno extends CreateRecord
{
    protected static string $resource = ChamadoInternoResource::class;

    protected function mutateFormDataBeforeCreate( array $data): array
    {
        $data['demandante'] = auth()->user()->name;

        return $data;
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Chamado Interno criado com sucesso!')
            ->body('O usuário ' . auth()->user()->name . ' criou o chamado interno ' . $this->record->titulo . '.');
    }
}
