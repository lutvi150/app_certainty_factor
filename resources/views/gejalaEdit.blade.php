<div class="box-body">
    <br><br>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td width="120">Nama Gejala</td>
                <td><input type="text" value="{{ $gejala->nama_gejala }}" autocomplete="off" placeholder="Masukkan gejala baru..." class="form-control"
                        name="nama_gejala" size="30"><input type="text" hidden name="id_gejala" value="{{ $gejala->id_gejala }}" ><br>
                    <span class="text-error enama_gejala"></span></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="button" class="btn btn-success" id="store" onclick="storeData()">Simpan</button>
                    <input class="btn btn-danger" type="button" name="batal" value="Batal"
                        onclick="window.location.href='{{ route('gejala') }}'"></td>
            </tr>
        </tbody>
    </table>
    </form>
</div>
<script src="{{ asset('js/iziToast.js') }}"></script>
<script>
    function storeData() {
        $("#store").text('Menyimpan...');
        $.ajax({
            type: "POST",
            url: "{{ route('api-gejalaUpdate') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama_gejala': $('input[name=nama_gejala]').val(),
                'id_gejala': $('input[name=id_gejala]').val()
            },
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'failed') {
                    $(".enama_gejala").text(response.msg);
                    $("#store").text('Simpan');
                }else if (response.status=='data_ready') {
                    $(".enama_gejala").text(response.msg);
                } else if(response.status=='success') {
                    iziToast.success({
                        title: 'OK',
                        position:'bottomCenter',
                        message: 'Data berhasil di simpan!',
                    });
                }
                $("#store").text('Simpan');
            },
            error: function () {
                iziToast.error({
                    title: 'Error',
                        position:'bottomCenter',
                    message: 'Sumething Wrong!',
                });

            }
        });
    }

</script>
