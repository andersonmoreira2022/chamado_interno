<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profile';

    protected static ?string $title = 'Perfil';

    protected static ?string $navigationGroup = 'Conta';

    public $name;

    public $email;

    public $telefone;

    public $foto;

    public $current_password;

    public $new_password;

    public $new_password_confirmation;

    public function mount()
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'telefone' => auth()->user()->telefone,
            'foto' => auth()->user()->foto,
        ]);
    }

    public function submit()
    {
        $this->form->getState();


        $state = array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->new_password ? Hash::make($this->new_password) : null,
            'telefone' => $this->telefone,
            'foto' =>  $this->foto ?? null,
        ]);

        $user = auth()->user();

        $user->update($state);

        if ($this->new_password) {
            $this->updateSessionPassword($user);
        }

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->notify('success', 'Seu perfil foi atualizado com sucesso.');
    }

    protected function updateSessionPassword($user)
    {
        request()->session()->put([
            'password_hash_' . auth()->getDefaultDriver() => $user->getAuthPassword(),
        ]);
    }

    public function getCancelButtonUrlProperty()
    {
        return static::getUrl();
    }

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Profile',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Geral')
                ->columns(2)
                ->schema([
                    FileUpload::make('foto')
                        ->columnSpan('full')
                        ->image()
                        ->avatar(),

                    TextInput::make('name')
                        ->label('Nome')
                        ->required(),

                    TextInput::make('email')
                        ->label('Email')
                        ->required(),

                    TextInput::make('telefone')
                        ->mask(fn (TextInput\Mask $mask) => $mask->pattern('+{55}(00)00000-0000'))
                        ->label('WhatsApp'),
                ]),
            Section::make('Atualizar Senha')
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label('Senha Atual')
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label('Nova Senha')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirme a Nova Senha')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }
}
