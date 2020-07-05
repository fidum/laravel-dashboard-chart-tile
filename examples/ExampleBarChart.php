<?php

namespace Fidum\ChartTile\Examples;

use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use Fidum\ChartTile\Charts\Chart;
use Illuminate\Http\Request;

class ExampleBarChart extends Chart
{
    public function handler(Request $request): Chartisan
    {
        $date = Carbon::now()->subMonth()->startOfDay();

        $data = collect(range(0, 12))->map(function ($days) use ($date) {
            return [
                'x' => $date->clone()->addDays($days)->toDateString(),
                'y' => rand(100, 500),
            ];
        });

        return Chartisan::build()
            ->labels($data->pluck('x')->toArray())
            ->dataset('Example Data', $data->toArray());
    }

    public function type(): string
    {
        return 'bar';
    }

    public function options(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'legend' => [
                'display' => true,
                'labels' => [
                    'boxWidth' => 0,
                ],
            ],
            'scales' => [
                'xAxes' => [[
                    'display' => true,
                    'offset' => true,
                    'type' => 'time',
                    'ticks' => [
                        'source' => 'auto',
                        'maxRotation' => 0,
                    ],
                    'time' => [
                        'unit' => 'day',
                        'round' => true,
                        'displayFormats' => [
                            'day' => 'MMM D',
                        ],
                    ],
                ]],
            ],
        ];
    }

    public function colors(): array
    {
        return ['#848584'];
    }
}
