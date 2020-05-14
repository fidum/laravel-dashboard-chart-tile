<?php

namespace Fidum\ChartTile\Tests\Unit\Charts;

use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Tests\TestCase;

class ChartTest extends TestCase
{
    public function testHeight()
    {
        $chart = new Chart();

        $this->assertSame(400, $chart->height);

        $chart->height('123vh');
        $this->assertSame('123vh', $chart->height);
    }

    public function testId()
    {
        $chart = new Chart();
        $chart->id('aa-bb-cc');

        $this->assertSame('chart_aa-bb-cc', $chart->id);
    }
}
