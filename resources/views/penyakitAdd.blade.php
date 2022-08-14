<div class="box-body">

        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td width="120">Nama Penyakit</td>
                    <td><input autocomplete="off" type="text" placeholder="Masukkan penyakit baru..."
                            class="form-control" name="nama_penyakit" size="30"><br><span class="text-error enama_penyakit"></span></td>
                </tr>
                <tr>
                    <td width="120">Detail Penyakit</td>
                    <td> <textarea rows="4" cols="50" class="form-control" name="det_penyakit" type="text"
                            placeholder="Masukkan detail penyakit baru..."></textarea></td>
                </tr>
                <tr>
                    <td width="120">Saran Penyakit</td>
                    <td><textarea rows="4" cols="50" class="form-control" name="srn_penyakit" type="text"
                            placeholder="Masukkan saran penyakit baru..."></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-success" name="store" id="storeData" onclick="storeData()"></button>
                        <input class="btn btn-success" type="submit" name="submit" value="Simpan">
                        <input class="btn btn-danger" type="button" name="batal" value="Batal"
                            onclick="window.location.href='{{ route('penyakit') }}';"></td>
                </tr>
            </tbody>
        </table>
</div>
<script>
    function storeData() {
        var nama_penyakit = $('input[name=nama_penyakit]').val();
        var det_penyakit = $('textarea[name=det_penyakit]').val();
        var srn_penyakit = $('textarea[name=srn_penyakit]').val();
        if (nama_penyakit == '') {
            $('.enama_penyakit').html('Nama penyakit tidak boleh kosong');
        } else {
            $('.enama_penyakit').html('');
            $.ajax({
                url: '{{ route('api-penyakitStore') }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'nama_penyakit': nama_penyakit,
                    'det_penyakit': det_penyakit,
                    'srn_penyakit': srn_penyakit
                },
                success: function (data) {
                    window.location.href = '{{ route('penyakit') }}';
                },error: function (data) {
                    console.log(data);
                }
            });
        }
     }
</script>
