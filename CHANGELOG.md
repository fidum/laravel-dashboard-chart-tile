# Changelog

All notable changes to `fidum/laravel-dashboard-chart-tile` will be documented in this file

## 6.1.0 - 2024-03-13

### What's Changed

* Support Laravel 11 by @dmason30 in https://github.com/fidum/laravel-dashboard-chart-tile/pull/29

**Full Changelog**: https://github.com/fidum/laravel-dashboard-chart-tile/compare/6.0.0...6.1.0

## 6.0.0 - 2023-12-02

### What's Changed

* Run tests on PHP 8.3 by @dmason30 in https://github.com/fidum/laravel-dashboard-chart-tile/pull/26
* Upgrade to Laravel Dashboard 3.x by @dmason30 in https://github.com/fidum/laravel-dashboard-chart-tile/pull/27

**Full Changelog**: https://github.com/fidum/laravel-dashboard-chart-tile/compare/5.0.1...6.0.0

## 5.0.1 - 2023-02-08

### What's Changed

- Add Laravel 10 support by @dmason30 in https://github.com/fidum/laravel-dashboard-chart-tile/pull/25

**Full Changelog**: https://github.com/fidum/laravel-dashboard-chart-tile/compare/5.0.0...5.0.1

## 5.0.0 - 2022-08-19

### What's Changed

- Revert to ConsoleTvs/Charts v6 by @dmason30 in https://github.com/fidum/laravel-dashboard-chart-tile/pull/24

> If you're wondering what happened to the ConsoleTVs/Charts v7 version please read this: https://github.com/ConsoleTVs/Charts/issues/1#issuecomment-1208550258

**Full Changelog**: https://github.com/fidum/laravel-dashboard-chart-tile/compare/4.1.0...5.0.0

## 4.1.0 - 2022-02-10

## What's Changed

- Run tests in PHP 8.1 by @dmason30 in https://github.com/fidum/laravel-dashboard-chart-tile/pull/21
- Add Laravel 9 Support by @dmason30 in https://github.com/fidum/laravel-dashboard-chart-tile/pull/22

**Full Changelog**: https://github.com/fidum/laravel-dashboard-chart-tile/compare/4.0.1...4.1.0

## 4.0.1 - 2020-12-12

**Added**

- Added PHP 8 Support

## 4.0.0 - 2020-09-10

**Added**

- Added Laravel 8 Support
- Added `spatie/laravel-dashboard` 2.0.0 support

**Changed**

- Updated `consoletvs/charts` to 7.1

**Breaking**

- Dropped Laravel 7 support
- Dropped `spatie/laravel-dashboard` 1.x support

## 3.1.1 - 2020-07-17

**Changed**

- Switch to chartisan 2.1.* UMD build ([#12](https://github.com/fidum/laravel-dashboard-chart-tile/pull/12))

## 3.1.0 - 2020-07-17

**Fixed**

- Fix scripts getting the latest versions that contain breaking changes ([#11](https://github.com/fidum/laravel-dashboard-chart-tile/pull/11))

## 3.0.3 - 2020-07-06

**Added**

- Add support to use any frontend chart library ([#9](https://github.com/fidum/laravel-dashboard-chart-tile/pull/9))

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

The v7 release of the Charts package was a complete rewrite. Therefore it was not possible to support this version and
keep it backwards compatible. This has resulted in another breaking change and another major version.

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
