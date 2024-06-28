@extends('dashboard.master')

@section('title', 'Dashboard')

@section('content')

<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar"
                                        >
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-server"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M7 8l0 .01" /><path d="M7 16l0 .01" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Router Identity:</div>
                                    <div class="text-muted">{{ $name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar"
                                    >
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-versions"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /><path d="M7 7l0 10" /><path d="M4 8l0 8" /></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">Version: </div>
                                <div class="text-muted">{{ $version }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-twitter text-white avatar"
                                >
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cpu"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 5m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v12a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" /><path d="M9 9h6v6h-6z" /><path d="M3 10h2" /><path d="M3 14h2" /><path d="M10 3v2" /><path d="M14 3v2" /><path d="M21 10h-2" /><path d="M21 14h-2" /><path d="M14 21v-2" /><path d="M10 21v-2" /></svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">CPU:</div>
                            <div class="text-muted">{{ $cpu }} %</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-facebook text-white avatar"
                            >
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20.942 13.021a9 9 0 1 0 -9.407 7.967" /><path d="M12 7v5l3 3" /><path d="M15 19l2 2l4 -4" /></svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">Uptime:</div>
                        <div class="text-muted">{{ $uptime }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-lg-9">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Traffic Interface</h3>
        </div>
        <span id="chart-mentions"></span>

    </div>
</div>
<div class="col-lg-3">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Select Interface</h3>
            <div class="input-group input-group-flat mb-3">
                <select name="interface" id="interface" class="form-control">
                    @foreach ($interface as $item)
                    <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <span id="traffic"></span>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    setInterval('traffic();', 1000);
    function traffic() {
        var traffic = $('#interface').val();
        var url = '{{ route("dashboard-traffic", ":traffic") }}';
        // console.log(traffic);
        
        $('#traffic').load(url.replace(':traffic', traffic));
    }
</script>


<script src="https://code.highcharts.com/highcharts.js"></script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var chart = Highcharts.chart('chart-mentions', {
            title: {
                text: 'Traffic Interface'
            },
            xAxis: {
                categories: ['RX', 'TX']
            },
            chart: {
                type: 'spline'
            },
            series: [{
                name: 'Upload',
                data: [null, null] // Data upload awal
            }, {
                name: 'Download',
                data: [null, null] // Data download awal
            }],
            plotOptions: {
                spline: {
                    marker: {
                        enabled: false
                    }
                }
            }
        });

        // Fungsi untuk memperbarui data grafik secara periodik
        function updateChart() {
            // Dapatkan data traffic yang baru
            var uploadData = Math.random() * 1000; // Contoh data traffic upload acak
            var downloadData = Math.random() * 1000; // Contoh data traffic download acak

            // Perbarui data grafik
            chart.series[0].addPoint(uploadData, true, true); // Perbarui data upload
            chart.series[1].addPoint(downloadData, true, true); // Perbarui data download

            // Panggil fungsi ini secara periodik (misalnya setiap 1 detik)
            setTimeout(updateChart, 3000);
        }

        // Panggil fungsi pertama kali untuk memulai perbaruan grafik
        updateChart();
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chart = Highcharts.chart('chart-mentions', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Traffic Interface'
            },
            xAxis: {
                categories: ['RX', 'TX'],
                accessibility: {
                    description: 'Upload and Download'
                }
            },
            yAxis: {
                title: {
                    text: 'Traffic'
                },
                labels: {
                    format: '{value} Mbps'
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Upload',
                marker: {
                    symbol: 'circle'
                },
                data: [null, null] // Data upload awal
            }, {
                name: 'Download',
                marker: {
                    symbol: 'circle'
                },
                data: [null, null] // Data download awal
            }]
        });

        // Fungsi untuk memperbarui data grafik secara periodik
        function updateChart() {
            // Dapatkan data traffic yang baru secara acak
            var uploadData = Math.random() * 1000; // Data traffic upload acak (dalam Mbps)
            var downloadData = Math.random() * 1000; // Data traffic download acak (dalam Mbps)

            // Perbarui data grafik
            chart.series[0].addPoint(uploadData, true, true); // Perbarui data upload
            chart.series[1].addPoint(downloadData, true, true); // Perbarui data download

            // Panggil fungsi ini secara periodik (misalnya setiap 1 detik)
            setTimeout(updateChart, 1000);
        }

        // Panggil fungsi pertama kali untuk memulai perbaruan grafik
        updateChart();
    });
</script>


@endsection