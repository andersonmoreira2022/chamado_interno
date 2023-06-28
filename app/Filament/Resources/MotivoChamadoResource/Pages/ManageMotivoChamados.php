<?php

namespace App\Filament\Resources\MotivoChamadoResource\Pages;

use App\Filament\Resources\MotivoChamadoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMotivoChamados extends ManageRecords
{
    protected static string $resource = MotivoChamadoResource::class;

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
