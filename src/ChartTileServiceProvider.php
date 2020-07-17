<?php

namespace Fidum\ChartTile;

use Fidum\ChartTile\Components\ChartComponent;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\Dashboard\Facades\Dashboard;

class ChartTileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('chart-tile', ChartComponent::class);

        Dashboard::script(config(
            'dashboard.tiles.charts.scripts.moment',
            'https://unpkg.com/moment@2.27.0/min/moment-with-locales.min.js'
        ));

        Dashboard::script(config(
            'dashboard.tiles.charts.scripts.chart',
            'https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js'
        ));

        Dashboard::script(config(
            'dashboard.tiles.charts.scripts.chartisan',
            'https://unpkg.com/@chartisan/chartjs@2.1.*/dist/chartisan_chartjs.umd.js'
        ));

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard-chart-tiles'),
        ], 'dashboard-chart-tiles');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashboard-chart-tiles');
    }
}
