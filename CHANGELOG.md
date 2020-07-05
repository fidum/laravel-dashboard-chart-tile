# Changelog

All notable changes to `fidum/laravel-dashboard-chart-tile` will be documented in this file

## 3.0.0 - 2020-07-05

**Breaking**
- Changed to v7 of ConsoleTVs/Charts package. ([#7](https://github.com/fidum/laravel-dashboard-chart-tile/pull/7))
- Changed `chartSettings` tile property name to `chartFilters`

Due to all of the public API of the charts package changed there was no way to do this with backwards compatibility. 
Hence yet another major version. You will need to remake your `Fidum\ChartTile\Charts\Chart` charts in order to upgrade.

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
