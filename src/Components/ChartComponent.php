<?php

namespace Fidum\ChartTile\Components;

use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Contracts\ChartFactory as ChartTileContract;
use Fidum\ChartTile\Factories\DefaultChartFactory;
use Livewire\Component;

class ChartComponent extends Component
{
    public string $chartFactory;

    public array $chartFilters;

    public string $height;

    public string $position;

    public int $refreshIntervalInSeconds;

    public string $wireId;

    public function mount(
        string $position = '',
        string $height = '100%',
        string $chartFactory = null,
        string $wireId = null,
        array $chartFilters = [],
        int $refreshIntervalInSeconds = null
    ) {
        $this->height = $height;
        $this->position = $position;
        $this->chartFactory = $chartFactory ?? DefaultChartFactory::class;
        $this->chartFilters = $chartFilters;
        $this->wireId = $wireId ?? $this->id;

        $this->refreshIntervalInSeconds = $refreshIntervalInSeconds
            ?? config('dashboard.tiles.charts.refresh_interval_in_seconds', 300);
    }

    public function render()
    {
        return view('dashboard-chart-tiles::tile', $this->viewData());
    }

    protected function chart(): Chart
    {
        /** @var ChartTileContract $factory */
        $factory = $this->chartFactory;

        return $factory::make($this->chartFilters)
            ->chart()
            ->height($this->height)
            ->id($this->wireId);
    }

    protected function viewData(): array
    {
        return [
            'wireId' => $this->wireId,
            'chart' => $this->chart(),
            'chartFactory' => $this->chartFactory,
        ];
    }
}
