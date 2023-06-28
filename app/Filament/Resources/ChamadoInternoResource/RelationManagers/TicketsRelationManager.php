<?php

namespace App\Filament\Resources\ChamadoInternoResource\RelationManagers;

use App\Filament\Resources\TicketsResource;
use App\Models\MotivoChamado;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;

class TicketsRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets';

    protected static ?string $recordTitleAttribute = 'nr_ticket';

    public static function form(Form $form): Form
    {
        return TicketsResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('users.foto')
                    ->label('')
                    ->circular()
                    ->tooltip(fn($record) : string => $record->users->name ?? ''),

                Tables\Columns\TextColumn::make('setor.setor')
                    ->label('Setor')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nr_ticket')
                    ->label('N° Ticket')
                    ->sortable()
                    ->searchable(),

                // Tables\Columns\TextColumn::make('titulo_tickets.titulo')
                //     ->label('Título')
                //     ->limit(40)
                //     ->sortable()
                //     ->searchable(),
                
                Tables\Columns\TextColumn::make('mensagem')
                    ->label('Mensagem')
                    ->limit(40)
                    ->tooltip(fn($record) : string => strip_tags($record->mensagem))
                    ->getStateUsing(function ($record) {
                        $message = strip_tags($record->mensagem);
                        return strlen($message) > 45 ? substr($message, 0, 35) . '...' : $message;
                    }),

                Tables\Columns\TextColumn::make('empresa')
                    ->label('Empresa')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'Atendimento',
                        'secondary' => 'Fechado',
                        'warning' => 'Validação',
                        'success' => 'Novo'
                    ])
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('data_leitura')
                    ->label('Data da leitura')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('data_fechamento')
                    ->label('Data do fechamento')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('criado_por_usuario')
                    ->label('Criado por')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort( 'id', 'desc')

            ->filters([
                Filter::make('user_id')
                    ->label('Meus Tickets')
                    ->query(fn (Builder $query) : Builder =>
                    $query->where('user_id', auth()->user()->id)),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nr_ticket'];
    }
}
