<div class="box-body">
    <title>{{ env('APP_NAME') }}</title>

    <form method="POST" action="?module=post" name="text_form"
        onsubmit="return Blank_TextField_Validator_Cari()">
        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><a href="{{ route('keterangan-add') }}" class="btn bg-olive margin">Tambah Post</a><input type="text" name="keyword"
                            style="margin-left: 10px;" placeholder="Ketik dan tekan cari..."
                            class="form-control" value=""> <input class="btn bg-olive margin" type="submit"
                            value="   Cari   " name="Go"></td>
                </tr>
            </tbody>
        </table>
    </form>
    <table class="table table-bordered" style="overflow-x=auto" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Post</th>
                <th>Detail Post</th>
                <th>Saran Post</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $key=> $item)
            <tr class="">
                <td align="center">{{ $key+1 }}</td>
                <td>{{ $item->nama_post }}</td>
                <td>
                   {!! $item->detail_post !!}
                </td>
                <td>{!! $item->saran_post !!}
                </td>
                <td align="center">
                    <a type="button" class="btn btn-success margin" href="{{ route('keterangan-edit',Crypt::encryptString($item->id_post)) }}"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah </a> &nbsp;
                    <button type="button" onclick="deleteData({{ $item->id_post }})" class="btn btn-danger margin"
                        href="">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
   {{ $post->links() }}

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
                    url: "{{ route('post-delete') }}",
                    data: {id: id},
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
