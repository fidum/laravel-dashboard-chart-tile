<?php

namespace Fidum\ChartTile\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart as BaseChart;

class Chart extends BaseChart
{
    public function height($height): self
    {
        $this->height = $height;

        return $this;
    }

    public function id(string $id): self
    {
        $this->id = 'chart_'.$id;

        return $this;
    }
}
