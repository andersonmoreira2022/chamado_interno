<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;
use Filament\Navigation\UserMenuItem;
use App\Filament\Resources\RoleResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\PermissionResource;
use Illuminate\Support\HtmlString;


class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        Filament::pushMeta([
            new HtmlString('<link rel="manifest" href="/manifest.json" />'),
        ]);

        Filament::serving(function(){
            if(auth()->user()){
                if(auth()->user()->hasAnyRole(['super-administrator', 'administrator', 'super_admin'])){
                    Filament::registerUserMenuItems([
                        UserMenuItem::make()
                            ->label('Gerenciar Users')
                            ->url(UserResource::getUrl())
                            ->icon('heroicon-s-users'),
                        UserMenuItem::make()
                            ->label('Gerenciar Roles')
                            ->url(RoleResource::getUrl())
                            ->icon('heroicon-s-cog'),
                        UserMenuItem::make()
                            ->label('Gerenciar Permissions')
                            ->url(PermissionResource::getUrl())
                            ->icon('heroicon-s-key')
                    ]);
                }
            }

            Filament::registerNavigationItems([
                NavigationItem::make('SextaFeira')
                    ->url('https://sextafeira.sitelbra.com.br/', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-link')
                    ->activeIcon('heroicon-s-presentation-chart-line')
                    ->group('Portal')
                    ->sort(3),
            ]);
        });
    }
}
