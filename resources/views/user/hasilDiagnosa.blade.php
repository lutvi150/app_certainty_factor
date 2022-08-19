<div class="box-body">
    <div class="content">
        <h2 class="text text-primary">Hasil Diagnosis &nbsp;&nbsp;<button id="print" onclick="window.print();"
                data-toggle="tooltip" data-placement="right" title="Klik tombol ini untuk mencetak hasil diagnosa"><i
                    class="fa fa-print"></i> Cetak</button> </h2>
        <hr>
        <table class="table table-bordered table-striped diagnosa">
            <tbody>
                <tr>
                    <th width="8%">No</th>
                    <th width="10%">Kode</th>
                    <th>Gejala yang dialami (keluhan)</th>
                    <th width="20%">Pilihan</th>
                </tr>
                @foreach ($showResultGejala as $key=> $item)
                <tr><td>{{ $key+1 }}</td>
                    <td>G @if ($item->data->id_gejala < 9)0{{ $item->data->id_gejala }} @else {{ $item->data->id_gejala }} @endif</td>

                    <td><span class="hasil text text-primary">{{ $item->data->nama_gejala }}</span></td>
                    <td><span class="kondisipilih" style="color:{{ $item->color }}">{{ $item->kondisi_test }}</span></td></tr>
                @endforeach

            </tbody>

        </table>
        <div class="well well-small"><img class="card-img-top img-bordered-sm" style="float:right; margin-left:15px;"
                src="{{ asset('assets/images/noimage.png') }}" height="200">
            <h3>Hasil Diagnosa</h3>
            <div class="callout callout-default">Jenis penyakit yang diderita adalah <b></b>
                <h3 class="text text-success"><b></b> / 0 % ()<br></h3>
            </div>
        </div>
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Detail</h3>
            </div>
            <div class="box-body">
                <h4></h4>
            </div>
        </div>
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Saran</h3>
            </div>
            <div class="box-body">
                <h4></h4>
            </div>
        </div>
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Kemungkinan lain:</h3>
            </div>
            <div class="box-body">
                <h4></h4>
            </div>
        </div>
    </div>
</div>
