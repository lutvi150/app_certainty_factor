<div class="box-body">
        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><input class="btn bg-olive margin" type="button" name="tambah" value="Tambah Basis Pengetahuan"
                            onclick="window.location.href='{{ route('pengetahuan-add') }}';"><input type="text" name="keyword"
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
                <th>Penyakit</th>
                <th>Gejala</th>
                <th>MB</th>
                <th>MD</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengetahuan as $key=> $item)
            <tr class="light">
                <td align="center">{{ $key+1 }}</td>
                <td>{{ $item->nama_penyakit }}</td>
                <td>{{ $item->nama_gejala }}</td>
                <td>{{ $item->mb }}</td>
                <td>{{ $item->md }}</td>
                <td align="center">
                    <a type="button" class="btn btn-block btn-success" href="{{ route('pengetahuan-edit',$item->id_pengetahuan) }}"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah </a> &nbsp;
                    <button onclick="deleteData({{ $item->id_pengetahuan }})" type="button" class="btn btn-block btn-danger"
                        ></i> Hapus</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="paging"><span class="disabled">Back</span><span class="current">1</span><span
            class="disabled">Next</span></div>

</div>
<script>
     function deleteData(id) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('api-pengetahuanDelete') }}",
                    data: {id_pengetahuan: id},
                    dataType: "JSON",
                    success: function (response) {
                        swal("Data Berhasil Dihapus!", {
                            icon: "success",
                        }).then(function () {
                            window.location.reload();
                        });
                    },error:function(){
                        iziToast.error({
                    title: 'Error',
                        position:'bottomCenter',
                    message: 'Sumething Wrong!',
                });
                    }
                });
           } else {
                swal("Batal", "Data batal dihapus", "error");
            }
        });
    }

</script>
