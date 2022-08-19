<div class="box-body">

    <h2 class="text text-primary">Diagnosa Penyakit</h2>
    <hr>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-exclamation-triangle"></i>Perhatian !</h4>
        Silahkan memilih gejala sesuai dengan kondisi diri anda, anda dapat memilih kepastian kondisi diri anda dari pasti
        tidak sampai pasti ya, jika sudah tekan tombol proses (<i class="fa fa-search-plus"></i>) di bawah untuk melihat
        hasil.
    </div>
    <form name="text_form" method="POST" action="{{ route('make-diagnosa') }}">
        @csrf
        <input class="float" type="submit" data-toggle="tooltip" data-placement="top"
            title="Klik disini untuk melihat hasil diagnosa" name="submit" value=""
            style="font-family:Arial, FontAwesome">
        <table class="table table-bordered table-striped konsultasi">
            <tbody class="pilihkondisi">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Gejala</th>
                    <th width="20%">Pilih Kondisi</th>
                </tr>
                @foreach ($gejala as $key=> $item)

                <tr>
                    <td class="opsi">{{ $key+1 }}</td>
                    <td class="opsi">G @if ($key < 9)0{{ $key+1 }} @else {{ $key+1 }} @endif</td>
                    <td class="gejala">{{ $item->nama_gejala }}</td>
                    <td class="opsi"><select name="kondisi[]" id="sl{{ $key+1 }}" class="opsikondisi"
                            style="background-color: rgb(255, 255, 255);">
                            <option data-id="0" value="0">Pilih jika sesuai</option>
                            @foreach ($kondisi as $item2)
                            <option data-id="{{ $item2->id_kondisi }}" value="{{ $item->id_gejala }}_{{ $item2->id_kondisi }}">{{ $item2->kondisi }}</option>
                            @endforeach
                        </select></td>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var arcolor = new Array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE',
                                '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700');
                            setColor();
                            $('.pilihkondisi').on('change', 'tr td select#sl{{ $key+1 }}', function () {
                                setColor();
                            });

                            function setColor() {
                                var selectedItem = $('tr td select#sl{{ $key+1 }} :selected');
                                var color = arcolor[selectedItem.data("id")];
                                $('tr td select#sl{{ $key+1 }}.opsikondisi').css('background-color', color);
                                console.log(color);
                            }
                        });

                    </script>
                </tr>
                @endforeach


            </tbody>
        </table>
    </form>
</div>
