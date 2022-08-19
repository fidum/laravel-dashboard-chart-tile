<?php

namespace Fidum\ChartTile\Tests\Unit\Charts;

use Chartisan\PHP\Chartisan;
use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Tests\TestCase;
use Illuminate\Http\Request;

class ChartTest extends TestCase
{
    public function testDefaults()
    {
        $chart = $this->makeClass();

        $this->assertInstanceOf(Chartisan::class, $chart->handler(new Request()));
        $this->assertSame([], $chart->colors());
        $this->assertSame('', $chart->type());
        $this->assertSame([], $chart->options());
    }

    private function makeClass(): Chart
    {
        return new class extends Chart
        {
            public function handler(Request $request): Chartisan
            {
                return Chartisan::build();
            }

            public function type(): string
            {
                return '';
            }

            public function options(): array
            {
                return [];
            }
        };
    }
}
