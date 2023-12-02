<?php

namespace Fidum\ChartTile\Tests\Unit\Components;

use Fidum\ChartTile\Components\ChartComponent;
use Fidum\ChartTile\Examples\ExamplePieChart;
use Fidum\ChartTile\Factories\DefaultChartFactory;
use Fidum\ChartTile\Tests\TestCase;
use Livewire\Livewire;

class ChartComponentTest extends TestCase
{
    public function testMount()
    {
        Livewire::test(ChartComponent::class)
            ->assertSet('position', '')
            ->assertSet('chartFactory', DefaultChartFactory::class)
            ->assertSet('refreshIntervalInSeconds', 300);
    }

    public function testRender()
    {
        $test = Livewire::test(ChartComponent::class);

        $wireId = $test->id();

        $test->assertViewHas('chartFactory', DefaultChartFactory::class)
            ->assertViewHas('refreshIntervalInSeconds', 300)
            ->assertViewHas('wireId', $wireId)
            ->assertViewHas('height', '100%')
            ->assertSeeHtml("chartDataRefreshed$wireId")
            ->assertSeeHtml('<canvas style="display: none;" id="chart_'.$wireId.'"  height=\'100%\' ></canvas>');
    }

    public function testRenderCustomProperties()
    {
        $test = Livewire::test(ChartComponent::class, [
            'position' => 'a1:a2',
            'height' => '75vh',
            'chartFactory' => ExamplePieChart::class,
            'wireId' => $wireId = 'abc',
            'refreshIntervalInSeconds' => 60,
        ]);

        $test
            ->assertViewHas('chartFactory', ExamplePieChart::class)
            ->assertViewHas('refreshIntervalInSeconds', 60)
            ->assertViewHas('height', '75vh')
            ->assertSeeHtml("chartDataRefreshed$wireId")
            ->assertSeeHtml('<canvas style="display: none;" id="chart_'.$wireId.'"  height=\'75vh\' ></canvas>');
    }
}
