<?php

namespace Fidum\ChartTile\Tests\Unit\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\Registrar;
use Fidum\ChartTile\Charts\DefaultChart;
use Fidum\ChartTile\Tests\TestCase;
use Illuminate\Http\Request;

class DefaultChartTest extends TestCase
{
    public function testHandler()
    {
        $data = json_decode(app(DefaultChart::class)->handler(new Request())->toJSON(), true);

        $this->assertArrayHasKey('chart', $data);
        $this->assertArrayHasKey('datasets', $data);
        $this->assertArrayHasKey('labels', $data['chart']);
    }

    public function testType()
    {
        $this->assertSame('bar', app(DefaultChart::class)->type());
    }

    public function testRoute()
    {
        $chart = app(DefaultChart::class);
        app(Registrar::class)->register([DefaultChart::class]);
        $this->assertSame(
            'http://localhost/api/chart/default_chart?foo=bar',
            $chart->route(['foo' => 'bar'])
        );
    }

    public function testOptions()
    {
        $this->assertSame([
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
        ], app(DefaultChart::class)->options());
    }

    public function testColors()
    {
        $this->assertSame(['#848584'], app(DefaultChart::class)->colors());
    }
}
