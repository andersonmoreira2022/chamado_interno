<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketsResource\Pages;
use App\Models\Setor;
use App\Models\Ticket;
use App\Models\TituloTickets;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ChamadoInterno;

class TicketsResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $label = 'Meus Tickets';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $recordTitleAttribute = 'nr_ticket';

    protected static ?string $navigationGroup = 'Chamados';

    public static function canCreate(): bool { return false; }

    protected static function getNavigationBadge(): ?string
    {
        return 'Setor: '.static::getModel()::where('setor_id', auth()->user()->setor_id)
                                            ->where('status', '!=', 'Fechado')
                                            ->count() . '  |  Meus: '.

            static::getModel()::where('user_id', auth()->user()->id)
                                ->where('status', '!=', 'Fechado')
                                ->count();
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema(schema: [
                Forms\Components\TextInput::make('chamado_interno_id')
                    ->label('ID - Chamado Interno')
                    ->hidden()
                    ->disabled(),

                Forms\Components\TextInput::make('motivo_chamado_titulo')
                ->label('Motivo do Chamados')
                ->visible(function ($record) {
                    return $record && $record->exists; // Mostra o campo apenas na edição
                })
                ->disabled(),


                Forms\Components\TextInput::make('criado_por_usuario')
                    ->label('Criado por')
                    ->disabled()
                    ->visible(function ($record) {
                        return $record && $record->exists; // Mostra o campo apenas na edição
                    }),

                Forms\Components\TextInput::make('nr_ticket')
                    ->label('N° Ticket')
                    ->hidden()
                    ->disabled(),

                Forms\Components\Select::make('setor_id')
                    ->label('Setor')
                    ->options(Setor::all()->pluck('setor', 'id'))
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(callback: function (callable $set) {
                        $set('user_id', null);
                    }),


                Forms\Components\Select::make('user_id')
                    ->label('Atribuído Para:')
                    ->options(options: function (callable $get){
                        $setor = Setor::where('id', $get('setor_id'))->first();

                        if(!$setor){
                            return null; 
                            return User::where('status', true)->pluck('name', 'id');
                        }
                        
                        return $setor->users->where('status', true)->pluck('name', 'id');
                    })
                    ->searchable(),

                Forms\Components\TextInput::make('chamado_interno_id')
                    ->label('ID - Chamado Interno')
                    ->disabled()
                    ->hidden()
                    ->columnSpanFull(),

                // Forms\Components\Select::make('titulo_tickets_id')
                //     ->label('Atividade')
                //     ->options(options: function (callable $get){
                //         return TituloTickets::where('setor_id', $get('setor_id'))->pluck('titulo', 'id');
                //     })
                //     ->searchable()
                //     ->columnSpanFull()
                //     ->required()
                //     ->hint(function (callable $get) {
                //         if ($get('chamado_interno_id') != null) {
                //             return '[Visualizar Chamado Interno](' . ChamadoInternoResource::getUrl('edit', ['record' => $get('chamado_interno_id')])  . ')';
                //         }
                //         return "";
                //     }),
                //não terá mais o campo de atividade, pois o chamado interno já tem 

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

                Forms\Components\RichEditor::make('mensagem')
                    ->label('Mensagem')
                    ->required()
                    ->columnSpanFull()
                    ->disabled(function ($record) {
                        return $record && $record->exists; // fica disabilitado após salvar
                    }),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->columnSpan('full')
                    ->options([
                        'Novo'              => 'Novo',
                        'Fechado'           => 'Fechado'
                    ])
                    ->default('Novo')
                    ->visible(function ($record) {
                        return $record && $record->exists; // Mostra o campo apenas na edição
                    })
                    ->afterStateUpdated(callback: function (callable $set, callable $get) {
                        if ($get('status') === 'Atendimento' && is_null($get('user_id'))) {
                            $set('user_id', Auth::user()->id);
                        }
                        if ($get('status') === 'Fechado' && is_null($get('user_id'))) {
                            $set('user_id', Auth::user()->id);
                        }
                    }),

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
                    ->columns(1)
                    ->createItemButtonLabel('Adicionar Upload'),

                Forms\Components\Repeater::make('comentario_tickets')
                    ->label('Comentários')
                    ->relationship()
                    ->schema([Forms\Components\RichEditor::make('comentario')->columnSpanFull()])
                    ->columns(1)
                    ->columnSpanFull(),


                Forms\Components\DateTimePicker::make('data_leitura')
                    ->hidden(),

                Forms\Components\DateTimePicker::make('data_fechamento')
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('users.foto')
                    ->label('')
                    ->circular()
                    ->tooltip(fn($record) : string => $record->users->name ?? ''),

                Tables\Columns\TextColumn::make('users.name')
                    ->label('Usuários')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('chamado_interno.designacao')
                    ->label('designacao')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nr_ticket')
                    ->label('N° Ticket')
                    ->sortable()
                    ->searchable(),

                // Tables\Columns\TextColumn::make('titulo_tickets.titulo')
                //     ->label('Título')
                //     ->sortable()
                //     ->searchable(),
                //removido o título

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
                        'success' => 'Novo',
                        'danger' => 'Cancelado',
                    ])
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data Abertura')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('data_leitura')
                    ->label('Data da leitura')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('data_fechamento')
                    ->label('Data do fechamento')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->dateTime('d/m/Y H:i'),

            ])
            ->defaultSort( 'id', 'desc')

            ->filters([
                Filter::make('setor_id')
                    ->label('Tickets do Setor')
                    ->query(fn (Builder $query) : Builder =>
                    $query->where('setor_id', auth()->user()->setor_id))
                    ->default(),


                Filter::make('user_id')
                    ->label('Meus Tickets')
                    ->query(fn (Builder $query) : Builder =>
                        $query->where('user_id', auth()->user()->id)),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Novo'              => 'Novo',
                        'Fechado'           => 'Fechado'
                    ])
                    ->default('Novo'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //  RelationManagers\ComentarioTicketsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTickets::route('/create'),
            'edit' => Pages\EditTickets::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nr_ticket'];
    }

}
