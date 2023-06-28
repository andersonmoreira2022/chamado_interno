<?php

namespace App\Filament\Widgets;

use App\Models\ChamadoInterno;
use App\Models\Ticket;
use Filament\Widgets\BarChartWidget;
use Illuminate\Support\Carbon;

class TicketChart extends BarChartWidget
{
    protected static ?string $heading = 'Tickets';

    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {

        $tickets = Ticket::select('created_at')->get()->groupBy(function($ticket) {
            return Carbon::parse($ticket->created_at)->format('F');
        });

        $quantities = [];

        foreach ($tickets as $chamado => $value) {
            $quantities[] = $value->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Qtd. Tickets criados',
                    'data' => $quantities,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    'borderWidth' => 1
                ],
            ],
            'labels' => $tickets->keys(),
        ];
    }
}
