@extends('layout.template-admin')
@section('content')
    <div class="page-heading">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">Selamat datang kembali {{ Auth::user()->name }}</p>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="grafik-tamu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        var variableX = <?= json_encode($sumbuXHorizontal) ?>;
        var variableY = <?= json_encode($sumbuYVertikal) ?>;
        Highcharts.chart('grafik-tamu', {
            annotations: {
                position: 'back'
            },
            title: {
                text: 'GRAFIK TAMU DINAS KOMINFO'
            },
            xAxis: {
                categories: variableX
            },
            yAxis: {
                title: {
                    text: 'Jumlah tamu'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Trafik tamu berdasarkan bulan',
                data: variableY
            }]
        })
    </script>
@endsection
