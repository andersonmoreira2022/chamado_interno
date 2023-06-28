<?php

namespace App\Filament\Resources\ChamadoInternoResource\Pages;

use App\Filament\Resources\ChamadoInternoResource;
use App\Models\Ticket;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListChamadoInternos extends ListRecords
{
    protected static string $resource = ChamadoInternoResource::class;

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
