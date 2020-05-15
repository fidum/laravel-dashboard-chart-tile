@php /** @var \Fidum\ChartTile\Charts\Chart $chart */ @endphp

<x-dashboard-tile :position="$position">
    <div class="grid grid-rows-auto-1 gap-3 h-full">
        {!! $chart->container() !!}
    </div>
    @livewire('chart-refresh-tile', compact('chartFactory', 'chartProperties', 'height','refreshIntervalInSeconds', 'wireId'))
</x-dashboard-tile>

@push('scripts')
    {!! $chart->script() !!}
@endpush
