<?php

namespace Fidum\ChartTile\Tests\Unit\Components;

use Fidum\ChartTile\Components\ChartComponent;
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
    }

    public function testRender()
    {
        /** @var TestableLivewire $result */
        $result = Livewire::test(ChartComponent::class)
            ->set('position', 'a1:a2')
            ->set('wireId', 'abc')
            ->call('render');

        $html = $result->payload['dom'];

        $result->assertViewHas('chartFactory', DefaultChartFactory::class)
            ->assertViewHas('refreshIntervalInSeconds', 300)
            ->assertViewHas('wireId', 'abc')
            ->assertViewHas('height', '100%')
        ;

        (new ViewAssertion($html))
            ->contains('<canvas style="display: none;" id="chart-abc"  height=\'100%\' ></canvas>')
        ;
    }
}
