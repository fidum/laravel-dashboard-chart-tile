<?php

namespace Fidum\ChartTile\Tests\Unit\Components;

use Fidum\ChartTile\Components\ChartRefreshComponent;
use Fidum\ChartTile\Examples\ExamplePieChart;
use Fidum\ChartTile\Factories\DefaultChartFactory;
use Fidum\ChartTile\Tests\TestCase;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ChartRefreshComponentTest extends TestCase
{
    public function testMount()
    {
        $component = new ChartRefreshComponent('');
        $component->mount('a1:a2', '100vh');

        $this->assertSame('a1:a2', $component->position);

        $this->assertSame(DefaultChartFactory::class, $component->chartFactory);
        $this->assertSame('100vh', $component->height);
        $this->assertSame($component->id, $component->wireId);
    }

    public function testRender()
    {
        /** @var TestableLivewire $result */
        $result = Livewire::test(ChartRefreshComponent::class)
            ->set('position', 'a1:a2')
            ->call('render');

        $html = $result->payload['dom'];
        $wireId = $result->payload['id'];

        $result->assertEmitted('chartDataRefreshed' . $wireId)
            ->assertViewHas('chartFactory', DefaultChartFactory::class)
            ->assertViewHas('refreshIntervalInSeconds', 300)
            ->assertViewHas('wireId', $wireId)
            ->assertViewHas('height', '100%')
        ;

        (new ViewAssertion($html))
            ->contains('<div wire:id="'.$wireId.'" class="hidden" wire:poll.300s></div>')
        ;
    }

    public function testRenderCustomProperties()
    {
        /** @var TestableLivewire $result */
        $result = Livewire::test(ChartRefreshComponent::class)
            ->set('chartFactory', ExamplePieChart::class)
            ->set('refreshIntervalInSeconds', 60)
            ->set('wireId', 'abc')
            ->set('height', '75vh')
            ->call('render');

        $html = $result->payload['dom'];
        $wireId = $result->payload['id'];

        $result->assertEmitted('chartDataRefreshedabc')
            ->assertViewHas('chartFactory', ExamplePieChart::class)
            ->assertViewHas('refreshIntervalInSeconds', 60)
            ->assertViewHas('wireId', 'abc')
            ->assertViewHas('height', '75vh')
        ;

        (new ViewAssertion($html))
            ->contains('<div wire:id="'.$wireId.'" class="hidden" wire:poll.60s></div>')
        ;
    }
}
