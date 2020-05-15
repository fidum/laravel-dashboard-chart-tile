<?php

namespace Fidum\ChartTile\Tests\Unit\Components;

use Fidum\ChartTile\Components\ChartComponent;
use Fidum\ChartTile\Examples\ExamplePieChart;
use Fidum\ChartTile\Factories\DefaultChartFactory;
use Fidum\ChartTile\Tests\TestCase;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ChartComponentTest extends TestCase
{
    public function testMount()
    {
        $component = new ChartComponent('');
        $component->mount('a1:a2', '100vh');

        $this->assertSame('a1:a2', $component->position);
        $this->assertSame(DefaultChartFactory::class, $component->chartFactory);
        $this->assertSame($component->id, $component->wireId);
        $this->assertSame($component->refreshIntervalInSeconds, 300);
    }

    public function testRender()
    {
        /** @var TestableLivewire $result */
        $result = Livewire::test(ChartComponent::class)
            ->set('position', 'a1:a2')
            ->call('render');

        $html = $result->payload['dom'];
        $wireId = $result->payload['id'];

        $result->assertViewHas('chartFactory', DefaultChartFactory::class)
            ->assertViewHas('refreshIntervalInSeconds', 300)
            ->assertViewHas('wireId', $wireId)
            ->assertViewHas('height', '100%')
        ;

        (new ViewAssertion($html))
            ->contains('<canvas style="display: none;" id="chart_'.$wireId.'"  height=\'100%\' ></canvas>')
        ;
    }

    public function testRenderCustomProperties()
    {
        /** @var TestableLivewire $result */
        $result = Livewire::test(ChartComponent::class)
            ->set('chartFactory', ExamplePieChart::class)
            ->set('refreshIntervalInSeconds', 60)
            ->set('wireId', 'abc')
            ->set('height', '75vh')
            ->call('render');

        $html = $result->payload['dom'];

        $result->assertViewHas('chartFactory', ExamplePieChart::class)
            ->assertViewHas('refreshIntervalInSeconds', 60)
            ->assertViewHas('wireId', 'abc')
            ->assertViewHas('height', '75vh')
        ;

        (new ViewAssertion($html))
            ->contains('<canvas style="display: none;" id="chart_abc"  height=\'75vh\' ></canvas>')
        ;
    }
}
