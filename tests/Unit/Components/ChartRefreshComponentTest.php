<?php

namespace Fidum\ChartTile\Tests\Unit\Components;

use Fidum\ChartTile\Components\ChartRefreshComponent;
use Fidum\ChartTile\Examples\ExamplePieChart;
use Fidum\ChartTile\Factories\DefaultChartFactory;
use Fidum\ChartTile\Tests\TestCase;
use Livewire\Livewire;

class ChartRefreshComponentTest extends TestCase
{
    public function testMount()
    {
        Livewire::test(ChartRefreshComponent::class)
            ->assertSet('position', '')
            ->assertSet('height', '100%')
            ->assertSet('chartFactory', DefaultChartFactory::class)
            ->assertSet('refreshIntervalInSeconds', 300);
    }

    public function testRender()
    {
        $test = Livewire::test(ChartRefreshComponent::class);
        $wireId = $test->id();
        $test->assertDispatched('chartDataRefreshed'.$wireId)
            ->assertViewHas('chartFactory', DefaultChartFactory::class)
            ->assertViewHas('refreshIntervalInSeconds', 300)
            ->assertViewHas('wireId', $wireId)
            ->assertViewHas('height', '100%')
            ->assertSeeHtml('wire:id="'.$wireId.'"')
            ->assertSeeHtml("chartDataRefreshed$wireId")
            ->assertSeeHtml('class="hidden" wire:poll.300s');
    }

    public function testRenderCustomProperties()
    {
        Livewire::test(ChartRefreshComponent::class, [
            'position' => 'a1:a2',
            'height' => '75vh',
            'chartFactory' => ExamplePieChart::class,
            'wireId' => $wireId = 'abc',
            'refreshIntervalInSeconds' => 60,
        ])
            ->assertDispatched('chartDataRefreshed'.$wireId)
            ->assertViewHas('chartFactory', ExamplePieChart::class)
            ->assertViewHas('refreshIntervalInSeconds', 60)
            ->assertViewHas('wireId', 'abc')
            ->assertViewHas('height', '75vh')
            ->assertSeeHtml("chartDataRefreshed$wireId")
            ->assertSeeHtml('class="hidden" wire:poll.60s');
    }
}
