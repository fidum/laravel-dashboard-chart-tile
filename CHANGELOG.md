# Changelog

All notable changes to `fidum/laravel-dashboard-chart-tile` will be documented in this file

## 3.0.2 - 2020-07-05

**Fixed**
- Chart API url was incorrectly escaped in view

## 3.0.1 - 2020-07-05

**Fixed**
- Move psalm dependencies to require-dev

## 3.0.0 - 2020-07-05

**Breaking**
- Changed to v7 of ConsoleTVs/Charts package. ([#7](https://github.com/fidum/laravel-dashboard-chart-tile/pull/7))
- Changed `chartSettings` tile property name to `chartFilters`

The v7 release of the Charts package was a complete rewrtie. Therefore it was not possible to support this version and keep it backwards compatible.
This has resulted in another breaking change and another major version.  

The `ChartFactory` interface no longer exists. All charts must now extend `Fidum\ChartTile\Charts\Chart` abstract class. 

See README for updated documentation.

## 2.0.0 - 2020-05-15

**Added**
- Add `chartSettings` tile property ([#3](https://github.com/fidum/laravel-dashboard-chart-tile/pull/3))

**Breaking**
- `Fidum\ChartTile\Contracts\ChartFactory::make` signature has changed to have the `array $settings` argument.
 
## 1.1.0 - 2020-05-15

**Added**
- Add `refreshIntervalInSeconds` tile property ([#2](https://github.com/fidum/laravel-dashboard-chart-tile/pull/2))

## 1.0.0 - 2020-05-14

- initial release
