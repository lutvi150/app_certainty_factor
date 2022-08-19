<?php

namespace App\Http\Controllers;

use App\Models\basisPengetahuan;
use App\Models\gejala;
use App\Models\hasil;
use App\Models\kondisi;
use App\Models\penyakit;
use Illuminate\Http\Request;

class ControllerUser extends Controller
{
    public function diagnosa(Type $var = null)
    {
        $menu = 'user.diagnosa';
        $kondisi = kondisi::all();
        $gejala = gejala::all();
        return view('dashboard', compact('menu', 'gejala', 'kondisi'));
    }
    public function makeDiagnosa(Request $request)
    {
        // color
        $arcolor = ['#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700'];
        $inptanggal = date('Y-m-d H:i:s');
        $arbobot = ['0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1'];
        $argejala = [];
        for ($i = 0; $i < count($request->kondisi); $i++) {
            $arkondisi = explode("_", $request->kondisi[$i]);
            if (strlen($request->kondisi[$i]) > 1) {
                $argejala += array($arkondisi[0] => $arkondisi[1]);
            }
        }
        // get kondisi and make array
        $sqlkondisi = kondisi::all();
        foreach ($sqlkondisi as $key => $value) {
            $arkondisitext[$value->id_kondisi] = $value->kondisi;
        }
        // get kode penyakit and make array
        $sqlpenyakit = penyakit::all();
        foreach ($sqlpenyakit as $key => $value) {
            $arkodepenyakit[$value->id_penyakit] = $value->nama_penyakit;
            // $arkodepenyakit[$value->id_penyakit] = $value->detail_penyakit;
            // $arkodepenyakit[$value->id_penyakit] = $value->saran_penyakit;
            // $arkodepenyakit[$value->id_penyakit] = $value->image_penyakit;
        }
        // -------- perhitungan certainty factor (CF) ---------
        // --------------------- START ------------------------
        $arpenyakit = [];
        $sqlpenyakit = penyakit::all();
        foreach ($sqlpenyakit as $key => $rpenyakit) {
            $cf = 0;
            $sqlgejala = basisPengetahuan::where('id_penyakit', $value->id_penyakit)->get();
            $cflama = 0;
            foreach ($sqlgejala as $key => $rgejala) {
                $arkondisi = explode("_", $request->kondisi[0]);
                $gejala = $arkondisi[0];
                for ($i = 0; $i < count($request->kondisi); $i++) {
                    $arkondisi = explode("_", $request->kondisi[$i]);
                    $gejala = $arkondisi[0];
                    if ($rgejala->id_gejala == $gejala) {
                        $cf = ($rgejala->mb - $rgejala->md) * $arbobot[$arkondisi[1]];
                        if (($cf >= 0) && ($cf * $cflama >= 0)) {
                            $cflama = $cflama + ($cf * (1 - $cflama));
                        }
                        if ($cf * $cflama < 0) {
                            $cflama = ($cflama + $cf) / (1 - Math . Min(Math . abs($cflama), Math . abs($cf)));
                        }
                        if (($cf < 0) && ($cf * $cflama >= 0)) {
                            $cflama = $cflama + ($cf * (1 + $cflama));
                        }
                    }
                }
                if ($cflama > 0) {
                    $arpenyakit += array($rpenyakit->id_penyakit => number_format($cflama, 4));
                }
            }
            arsort($arpenyakit);

            $inpgejala = serialize($argejala);
            $inppenyakit = serialize($arpenyakit);

            $np1 = 0;
            foreach ($arpenyakit as $key1 => $value1) {
                $np1++;
                $idpkt1[$np1] = $key1;
                $vlpkt1[$np1] = $value1;
            }
        }
        hasil::create([
            'tanggal' => $inptanggal,
            'gejala' => $inpgejala,
            'penyakit' => $inppenyakit,
            'hasil_id' => $idpkt1[1],
            'hasil_nilai' => $vlpkt1[1],
        ]);
        // --------------------- END --------------------------
        $resultGejala = [];
        foreach ($argejala as $key => $value) {
            $resultGejala[] = (object) [
                "color" => $arcolor[$value],
                "kondisi_test" => $arkondisitext[$value],
                "data" => gejala::where('id_gejala', $key)->first(),
            ];
        }
        // send result gejala toview
        // $menu = 'user.hasilDiagnosa';
        // $showResultGejala = $resultGejala;
        // return view('dashboard', compact('menu', 'showResultGejala'));
        // exit;
        return response()->json(['gejala' => $resultGejala, 'arkondisi' => $argejala]);
        exit;
        if ($_POST['submit']) {

            $np = 0;
            foreach ($arpenyakit as $key => $value) {
                $np++;
                $idpkt[$np] = $key;
                $nmpkt[$np] = $arpkt[$key];
                $vlpkt[$np] = $value;
            }
            if ($argpkt[$idpkt[1]]) {
                $gambar = 'gambar/penyakit/' . $argpkt[$idpkt[1]];
            } else {
                $gambar = 'gambar/noimage.png';
            }
            echo "</table><div class='well well-small'><img class='card-img-top img-bordered-sm' style='float:right; margin-left:15px;' src='" . $gambar . "' height=200><h3>Hasil Diagnosa</h3>";
            echo "<div class='callout callout-default'>Jenis penyakit yang diderita adalah <b><h3 class='text text-success'>" . $nmpkt[1] . "</b> / " . round($vlpkt[1], 2) . " % (" . $vlpkt[1] . ")<br></h3>";
            echo "</div></div><div class='box box-info box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail</h3></div><div class='box-body'><h4>";
            echo $ardpkt[$idpkt[1]];
            echo "</h4></div></div>
                    <div class='box box-warning box-solid'><div class='box-header with-border'><h3 class='box-title'>Saran</h3></div><div class='box-body'><h4>";
            echo $arspkt[$idpkt[1]];
            echo "</h4></div></div>
                    <div class='box box-danger box-solid'><div class='box-header with-border'><h3 class='box-title'>Kemungkinan lain:</h3></div><div class='box-body'><h4>";
            for ($ipl = 2; $ipl < count($idpkt); $ipl++) {
                echo " <h4><i class='fa fa-caret-square-o-right'></i> " . $nmpkt[$ipl] . "</b> / " . round($vlpkt[$ipl], 2) . " % (" . $vlpkt[$ipl] . ")<br></h4>";
            }
            echo "</div></div>
                    </div>";
        } else {
            echo "
               <h2 class='text text-primary'>Diagnosa Penyakit</h2>  <hr>
               <div class='alert alert-success alert-dismissible'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                          <h4><i class='icon fa fa-exclamation-triangle'></i>Perhatian !</h4>
                          Silahkan memilih gejala sesuai dengan kondisi ayam anda, anda dapat memilih kepastian kondisi ayam dari pasti tidak sampai pasti ya, jika sudah tekan tombol proses (<i class='fa fa-search-plus'></i>)  di bawah untuk melihat hasil.
                        </div>
                  <form name=text_form method=POST action='diagnosa' >
                     <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
                     <tr><th>No</th><th>Kode</th><th>Gejala</th><th width='20%'>Pilih Kondisi</th></tr>";

            $sql3 = mysqli_query($conn, "SELECT * FROM gejala order by kode_gejala");
            $i = 0;
            while ($r3 = mysqli_fetch_array($sql3)) {
                $i++;
                echo "<tr><td class=opsi>$i</td>";
                echo "<td class=opsi>G" . str_pad($r3[kode_gejala], 3, '0', STR_PAD_LEFT) . "</td>";
                echo "<td class=gejala>$r3[nama_gejala]</td>";
                echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
                $s = "select * from kondisi order by id";
                $q = mysqli_query($conn, $s) or die($s);
                while ($rw = mysqli_fetch_array($q)) {
                    ?>
                    <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['kode_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
                    <?php
}
                echo '</select></td>';
                ?>
                  <script type="text/javascript">
                    $(document).ready(function () {
                      var arcolor = new Array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700');
                      setColor();
                      $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function () {
                        setColor();
                      });
                      function setColor()
                      {
                        var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
                        var color = arcolor[selectedItem.data("id")];
                        $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
                        console.log(color);
                      }
                    });
                  </script>
                  <?php
echo "</tr>";
            }
            echo "
                    <input class='float' type=submit data-toggle='tooltip' data-placement='top' title='Klik disini untuk melihat hasil diagnosa' name=submit value='&#xf00e;' style='font-family:Arial, FontAwesome'>
                    </tbody></table></form>";
        }
    }

}
