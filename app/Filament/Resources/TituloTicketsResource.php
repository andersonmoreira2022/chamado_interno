<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TituloTicketsResource\Pages;
use App\Filament\Resources\TituloTicketsResource\RelationManagers;
use App\Models\TituloTickets;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TituloTicketsResource extends Resource
{
    protected static ?string $model = TituloTickets::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Administrador';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titulo')
                    ->label('Atividade')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),

                Forms\Components\Select::make('setor_id')
                    ->label('Setor')
                    ->required()
                    ->relationship('setor', 'setor')
                    ->columnSpanFull()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titulo')
                    ->label('Atividade')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('setor.setor')
                    ->label('Setor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTituloTickets::route('/'),
        ];
    }
}
