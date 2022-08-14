<div class="box-body">
    <script language="JavaScript">

        function Blank_TextField_Validator() {
            if (text_form.username.value == "") {
                alert("Username tidak boleh kosong !");
                text_form.username.focus();
                return (false);
            }
            if (text_form.password.value == "") {
                alert("Password tidak boleh kosong !");
                text_form.password.focus();
                return (false);
            }
            return (true);
        }

        function Blank_TextField_Validator_Cari() {
            if (text_form.keyword.value == "") {
                alert("Isi dulu keyword pencarian !");
                text_form.keyword.focus();
                return (false);
            }
            return (true);
        }

    </script>
    <script language="JavaScript">
        function confirmIt(dbMsg, okURL, cancelURL, aOkMsg, aCancelMsg, okTyp, cancelTyp, okWin, cancelWin) {
            if (confirm(dbMsg)) {
                if (okTyp == "u") {
                    if (okWin == "Self") location.href = okURL;
                    if (okWin == "Parent") parent.location.href = okURL;
                } else if (okTyp == "a") {
                    alert(aOkMsg);
                }
            } else {
                if (cancelTyp == "u") {
                    if (cancelWin == "Self") location.href = cancelURL;
                    if (cancelWin == "Parent") parent.location.href = cancelURL;
                } else if (cancelTyp == "a") {
                    alert(aCancelMsg);
                }
            }
        }


    </script><br>
    <form method="POST" action="?module=admin" name="text_form" onsubmit="return Blank_TextField_Validator_Cari()">
        <br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><input class="btn bg-olive margin" type="button" name="tambah" value="Tambah Admin"
                            onclick="window.location.href='admin/tambahadmin';"><input type="text" name="keyword"
                            style="margin-left: 10px;" placeholder="Ketik dan tekan cari..." class="form-control"
                            value=""> <input class="btn bg-olive margin" type="submit" value="   Cari   " name="Go">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <table class="table table-bordered" style="overflow-x=auto" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th width="21%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataAdmin as $key=> $item)
            <tr class="light">
                <td align="center">{{ $key+1 }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->nama }}</td>
                <td align="center">
                    <a type="button" class="btn btn-success margin" href="admin/editadmin/RYU"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah </a> &nbsp;
                    <a type="button" class="btn btn-danger margin"
                        href="JavaScript: confirmIt('Anda yakin akan menghapusnya ?','modul/admin/aksi_admin.php?module=admin&amp;act=hapus&amp;id=RYU','','','','u','n','Self','Self')"
                        onmouseover="self.status=''; return true" onmouseout="self.status=''; return true"><i
                            class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
