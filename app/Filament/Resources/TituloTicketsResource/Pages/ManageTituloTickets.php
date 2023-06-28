<?php

namespace App\Filament\Resources\TituloTicketsResource\Pages;

use App\Filament\Resources\TituloTicketsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTituloTickets extends ManageRecords
{
    protected static string $resource = TituloTicketsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [25, 50, 100];
    }
}
