<?php

namespace App\Http\Controllers;

use App\Models\basisPengetahuan;
use App\Models\gejala;
use App\Models\hasil;
use App\Models\kondisi;
use App\Models\penyakit;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
            $arpkt[$value->id_penyakit] = $value->nama_penyakit;
            $ardpkt[$value->id_penyakit] = $value->detail_penyakit;
            $arspkt[$value->id_penyakit] = $value->saran_penyakit;
            $argpkt[$value->id_penyakit] = $value->image_penyakit;
        }
        // -------- perhitungan certainty factor (CF) ---------
        // --------------------- START ------------------------
        $arpenyakit = [];
        $sqlpenyakit = penyakit::all();
        foreach ($sqlpenyakit as $key => $rpenyakit) {
            $cf = 0;
            $sqlgejala = basisPengetahuan::where('id_penyakit', $rpenyakit->id_penyakit)->get();
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
                            $cflama = ($cflama + $cf) / (1 - Min(abs($cflama), abs($cf)));
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
        $np = 0;
        foreach ($arpenyakit as $key => $value) {
            $np++;
            $idpkt[$np] = $key;
            $nmpkt[$np] = $arpkt[$key];
            $vlpkt[$np] = $value;
        }
        if ($argpkt[$idpkt[1]]) {
            // $gambar = 'images/penyakit/' . $argpkt[$idpkt[1]];
            $gambar = 'image_penyakit/' . $argpkt[$idpkt[1]];
        } else {
            $gambar = 'assets/images/noimage.png';
        }
        // send result gejala toview
        $menu = 'user.hasilDiagnosa';
        $jenisPenyakitDiderita = $nmpkt[1];
        $showResultGejala = $resultGejala;
        return view('dashboard', compact('menu', 'showResultGejala', 'gambar', 'vlpkt', 'nmpkt', 'idpkt', 'ardpkt', 'arspkt'));
        exit;
        return response()->json(['gejala' => $resultGejala, 'arkondisi' => $argejala]);

    }
    public function history()
    {
        $menu = 'history';
        $history = hasil::join('penyakit', 'hasil.hasil_id', '=', 'penyakit.id_penyakit')->paginate(15);
        return view('dashboard', compact('menu', 'history'));
    }
    public function chartHistory(Type $var = null)
    {
        $hasil = hasil::select('hasil_id')->groupBy('hasil_id')->get();
        $result = [];
        if ($hasil) {
            foreach ($hasil as $key => $value) {
                $penyakit = penyakit::where('id_penyakit', $value->hasil_id)->first();
                $result[] = [
                    'label' => $penyakit->nama_penyakit,
                    'data' => hasil::where('hasil_id', $value->hasil_id)->count(),
                ];
            }
        }
        return response()->json($result);
    }
    public function historyDetail(Request $request, $id = null)
    {
        if ($id == null) {
            return redirect('/');
        }
        $hasil_id = Crypt::decryptString($id);
        // color
        $arcolor = ['#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700'];
        $inptanggal = date('Y-m-d H:i:s');
        $arbobot = ['0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1'];
        $argejala = [];
        // for ($i = 0; $i < count($request->kondisi); $i++) {
        //     $arkondisi = explode("_", $request->kondisi[$i]);
        //     if (strlen($request->kondisi[$i]) > 1) {
        //         $argejala += array($arkondisi[0] => $arkondisi[1]);
        //     }
        // }
        // get kondisi and make array
        $sqlkondisi = kondisi::all();
        foreach ($sqlkondisi as $key => $value) {
            $arkondisitext[$value->id_kondisi] = $value->kondisi;
        }
        // get kode penyakit and make array
        $sqlpenyakit = penyakit::all();
        foreach ($sqlpenyakit as $key => $value) {
            $arpkt[$value->id_penyakit] = $value->nama_penyakit;
            $ardpkt[$value->id_penyakit] = $value->detail_penyakit;
            $arspkt[$value->id_penyakit] = $value->saran_penyakit;
            $argpkt[$value->id_penyakit] = $value->image_penyakit;
        }
        $sqlhasil = hasil::where('id_hasil', $hasil_id)->get();
        foreach ($sqlhasil as $key => $value) {
            $arpenyakit = unserialize($value->penyakit);
            $argejala = unserialize($value->gejala);
        }
        $np1 = 0;
        foreach ($arpenyakit as $key1 => $value1) {
            $np1++;
            $idpkt1[$np1] = $key1;
            $vlpkt1[$np1] = $value1;
        }
        $resultGejala = [];
        foreach ($argejala as $key => $value) {
            $resultGejala[] = (object) [
                "color" => $arcolor[$value],
                "kondisi_test" => $arkondisitext[$value],
                "data" => gejala::where('id_gejala', $key)->first(),
            ];
        }
        $np = 0;
        foreach ($arpenyakit as $key => $value) {
            $np++;
            $idpkt[$np] = $key;
            $nmpkt[$np] = $arpkt[$key];
            $vlpkt[$np] = $value;
        }
        if ($argpkt[$idpkt[1]]) {
            $gambar = 'image_penyakit/' . $argpkt[$idpkt[1]];
            // $gambar = 'image_penyakit/'.;
        } else {
            $gambar = 'assets/images/noimage.png';
        }
        // send result gejala toview
        $menu = 'user.hasilDiagnosa';
        $jenisPenyakitDiderita = $nmpkt[1];
        $showResultGejala = $resultGejala;
        return view('dashboard', compact('menu', 'showResultGejala', 'gambar', 'vlpkt', 'nmpkt', 'idpkt', 'ardpkt', 'arspkt'));
    }
    // use for support
    public function support(Type $var = null)
    {
        $menu = 'support';
        return view('dashboard', compact('menu'));
    }
    // keterangan
    public function keterangan(Type $var = null)
    {
        $menu = 'keterangan';
        $keterangan = post::all();
        return view('dashboard', compact('menu', 'keterangan'));
    }

}
