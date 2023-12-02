@php /** @var \Fidum\ChartTile\Charts\Chart $chart */ @endphp

<x-dashboard-tile :position="$position">
    <div class="grid grid-rows-auto-1 gap-3 h-full">
        {!! $chart->container() !!}
    </div>
    @livewire('chart-refresh-tile', compact('chartFactory', 'chartFilters', 'height','refreshIntervalInSeconds', 'wireId'))
</x-dashboard-tile>

@push('scripts')
    {!! str_replace(
        '<!--[if ENDBLOCK]><![endif]-->',
        '',
        str_replace('<!--[if BLOCK]><![endif]-->', '', $chart->script()),
    ) !!}
@endpush
