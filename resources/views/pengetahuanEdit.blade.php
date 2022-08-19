
    <div class="box-body">

        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-exclamation-triangle"></i>Petunjuk Pengisian Pakar !</h4>
            Silahkan pilih gejala yang sesuai dengan penyakit yang ada, dan berikan <b>nilai kepastian (MB &amp; MB)</b>
            dengan cakupan sebagai berikut:<br><br>
            <b>1.0</b> (Pasti Ya)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.8</b> (Hampir Pasti)&nbsp;&nbsp;|<br>
            <b>0.6</b> (Kemungkinan Besar)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.4</b> (Mungkin)&nbsp;&nbsp;|<br>
            <b>0.2</b> (Hampir Mungkin)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.0</b> (Tidak Tahu atau Tidak
            Yakin)&nbsp;&nbsp;|<br><br>
            <b>CF(Pakar) = MB – MD</b><br>
            MB : Ukuran kenaikan kepercayaan (measure of increased belief) MD : Ukuran kenaikan ketidakpercayaan
            (measure of increased disbelief) <br> <br>
            <b>Contoh:</b><br>
            Jika kepercayaan <b>(MB)</b> anda terhadap gejala Infeksi gusi untuk penyakit Hipertensi adalah
            <b>0.8 (Hampir Pasti)</b><br>
            Dan ketidakpercayaan <b>(MD)</b> anda terhadap gejala Infeksi gusi untuk penyakit Hipertensi
            adalah <b>0.2 (Hampir Mungkin)</b><br><br>
            <b>Maka:</b> CF(Pakar) = MB – MD (0.8 - 0.2) = <b>0.6</b> <br>
            Dimana nilai kepastian anda terhadap gejala Infeksi gusi untuk penyakit Hipertensi adalah <b>0.6
                (Kemungkinan Besar)</b>
        </div>
        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td width="120">Penyakit</td>
                    <td><select class="form-control" name="kode_penyakit" id="kode_penyakit">
                            <option value="">- Pilih Penyakit -</option>
                            @foreach ($penyakit as $item)
                            <option @if ($pengetahuan->id_penyakit==$item->id_penyakit)
                                selected
                            @endif value="{{ $item->id_penyakit }}">{{ $item->nama_penyakit }}</option>
                            @endforeach
                        </select> <br><span class="text-error eid_penyakit"></span></td>
                </tr>
                <tr>
                    <td>Gejala</td>
                    <td><select class="form-control" name="kode_gejala" id="kode_gejala">
                            <option value="">- Pilih Gejala -</option>
                            @foreach ($gejala as $item)
                            <option @if ($pengetahuan->id_gejala==$item->id_gejala)
                                selected

                            @endif value="{{ $item->id_gejala }}">{{ $item->nama_gejala }}</option>
                            @endforeach
                        </select><br><span class="text-error eid_gejala"></span></td>
                </tr>
                <tr>
                    <td>MB</td>
                    <td><input autocomplete="off" placeholder="Masukkan MB" value="{{ $pengetahuan->mb }}" type="text" class="form-control" id="mb" name="mb"
                            size="15"><br><span class="text-error emb"></span></td>
                </tr>
                <tr>
                    <td>MD</td>
                    <td><input autocomplete="off" value="{{ $pengetahuan->md }}" placeholder="Masukkan MD" type="text" class="form-control"id="md" name="md"
                            size="15"><br><span class="text-error emd"></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-success store" id="store" onclick="storeData()">Simpan</button>
                        <input class="btn btn-danger" type="button" name="batal" value="Batal"
                            onclick="window.location.href='{{ route('pengetahuan') }}';"></td>
                </tr>
            </tbody>
        </table>
    </div>
<script>
    function storeData() {
        $(".store").text('Menyimpan...');
        $(".text-error").text('');
        var kode_penyakit = $('#kode_penyakit').children("option:selected").val();
        var kode_gejala = $('#kode_gejala').children("option:selected").val();
        var mb = $('#mb').val();
        var md = $('#md').val();

        $.ajax({
            url: '{{ route('api-pengetahuanUpdate') }}',
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'id_penyakit': kode_penyakit,
                'id_gejala': kode_gejala,
                'mb': mb,
                'md': md,
                'id_pengetahuan': '{{ $pengetahuan->id_pengetahuan }}'
            },
            success: function (data) {
                $(".store").text('Simpan');
                if (data.status == 'failed') {
                    $.each(data.msg, function (key, value) {
                        $('.e' + key).text(value);
                    });
                } else if (data.status == 'data_ready') {
                    iziToast.error({
                        title: 'Error',
                        position: 'bottomCenter',
                        message: 'Pengetahuan Sudah Ada!',
                    });
                } else if (data.status == 'success') {

                    iziToast.success({
                        title: 'Berhasil',
                        position: 'bottomCenter',
                        message: 'Pengetahuan Berhasil Disimpan!',
                    })

                }
            },
            error: function (data) {
                $(".store").text('Simpan');
                iziToast.error({
                    title: 'Error',
                    message: 'Terjadi kesalahan!',
                });
            }
        });
    }

</script>
