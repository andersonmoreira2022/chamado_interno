<?php

namespace App\Filament\Resources\TicketsResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class ComentarioTicketsRelationManager extends RelationManager
{
    protected static string $relationship = 'comentario_tickets';

    protected static ?string $recordTitleAttribute = 'comentario';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('comentario')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comentario')
                    ->label('Comentário')
                    ->limit(100)
                    ->tooltip(fn($record) : string => strip_tags($record->comentario))
                    ->getStateUsing(fn($record) : string => strip_tags($record->comentario))
                    ->disabled(function ($record) {
                        return $record && $record->exists; // fica disabilitado após salvar
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data de criação')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/y H:i')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Criar'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
