# Laravel Dashboard Charting Tile

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fidum/laravel-dashboard-chart-tile.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-dashboard-chart-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/fidum/laravel-dashboard-chart-tile/run-tests?label=tests&style=for-the-badge)](https://github.com/fidum/laravel-dashboard-chart-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Codecov](https://img.shields.io/codecov/c/github/fidum/laravel-dashboard-chart-tile?logo=codecov&logoColor=white&style=for-the-badge)](https://codecov.io/gh/fidum/laravel-dashboard-chart-tile)
[![Twitter Follow](https://img.shields.io/twitter/follow/danmasonmp?label=Follow&logo=twitter&style=for-the-badge)](https://twitter.com/danmasonmp)  

Show off your charting skills with this easy to use tile. Supports line, bar, pie, doughnut and many more! 

![Preview](docs/preview.png)

## Installation

You can install the package via composer:

```bash
composer require fidum/laravel-dashboard-chart-tile
```

## Usage
In the `dashboard` config file, you can optionally add this configuration in the `tiles` key. 

```php
<?php
// in config/dashboard.php
return [
    // ...
    'tiles' => [
        'charts' => [     
            'refresh_interval_in_seconds' => 300, // optional: Default: 300 seconds (5 minutes)
        ],
    ],
];
```
This tile uses  `chart.js` to render the charts with the help of `Laravel Charts`  package see links to 
documentation for both below:  

- [Laravel Charts Documentation](https://charts.erik.cat/)
- [Chart.js Documentation](https://www.chartjs.org/docs/latest/charts/)


So that you can easily add your datasets and configure your charts exactly how you want them you need to create 
a chart class that implements the `Fidum\ChartTile\Contracts\ChartFactory` interface. 

See chart example below:

```php
<?php
namespace App\Charts;

use Carbon\Carbon;
use Fidum\ChartTile\Charts\Chart;
use Fidum\ChartTile\Contracts\ChartFactory;

class ExampleBarChart implements ChartFactory
{
    public static function make(array $settings): ChartFactory
    {
        return new static;
    }

    public function chart(): Chart
    {
        $date = Carbon::now()->subMonth()->startOfDay();

        $data = collect(range(0, 12))->map(function ($days) use ($date) {
            return [
                'x' => $date->clone()->addDays($days)->toDateString(),
                'y' => rand(100, 500),
            ];
        });

        $chart = (new Chart)
            ->labels($data->pluck('x')->toArray())
            ->options([
                  'responsive' => true,
                  'maintainAspectRatio' => false,
                  // etc...
             ], true);

        $chart->dataset('Example Data', 'bar', $data->toArray())
            ->backgroundColor('#848584');

        return $chart;
    }
}
```

In your dashboard view you can use the below component as many times as needed. Pass your chart class 
reference to the component and that will be used to generate the chart.

```blade
<x-dashboard>
    <livewire:chart-tile chartFactory="{{App\Charts\DailyUsersChart::class}}" position="a1:a3" />
</x-dashboard>
```

### Optional properties: 
- `chartSettings` optional key value array of settings that is passed to your chart `static::make` method. 
**Only use this for passing simple values `strings`, `integers`, `arrays` etc.** 
To use this you will have to use `@livewire` syntax over the component syntax in order set the array value. 
```blade
@livewire('chart-tile', [
    'chartFactory' => App\Charts\DailyUsersChart::class, 
    'chartSettings' => ['type' => 'customer'],
])
```

- `height` sets the height of the chart, depending on your dashboard layout you may need to adjust this (defaults to `100%`).

- `refreshIntervalInSeconds` use this to override the refresh rate of an individual tile (defaults to `300` seconds) 

## Examples
We have provided some chart factory examples to help get you started [here](examples). 
You can use the below dashboard layout to have an instant showcase of these examples:

```blade
<x-dashboard>
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExamplePieChart::class}}" position="a1:a2" height="140%"/>
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleDoughnutChart::class}}" position="b1:b2" height="140%"/>
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExamplePieChart::class}}" position="c1:c2" height="140%" />
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleDoughnutChart::class}}" position="d1:d2" height="140%" />
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleBarChart::class}}" position="a3:b4" />
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleLineChart::class}}" position="c3:d4" />
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleLineChart::class}}" position="a5:b6" />
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleBarChart::class}}" position="c5:d6" />
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleBarChart::class}}" position="a7:b8" />
    <livewire:chart-tile chartFactory="{{\Fidum\ChartTile\Examples\ExampleLineChart::class}}" position="c7:d8" />
</x-dashboard>
```

## Testing
```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
