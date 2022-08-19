<div class="box-body">

        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td width="120">Nama Penyakit</td>
                    <td><input type="text" hidden name="id_penyakit" value="{{ $penyakit->id_penyakit }}"><input autocomplete="off" type="text" placeholder="Masukkan penyakit baru..."
                            class="form-control" name="nama_penyakit" value="{{ $penyakit->nama_penyakit }}" size="30"><br><span class="text-error enama_penyakit"></span></td>
                </tr>
                <tr>
                    <td width="120">Detail Penyakit</td>
                    <td> <textarea rows="4" cols="50" class="form-control" name="det_penyakit" type="text"
                            placeholder="Masukkan detail penyakit baru...">{{ $penyakit->detail_penyakit }}</textarea></td>
                </tr>
                <tr>
                    <td width="120">Saran Penyakit</td>
                    <td><textarea rows="4" cols="50" class="form-control" name="srn_penyakit" type="text"
                            placeholder="Masukkan saran penyakit baru...">{{ $penyakit->saran_penyakit }}</textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-success" name="store" id="storeData" onclick="storeData()">Simpan</button>
                        <input class="btn btn-danger" type="button" name="batal" value="Batal"
                            onclick="window.location.href='{{ route('penyakit') }}';"></td>
                </tr>
            </tbody>
        </table>
</div>
<script>
    function storeData() {
        $("#storeData").text('Menyimpan...');
        var nama_penyakit = $('input[name=nama_penyakit]').val();
        var det_penyakit = $('textarea[name=det_penyakit]').val();
        var srn_penyakit = $('textarea[name=srn_penyakit]').val();
        if (nama_penyakit == '') {
            $('.enama_penyakit').html('Nama penyakit tidak boleh kosong');
        } else {
            $('.enama_penyakit').html('');
            $.ajax({
                url: "{{ route('api-penyakitUpdate') }}",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'nama_penyakit': nama_penyakit,
                    'detail_penyakit': det_penyakit,
                    'saran_penyakit': srn_penyakit,
                    'id_penyakit': '{{ $penyakit->id_penyakit }}'
                },
                success: function (data) {
                    $("#storeData").text('Simpan');
                    if (data.status == 'success') {
                        iziToast.success({
                            title: 'OK',
                            position:'bottomCenter',
                            message: 'Data berhasil di simpan!',
                        });
                    } else if(data.status == 'failed') {
                        $(".enama_penyakit").html(data.message);
                    } else if(data.status=='data_ready'){
                        $(".enama_penyakit").html("Nama penyakit sudah ada");
                    }
                },error: function (data) {
                    $("#storeData").text('Simpan');
                    console.log(data);
                }
            });
        }
     }
</script>
