<?php

namespace Fidum\ChartTile\Components;

use Fidum\ChartTile\Charts\Chart;

class ChartRefreshComponent extends ChartComponent
{
    public function render()
    {
        return view('dashboard-chart-tiles::chart_refresh', $this->viewData());
    }

    protected function chart(): Chart
    {
        $chart = parent::chart();

        $this->emit('chartDataRefreshed' . $this->wireId, [
            'labels' => $chart->labels,
            'datasets' => $chart->formatDatasets(),
            'options' => $chart->options,
        ]);

        return $chart;
    }
}
