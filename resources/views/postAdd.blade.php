<div class="box-body">
    <title>Post - Chirexs 1.0</title>

    <form name="text_form" id="post-keterangan" method="POST" enctype="multipart/form-data">
        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td width="120">Nama Post</td>
                    <td><input autocomplete="off" type="text" placeholder="Masukkan post baru..."
                            class="form-control" name="nama_post" id="nama_post" size="30"><br> <span class="text-error edetail_post"></span></td>
                </tr>
                <tr>
                    <td width="120">Detail Post</td>
                    <td> <textarea id="editor1" rows="4" cols="50" class="form-control" name="detail_post"
                            type="text" placeholder="Masukkan detail post baru..."
                            style="visibility: hidden; display: none;"></textarea><br>
                            <span class="text-error edetail_post"></span>

                    </td>
                </tr>
                <tr>
                    <td width="120">Saran Post</td>
                    <td><textarea id="editor2" rows="4" cols="50" class="form-control" name="saran_post"
                            type="text" placeholder="Masukkan saran post baru..."
                            style="visibility: hidden; display: none;"></textarea> <br> <span class="text-error esaran_post"></span>

                    </td>
                </tr>
                <tr>
                    <td width="120">Gambar Post</td>
                    <td>Upload Gambar (Ukuran Maks = 1 MB) : <input type="file" class="form-control"
                            name="gambar" required=""><br> <span class="text-error efile"></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="btn btn-success store-keterangan" type="button"  name="button" value="Simpan">
                        <input class="btn btn-danger" type="button" name="batal" value="Batal"
                            onclick="window.location.href='{{ route('keterangan') }}';"></td>
                </tr>
            </tbody>
        </table>
    </form>
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

        $(function () {
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
        })
        $(".store-keterangan").click(function (e) {
            e.preventDefault();
            storeData();
        });

       function storeData() {
        $(".store-keterangan").text('Menyimpan...');
        $("text-error").text("");
        var detail_post=CKEDITOR.instances.editor1.getData();
        var saran_post=CKEDITOR.instances.editor2.getData();
        var nama_post=$("#nama_post").val();
        $("#post-keterangan").ajaxForm({
            type: "POST",
            url: "{{ route('post-store') }}",
            data:{detail_post:detail_post,saran_post:saran_post},
            dataType: "JSON",
            success: function (response) {
                if (response.status=='failed') {
                    $.each(response.msg, function (indexInArray, valueOfElement) {
                        $(".e"+indexInArray).text(valueOfElement);
                    });
                } else{
                    iziToast.success({
                            title: 'OK',
                            position:'bottomCenter',
                            message: 'Data berhasil di simpan!',
                        });
                        CKEDITOR.instances.editor1.setData('')
                        CKEDITOR.instances.editor2.setData('')
                        $("#nama_post").val("");
                }
                $(".store-keterangan").text('Simpan');
            },error:function(){
                $(".store-keterangan").text('Simpan');
                console.log('something wrong');
            }
        }).submit();
        }
    </script>

</div>
