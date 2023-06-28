<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChamadoInternoResource\Pages;
use App\Filament\Resources\ChamadoInternoResource\RelationManagers;
use App\Models\ChamadoInterno;
use App\Models\ClienteTecnico;
use App\Models\MotivoChamado;
use App\Models\Ticket;
use App\Models\Setor;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Str;


class ChamadoInternoResource extends Resource
{
    protected static ?string $model = ChamadoInterno::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $recordTitleAttribute = 'id';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationGroup = 'Chamados';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('motivo_chamados_id')
                    ->label('Motivo')
                    ->options(MotivoChamado::where('inativo', 0)->orderBy('titulo', 'asc')->pluck('titulo', 'id'))
                    ->searchable()
                    ->columnSpanFull()
                    ->required(),


                RichEditor::make('descricao')
                    ->label('Descrição')
                    ->columnSpan('full')
                    ->disabled(function ($record) {
                        return $record && $record->exists; // fica desabilitado após salvar
                    })
                    ->required(),

                TextInput::make('demandante')
                    ->label('Demandante')
                    ->hidden(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Novo'              => 'Novo',
                        'Cancelado'         => 'Cancelado'
                    ])
                    ->default('Novo')
                    ->rules([
                        function ($get) {
                            return function (string $attribute, $value, Closure $fail) use ($get) {

                                if($value == 'Fechado'){
                                    $verificaStatusFechadoTicket = Ticket::where("chamado_interno_id", $get('id'))
                                        ->where("status", "not like", "%Fechado%")
                                        ->count();

                                    if($verificaStatusFechadoTicket >= 1)
                                        $fail("Existe ticket aberto para este chamado.");
                                }
                            };
                        },
                    ])
                    ->visible(function ($record) {
                        return $record && $record->exists; // Only show if it's an existing record
                    })
                    ->columnSpanFull(),

                TextInput::make('designacao')
                    ->label('Designação')
                    ->rules([
                        function ($get) {
                            return function (string $attribute, $value, Closure $fail) use ($get) {

                                // check if the 'designacao' value exists in 'cliente_tecnicos' table
                                $exists = ClienteTecnico::where('designacao', $get('designacao'))->exists();

                                if (!$exists) {
                                    $fail("A designação informada não existe no sextafeira!");
                                }

                                $designacao = ChamadoInterno::where('designacao', $get('designacao'))
                                    ->where('motivo_chamados_id', $get('motivo_chamados_id'))
                                    ->whereNotIn('status', ['Fechado', 'Cancelado'])
                                    ->count();

                                if ($designacao > 1)
                                    $fail("Existe chamado na base de dados com designação e motivo iguais.");
                            };
                        },
                    ])
                    ->default(request('designacao'))
                    ->columnSpanFull()
                    ->maxLength(15)
                    ->disabled(function ($record) {
                        return $record && $record->exists; // fica disabilitado após salvar

                    }),

                Forms\Components\Select::make('empresa')
                    ->options([
                        'SITELBRA'          => 'SITELBRA',
                        'IPFIBRA'           => 'IPFIBRA',
                        'SITELGRO'          => 'SITELGRO',
                        'SIENBRA'           => 'SIENBRA',
                        'GETICOM'           => 'GETICOM',
                        'SITELSEG'          => 'SITELSEG',
                        'TECINTEL'          => 'TECINTEL',
                        'SITELTRA'          => 'SITELTRA'
                    ])
                    ->default('SITELBRA')
                    ->label('Empresa')
                    ->disablePlaceholderSelection()
                    ->columnSpanFull(),

                DateTimePicker::make('data_previsao')
                    ->label('Data da previsão')
                    ->required()
                    ->columnSpanFull(),

                Repeater::make('anexo_chamado_internos')
                    ->label('Anexos')
                    ->relationship()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('arquivo')->collection('upload')
                            ->acceptedFileTypes(config('chamadointerno.mime_type'))
                            ->enableDownload()
                            ->enableOpen()
                            ->visibility('private')
                            ->responsiveImages(),
                    ])
                    ->label('Uploads')
                    ->columnSpanFull()
                    ->createItemButtonLabel('Adicionar Upload')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('motivo_chamado.titulo')
                    ->label('Motivo')
                    ->searchable()
                    ->limit(40),

                BadgeColumn::make('status')
                    ->colors([
                        'primary'       => 'Atendimento',
                        'secondary'     => 'Fechado',
                        'success'       => 'Novo'
                    ])
                    ->sortable()
                    ->searchable(),

                TextColumn::make('designacao')
                    ->label('Designação')
                    ->sortable()
                    ->copyable()
                    ->searchable(),

                TextColumn::make('empresa')
                    ->label('Empresa')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('demandante')
                    ->label('Demandante')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Data de criação')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('descricao')
                    ->limit(30)
                    ->tooltip(fn($record) : string => strip_tags($record->descricao))
                    ->getStateUsing(fn($record) : string => strip_tags($record->descricao))
                    ->toggleable()
                    ->toggledHiddenByDefault(),

                TextColumn::make('data_previsao')
                    ->label('Data da previsão')
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //filter demandante
                    Filter::make('current_user_demandante')
                    ->label('Meus Chamados')
                    ->query(function (Builder $query) {
                        $query->where('demandante', Auth::user()->name);
                    }),

                    Filter::make('my_setor_related_tickets')
                    ->label('Relacionado ao Meu Setor')
                    ->query(function (Builder $query) {
                        $query->whereHas('tickets', function (Builder $query) {
                            $query->whereHas('setor', function (Builder $query) {
                                $query->where('id', Auth::user()->setor_id);
                            });
                        });
                    }),

                ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort( 'id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TicketsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChamadoInternos::route('/'),
            'create' => Pages\CreateChamadoInterno::route('/create'),
            'edit' => Pages\EditChamadoInterno::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['id','designacao', 'cliente_tecnicos.circuito','tickets.nr_ticket'];
    }
}
