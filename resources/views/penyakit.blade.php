<div class="box-body">
        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><input class="btn bg-olive margin" type="button" name="tambah" value="Tambah Penyakit"
                            onclick="window.location.href='{{ route('penyakit-add') }}';"><input type="text" name="keyword"
                            style="margin-left: 10px;" placeholder="Ketik dan tekan cari..." class="form-control"
                            value=""> <input class="btn bg-olive margin" type="submit" value="   Cari   " name="Go">
                    </td>
                </tr>
            </tbody>
        </table>
    <table class="table table-bordered" style="overflow-x=auto" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyakit</th>
                <th>Detail Penyakit</th>
                <th>Saran Penyakit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penyakit as $key=> $item)
            <tr class="light">
                <td align="center">{{ $key+1 }}</td>
                <td>{{ $item->nama_penyakit }}</td>
                <td>{{ $item->detail_penyakit }}</td>
                <td>{{ $item->saran_penyakit }}</td>
                <td align="center">
                    <a type="button" class="btn btn-block btn-success" href="penyakit/editpenyakit/1"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah </a> &nbsp;
                    <button onclick="hapusData({{ $item->id_penyakit }})" type="button" class="btn btn-block btn-danger"
                        ></i> Hapus</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="paging"><span class="disabled">Back</span><span class="current">1</span><span
            class="disabled">Next</span></div>
    <script>
        function readURL(input) {

            if (input.files &&
                input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#upload").change(function () {
            readURL(this);
        });

    </script>

</div>
