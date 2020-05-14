<?php

namespace Fidum\ChartTile\Examples;

use Carbon\Carbon;
use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Contracts\ChartFactory;

class ExampleLineChart implements ChartFactory
{
    public static function make(): ChartFactory
    {
        return new static;
    }

    public function chart(): Chart
    {
        $date = Carbon::now()->subMonth()->startOfDay();

        $data = collect(range(0, 12))->map(function ($days) use ($date) {
            return [
                'x' => $date->clone()->addDays($days)->toDateString(),
                'y' => rand(100, 500),
            ];
        });

        $chart = (new Chart())
            ->labels($data->pluck('x')->toArray())
            ->options($this->options(), true);

        $chart->dataset('Example Data', 'line', $data->toArray())
            ->backgroundColor('#B28CFF');

        return $chart;
    }

    private function options(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'animation' => [
                'duration' => 0,
            ],
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
}
