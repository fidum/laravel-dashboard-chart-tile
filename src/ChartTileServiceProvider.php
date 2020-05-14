<?php

namespace Fidum\ChartTile;

use Fidum\ChartTile\Components\ChartComponent;
use Fidum\ChartTile\Components\ChartRefreshComponent;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\Dashboard\Facades\Dashboard;

class ChartTileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('chart-tile', ChartComponent::class);
        Livewire::component('chart-refresh-tile', ChartRefreshComponent::class);

        Dashboard::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment-with-locales.min.js');
        Dashboard::script('https://cdn.jsdelivr.net/npm/chart.js@2.8.0');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard-chart-tiles'),
        ], 'dashboard-chart-tiles');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashboard-chart-tiles');
    }
}
