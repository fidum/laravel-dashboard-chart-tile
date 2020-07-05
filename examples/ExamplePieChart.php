<?php

namespace Fidum\ChartTile\Examples;

use Chartisan\PHP\Chartisan;
use Fidum\ChartTile\Charts\Chart;
use Illuminate\Http\Request;

class ExamplePieChart extends Chart
{
    public function handler(Request $request): Chartisan
    {
        $data = [rand(5, 20), rand(20, 40), rand(5, 30)];
        $data[] = 100 - array_sum($data);

        return Chartisan::build()
            ->labels(['Tea', 'Coffee', 'Soda', 'Juice'])
            ->dataset('Drinks', $data);
    }

    public function type(): string
    {
        return 'pie';
    }

    public function options(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => true,
            'legend' => [
                'display' => true,
                'position' => 'right',
            ],
            'scales' => [
                'xAxes' => ['display' => false],
                'yAxes' => ['display' => false],
            ],
        ];
    }

    public function colors(): array
    {
        return [[['#FF9CEE'], ['#B28DFF'], ['#6EB5FF'], ['#BFFCC6']]];
    }
}
