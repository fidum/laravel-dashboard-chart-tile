<?php

namespace Fidum\ChartTile\Tests\Unit\Components;

use ConsoleTVs\Charts\Registrar;
use Fidum\ChartTile\Charts\DefaultChart;
use Fidum\ChartTile\Components\ChartComponent;
use Fidum\ChartTile\Examples\ExamplePieChart;
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
        $this->assertSame(DefaultChart::class, $component->chartClass);
        $this->assertSame($component->refreshIntervalInSeconds, 300);
    }

    public function testRender()
    {
        app(Registrar::class)->register([DefaultChart::class]);

        /** @var TestableLivewire $result */
        $result = Livewire::test(ChartComponent::class)
            ->set('position', 'a1:a2')
            ->call('render');

        $html = $result->payload['dom'];
        $wireId = $result->payload['id'];

        $result->assertViewHas('chartClass', DefaultChart::class)
            ->assertViewHas('refreshIntervalInSeconds', 300)
            ->assertViewHas('wireId', $wireId)
            ->assertViewHas('height', '100%');

        (new ViewAssertion($html))
            ->contains('<div id="chart_'.$wireId.'" style="height: 100%"></div>');
    }

    public function testRenderCustomProperties()
    {
        app(Registrar::class)->register([ExamplePieChart::class, DefaultChart::class]);

        /** @var TestableLivewire $result */
        $result = Livewire::test(ChartComponent::class)
            ->set('chartClass', ExamplePieChart::class)
            ->set('refreshIntervalInSeconds', 60)
            ->set('height', '75vh')
            ->call('render');

        $html = $result->payload['dom'];
        $wireId = $result->payload['id'];

        $result->assertViewHas('chartClass', ExamplePieChart::class)
            ->assertViewHas('refreshIntervalInSeconds', 60)
            ->assertViewHas('wireId', $wireId)
            ->assertViewHas('height', '75vh');

        (new ViewAssertion($html))
            ->contains('<div id="chart_'.$wireId.'" style="height: 75vh"></div>');
    }
}
