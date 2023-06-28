<?php

namespace App\Filament\Resources\ChamadoInternoResource\Pages;

use App\Filament\Resources\ChamadoInternoResource;
use App\Models\MotivoChamado;
use App\Policies\MotivoPolicy;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditChamadoInterno extends EditRecord
{
    protected static string $resource = ChamadoInternoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {

        // Assuming chamadoInterno is a relationship and motivo_chamado is its attribute
        $motivo = MotivoChamado::find($data['motivo_chamados_id']);
        $data['motivo_chamado_titulo'] = $motivo ? $motivo->titulo : "nenhum";

        return $data;
    }

}
