<?php

namespace Fidum\ChartTile\Charts;

use ConsoleTVs\Charts\BaseChart;
use Illuminate\Support\Str;

abstract class Chart extends BaseChart
{
    public function colors(): array
    {
        return [];
    }

    public function route(array $params = []): string
    {
        $prefix = config('charts.global_route_name_prefix', '');
        $name = $this->routeName ?? $this->name ?? Str::snake(class_basename(static::class));
        return route(($prefix ? "$prefix." : '') .  $name, $params);
    }

    abstract public function type(): string;

    abstract public function options(): array;
}
