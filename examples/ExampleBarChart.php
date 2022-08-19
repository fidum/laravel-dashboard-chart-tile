<?php

namespace Fidum\ChartTile\Examples;

use Carbon\Carbon;
use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Contracts\ChartFactory;

class ExampleBarChart implements ChartFactory
{
    public static function make(array $settings): ChartFactory
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

        $chart->dataset('Example Data', 'bar', $data->toArray())
            ->backgroundColor('#848584');

        return $chart;
    }

    private function options(): array
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
}
