<title>Riwayat - Chirexs 1.0</title>
<h2 class='text text-primary'>Riwayat Konsultasi</h2>
<hr>
<div class='row'>
    <div class='col-md-8'>
        <table class='table table-bordered table-striped riwayat' style='overflow-x=auto' cellpadding='0'
            cellspacing='0'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Penyakit</th>
                    <th nowrap>Nilai CF</th>
                    <th width='21%' class='text-center'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $key=> $item)
                <tr class='{{ ($key%2)? "light":"dark" }}'>
                    <td align=center>{{ $key+1 }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->nama_penyakit }}</td>
                    <td><span class='label label-default'>{{ $item->hasil_nilai }}</span></td>
                    <td align=center>
                        <a type='button' class='btn btn-default btn-xs' target='_blank'
                            href='{{ route('history-detail',Crypt::encryptString($item->id_hasil)) }}'> <i class='fa fa-eye' aria-hidden='true'></i> Detail </a>
                        &nbsp;
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        {{ $history->links() }}
    </div>

    <div class="col-md-4">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <i class="fa fa-pie-chart"></i>

                <h3 class="box-title">Grafik</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="donut-chart" class="chart" style="width:100%;height:250px;"></div>
                <hr>
                <div id="legend-container"></div>
            </div>
            <!-- /.box-body-->
        </div>
    </div>

    <script>
        $(function () {


           $.ajax({
            type: "GET",
            url: "{{ route('api-chartHistory') }}",
            dataType: "JSON",
            success: function (response) {
                var donutData =response;

            function legendFormatter(label, series) {
                return '<div class="text text-primary margin4">' + label + ' ' + Math.round(series.percent) +
                    '%';
            };

            $.plot('#donut-chart', donutData, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.3,
                        label: {
                            show: true,
                            radius: 2 / 3,
                            formatter: function (label, series) {
                                return '<div class="badge bg-navy color-pallete">' + Math.round(
                                    series.percent) + '%</div>';
                            },
                            threshold: 0.01
                        }

                    }
                },
                legend: {
                    show: true,
                    container: $("#legend-container"),
                    labelFormatter: legendFormatter,
                }
            })
            }
           });
            /*
             * END DONUT CHART
             */

        })

        /*
         * Custom Label formatter
         * ----------------------
         */
        function labelFormatter(label, series) {
            return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
                label +
                '<br>' +
                Math.round(series.percent) + '%</div>'
        }

    </script>
