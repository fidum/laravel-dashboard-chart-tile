<?php

namespace Fidum\ChartTile\Examples;

class ExampleLineChart extends ExampleBarChart
{
    public function type(): string
    {
        return 'line';
    }

    public function colors(): array
    {
        return ['#B28CFF'];
    }
}
