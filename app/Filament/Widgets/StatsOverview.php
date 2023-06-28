<?php

namespace App\Filament\Widgets;

use App\Models\ChamadoInterno;
use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{

    protected function getCards(): array
    {
        $status_fechado = Ticket::where('status', 'Fechado')->where('user_id', auth()->user()->id)->count();
        $total = Ticket::where('user_id', auth()->user()->id)->count() ?: 1;
        $percent =  ($status_fechado / $total) * 100;

        return [
            Card::make('Meus Tickets Novos', Ticket::where('user_id', auth()->user()->id)->count())
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->descriptionIcon('heroicon-s-trending-up'),
            Card::make('Tickets Fechados', number_format($percent, 0) . '%')
                ->color('warning')
                ->descriptionIcon('heroicon-s-trending-down'),
            Card::make('Meus Tickets em Atendimento', Ticket::where('status', 'Atendimento')->where('user_id', auth()->user()->id)->count())
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary')
                ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
