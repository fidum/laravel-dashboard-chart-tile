@php /** @var \Fidum\ChartTile\Charts\Chart $chart */ @endphp

<div class="hidden" wire:poll.{{$refreshIntervalInSeconds}}s></div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('{{$eventName}}', ({0: newData}) => {
                var chartObj = window.{{$chart->id}};
                chartObj.data.labels = newData.labels;
                chartObj.data.datasets = JSON.parse(newData.datasets);
                chartObj.options = newData.options;
                chartObj.update();
            });
        });
    </script>
@endpush
