<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Toggle;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;
use Filament\Forms\Components\TextInput;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', true)->count();
    }

    protected static ?string $navigationGroup = 'Administrador';

//    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->columnSpan('full')
                    ->image()
                    ->avatar(),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Toggle::make('status')
                    ->required(),

                Forms\Components\Select::make('setor_id')
                    ->relationship('setor', 'setor')
                    ->required()
                    ->preload(),

                Toggle::make('is_admin'),

                CheckboxList::make('roles')
                    ->relationship('roles', 'name')
                    ->columns(2)
                    ->helperText('Escolhe somente uma opção')
                    ->required(),

                TextInput::make('telefone')
                    ->label('WhatsApp')
                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('+{55}(00)00000-0000'))

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Endereço copiado')
                    ->copyMessageDuration(1500)
                    ->searchable(),

                Tables\Columns\BooleanColumn::make('is_admin')
                    ->label('Administrador')
                    ->sortable(),

                Tables\Columns\TextColumn::make('roles.name')->sortable()
                    ->label('Roles')
                    ->sortable()
                    ->searchable(),


                Tables\Columns\ToggleColumn::make('status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Cadastro')
                    ->sortable()
                    ->dateTime('d/m/y H:i'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:i'),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                TernaryFilter::make('status')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
       return[
           RolesRelationManager::class
       ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }

}
