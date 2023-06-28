<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotivoChamadoResource\Pages;
use App\Filament\Resources\MotivoChamadoResource\RelationManagers;
use App\Models\MotivoChamado;
use App\Models\situacaoCircuito;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

class MotivoChamadoResource extends Resource
{
    protected static ?string $model = MotivoChamado::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Administrador';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titulo')
                    ->required()
                    ->columnSpanFull(),

                    Select::make('situacao_inicial_id')
                    ->label('Situação Inícial')
                    ->options(situacaoCircuito::all()->pluck('situacao', 'id'))
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('comentario_inicial')
                    ->label('Comentário Inicial')
                    ->maxLength(255)
                    ->columnSpanFull(),

                    Select::make('situacao_final_id')
                    ->label('Situação Final')
                    ->options(situacaoCircuito::all()->pluck('situacao', 'id'))
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('comentario_final')
                    ->label('Comentário Final')
                    ->maxLength(255)
                    ->columnSpanFull(),

                    Forms\Components\Textarea::make('descricao')
                        ->label('Descrição')
                        ->maxLength(255)
                        ->required()
                        ->columnSpanFull(),

            // Add a Toggle component for the inativo field
            Forms\Components\Toggle::make('inativo')
                ->label('Inativo')
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titulo')
                    ->label('Título'),

                Tables\Columns\TextColumn::make('descricao')
                    ->label('Descrição')
                    ->tooltip(fn($record) : string => strip_tags($record->descricao))
                    ->getStateUsing(fn($record) : string => strip_tags($record->descricao))
                    ->limit(30),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
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
            'index' => Pages\ManageMotivoChamados::route('/'),
        ];
    }
}
