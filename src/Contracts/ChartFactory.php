<?php

namespace Fidum\ChartTile\Contracts;

use Fidum\ChartTile\Charts\Chart;

interface ChartFactory
{
    public static function make(array $settings): self;

    public function chart(): Chart;
}
