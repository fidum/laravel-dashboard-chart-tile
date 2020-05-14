<?php
namespace Fidum\ChartTile\Tests;

use ConsoleTVs\Charts\ChartsServiceProvider;
use Fidum\ChartTile\ChartTileServiceProvider;
use Livewire\LivewireServiceProvider;
use NunoMaduro\LaravelMojito\MojitoServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\Dashboard\DashboardServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('dashboard.tiles.charts', [
            'refresh_interval_in_seconds' => 300,
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            ChartsServiceProvider::class,
            DashboardServiceProvider::class,
            LivewireServiceProvider::class,
            MojitoServiceProvider::class,
            ChartTileServiceProvider::class,
        ];
    }
}
