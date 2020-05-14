<?php

namespace Fidum\ChartTile\Examples;

use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Contracts\ChartFactory;

class ExampleDoughnutChart implements ChartFactory
{
    public static function make(): ChartFactory
    {
        return new static;
    }

    public function chart(): Chart
    {
        $chart = new Chart();

        $data = [rand(5, 20), rand(20, 40), rand(5, 30)];
        $data[] = 100 - array_sum($data);

        $chart->labels(['Tea', 'Coffee', 'Soda', 'Juice'])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => true,
                'animation' => [
                    'duration' => 0,
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'right',
                ],
                'scales' => [
                    'xAxes' => ['display' => false],
                    'yAxes' => ['display' => false],
                ],
            ])
            ->dataset('Drinks', 'doughnut', $data)
            ->backgroundColor(['#FF9CEE', '#B28DFF', '#6EB5FF', '#BFFCC6']);

        return $chart;
    }
}
