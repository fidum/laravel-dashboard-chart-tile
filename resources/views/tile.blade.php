@php
    /** @var \Fidum\ChartTile\Charts\Chart $chart */
    $chartId = "chart_$wireId";
    $chartVariable = "chart$wireId";
@endphp

<x-dashboard-tile :position="$position">
    <div id="{{$chartId}}" style="height: {{$height}}"></div>
</x-dashboard-tile>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var {{$chartVariable}} = new Chartisan({
                el: '#{{$chartId}}',
                url: "{{$chart->route($chartFilters)}}",
                hooks: new ChartisanHooks()
                    .options({options: {!! json_encode($chart->options()) !!}})
                    .datasets('{{$chart->type()}}')
                    .colors({!! json_encode($chart->colors()) !!})
            })

            @if($refreshIntervalInSeconds > 0)
                setInterval(function () {
                    {{$chartVariable}}.update({ background: true });
                }, {{$refreshIntervalInSeconds * 1000}})
            @endif
        });
    </script>
@endpush
