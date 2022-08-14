<?php

namespace App\Http\Controllers;

use App\Models\gejala;
use App\Models\penyakit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Dashboard extends Controller
{
    public function Dashboard(Request $request)
    {
        $menu = 'beranda';
        return view('dashboard', compact('menu'));
    }
    public function viewLogin(Request $request)
    {
        $menu = 'login';
        return view('dashboard', compact('menu'));
    }
    public function verification(Request $request)
    {
        $creditial = $request->only('email', 'password');
        if (Auth::attempt($creditial)) {
            $user = User::where('email', $creditial['email'])->first();
            if ($user) {
                $request->session()->put('user', $user);
                return redirect('/');
            } else {
                return redirect('error');
            }
        } else {
            return redirect('error');
        }
    }
    public function DashboardAdmin(Request $request)
    {
        $menu = 'admin';
        $dataAdmin = User::all();
        return view('dashboard', compact('menu', 'dataAdmin'));
    }
    public function gejala(Request $request)
    {
        $menu = 'gejala';
        $gejala = gejala::orderBy('id_gejala', 'desc')->get();
        return view('dashboard', compact('menu', 'gejala'));
    }
    public function gejalaAdd(Request $request)
    {
        $menu = 'gejalaAdd';
        return view('dashboard', compact('menu'));
    }
    public function gejalaStore(Request $request)
    {
        $rules = [
            'nama_gejala' => 'required',
        ];
        $messages = [
            'nama_gejala.required' => 'Gejala harus diisi',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors()->all(),
            ];
        } else {
            $checkGejala = gejala::where('nama_gejala', $request->nama_gejala)->first();
            if ($checkGejala) {
                $response = [
                    'status' => 'data_ready',
                    'msg' => 'Gejala sudah ada',
                ];
            } else {
                $gejala = new gejala;
                $gejala->nama_gejala = $request->nama_gejala;
                $gejala->kode_gejala = 'G' . rand(100, 999);
                $gejala->save();
                $response = [
                    'status' => 'success',
                    'msg' => 'Data berhasil disimpan',
                ];}
        }
        return response()->json($response);
    }
    public function gejalaDelete(Request $request)
    {
        $gejala = gejala::find($request->id_gejala);
        $gejala->delete();
        $response = [
            'status' => 'success',
            'msg' => 'Data berhasil dihapus',
        ];
        return response()->json($response);
    }
    public function gejalaEdit($id)
    {
        $menu = 'gejalaEdit';
        $gejala = gejala::find($id);
        return view('dashboard', compact('menu', 'gejala'));
    }
    public function gejalaUpdate(Request $request)
    {
        $rules = [
            'nama_gejala' => 'required',
        ];
        $messages = [
            'nama_gejala.required' => 'Gejala harus diisi',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors()->all(),
            ];
        } else {
            $checkGejala = gejala::where('nama_gejala', $request->nama_gejala)->first();
            if ($checkGejala) {
                $response = [
                    'status' => 'data_ready',
                    'msg' => 'Gejala sudah ada',
                ];
            } else {
                $gejala = gejala::find($request->id_gejala);
                $gejala->nama_gejala = $request->nama_gejala;
                $gejala->save();
                $response = [
                    'status' => 'success',
                    'msg' => 'Data berhasil disimpan',
                ];}
        }
        return response()->json($response);
    }
    public function penyakit()
    {
        $menu = 'penyakit';
        $penyakit = penyakit::orderBy('id_penyakit', 'desc')->get();
        return view('dashboard', compact('menu', 'penyakit'));
    }
    public function penyakitAdd()
    {
        $menu = 'penyakitAdd';
        return view('dashboard', compact('menu'));
    }
    public function penyakitStore(Request $request)
    {
        $rules = [
            'nama_penyakit' => 'required',
        ];
        $messages = [
            'nama_penyakit.required' => 'Penyakit harus diisi',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors()->all(),
            ];
        } else {
            $checkPenyakit = penyakit::where('nama_penyakit', $request->nama_penyakit)->first();
            if ($checkPenyakit) {
                $response = [
                    'status' => 'data_ready',
                    'msg' => 'Penyakit sudah ada',
                ];
            } else {
                $penyakit = new penyakit;
                $penyakit->nama_penyakit = $request->nama_penyakit;
                $penyakit->detail_penyakit = $request->det_penyakit;
                $penyakit->saran_penyakit = $request->saran_penyakit;
                $penyakit->save();
                $response = [
                    'status' => 'success',
                    'msg' => 'Data berhasil disimpan',
                ];}
        }
        return response()->json($response);
    }
    public function penyakitDelete(Request $request)
    {
        $penyakit = penyakit::find($request->id_penyakit);
        $penyakit->delete();
        $response = [
            'status' => 'success',
            'msg' => 'Data berhasil dihapus',
        ];
        return response()->json($response);
    }
    public function penyakitEdit($id_penyakit)
    {
        $menu = 'penyakitEdit';
        $penyakit = penyakit::find($id_penyakit);
        return view('dashboard', compact('menu', 'penyakit'));
    }
    public function penyakitUpdate(Request $request)
    {
        $rules = [
            'nama_penyakit' => 'required',
        ];
        $messages = [
            'nama_penyakit.required' => 'Penyakit harus diisi',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors()->all(),
            ];
        } else {
            $checkPenyakit = penyakit::where('nama_penyakit', $request->nama_penyakit)->first();
            if ($checkPenyakit) {
                $response = [
                    'status' => 'data_ready',
                    'msg' => 'Penyakit sudah ada',
                ];
            } else {
                $penyakit = penyakit::find($request->id_penyakit);
                $penyakit->nama_penyakit = $request->nama_penyakit;
                $penyakit->detail_penyakit = $request->det_penyakit;
                $penyakit->saran_penyakit = $request->saran_penyakit;
                $penyakit->save();
                $response = [
                    'status' => 'success',
                    'msg' => 'Data berhasil disimpan',
                ];}
        }
        return response()->json($response);
    }
}
