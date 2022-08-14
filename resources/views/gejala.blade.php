<div class="box-body">

        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><input class="btn bg-olive margin" type="button" name="tambah" value="Tambah Gejala"
                            onclick="window.location.href='{{ route('gejala-add') }}';"><input type="text"
                            name="keyword" style="margin-left: 10px;" placeholder="Ketik dan tekan cari..."
                            class="form-control" value=""> <input class="btn bg-olive margin" type="submit"
                            value="   Cari   " name="Go">
                    </td>
                </tr>
            </tbody>
        </table>
    <table class="table table-bordered" style="overflow-x=auto" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Gejala</th>
                <th width="21%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gejala as $key=> $item)
            <tr class="light">
                <td align="center">{{ $key+1 }}</td>
                <td>{{ $item->nama_gejala }}</td>
                <td align="center">
                    <a  type="button" class="btn btn-success margin" href="{{ route('gejala-edit',$item->id_gejala) }}"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah </a>
                    <button type="button" onclick="deleteData({{ $item->id_gejala }})"
                        class="btn btn-danger margin"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                    url: "{{ route('api-gejalaDelete') }}",
                    data: {id_gejala: id},
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
