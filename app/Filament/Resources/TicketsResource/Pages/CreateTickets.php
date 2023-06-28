<?php

namespace App\Filament\Resources\TicketsResource\Pages;

use App\Filament\Resources\TicketsResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;

class CreateTickets extends CreateRecord
{
    protected static string $resource = TicketsResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Ticket criado com sucesso!')
            ->body('O usuário ' . auth()->user()->name . ' criou o ticket ' . $this->record->titulo . '.');
    }
}
