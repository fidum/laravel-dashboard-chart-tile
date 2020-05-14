<?php

namespace Fidum\ChartTile\Tests\Unit\Factories;

use Carbon\Carbon;
use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Factories\DefaultChartFactory;
use Fidum\ChartTile\Tests\TestCase;

class DefaultChartFactoryTest extends TestCase
{
    public function testMake()
    {
        $factory = DefaultChartFactory::make();

        $this->assertInstanceOf(DefaultChartFactory::class, $factory);
    }

    public function testChart()
    {
        Carbon::setTestNow('2020-05-13');

        $chart = DefaultChartFactory::make()->chart();

        $this->assertInstanceOf(Chart::class, $chart);
        $this->assertSame($this->expectedLabels(), $chart->labels);
        $this->assertSame($this->expectedOptions(), $chart->options);
    }

    private function expectedLabels()
    {
        return [
            '2020-04-13',
            '2020-04-14',
            '2020-04-15',
            '2020-04-16',
            '2020-04-17',
            '2020-04-18',
            '2020-04-19',
            '2020-04-20',
            '2020-04-21',
            '2020-04-22',
            '2020-04-23',
            '2020-04-24',
            '2020-04-25',
        ];
    }

    private function expectedOptions(): array
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
