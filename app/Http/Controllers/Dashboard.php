<?php

namespace App\Http\Controllers;

use App\Models\basisPengetahuan;
use App\Models\gejala;
use App\Models\penyakit;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class Dashboard extends Controller
{
    public function Dashboard(Request $request)
    {
        $menu = 'beranda';
        $penyakit = penyakit::count();
        $gejala = gejala::count();
        $user = User::count();
        $pengetahuan = basisPengetahuan::count();
        return view('dashboard', compact('menu', 'penyakit', 'gejala', 'user', 'pengetahuan'));
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
        if ($request->image_penyakit) {
            $rules[] = ['image_penyakit' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'];
            $messages[] = [
                'image_penyakit.image' => 'Foto Produk harus berupa gambar',
                'image_penyakit.mimes' => 'Foto Produk harus berupa gambar',
                'image_penyakit.max' => 'Foto Produk tidak boleh lebih dari 2MB'];
        }
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
                $filename = '-';
                if ($request->image_penyakit) {
                    $image = $request->image_penyakit;
                    $destionationPath = 'image_penyakit/';
                    $extention = $image->getClientOriginalExtension();
                    $filename = time() . "." . $extention;
                    $image->move($destionationPath, $filename);
                }
                $penyakit = new penyakit;
                $penyakit->nama_penyakit = $request->nama_penyakit;
                $penyakit->detail_penyakit = $request->detail_penyakit;
                $penyakit->saran_penyakit = $request->saran_penyakit;
                $penyakit->image_penyakit = $filename;
                $penyakit->save();
                $response = [
                    'status' => 'success',
                    'msg' => 'Data berhasil disimpan',
                ];}
        }
        $response[] = ['data' => $request->all()];
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
        if ($request->image_penyakit) {
            $rules[] = ['image_penyakit' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'];
            $messages[] = [
                'image_penyakit.image' => 'Foto Produk harus berupa gambar',
                'image_penyakit.mimes' => 'Foto Produk harus berupa gambar',
                'image_penyakit.max' => 'Foto Produk tidak boleh lebih dari 2MB'];
        }
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors()->all(),
            ];
        } else {

            $penyakit = penyakit::find($request->id_penyakit);
            if ($request->image_penyakit) {
                $checkImage = penyakit::where('id_penyakit', $request->id_penyakit)->first()->image_penyakit;
                if (file_exists('image_penyakit/' . $checkImage)) {
                    // unlink('image_penyakit/' . $checkImage);
                }
                $image = $request->image_penyakit;
                $destionationPath = 'image_penyakit/';
                $extention = $image->getClientOriginalExtension();
                $filename = time() . "." . $extention;
                $image->move($destionationPath, $filename);
                $penyakit->image_penyakit = $filename;
            }
            $penyakit->nama_penyakit = $request->nama_penyakit;
            $penyakit->detail_penyakit = $request->detail_penyakit;
            $penyakit->saran_penyakit = $request->saran_penyakit;
            $penyakit->save();
            $response = [
                'status' => 'success',
                'msg' => 'Data berhasil disimpan',
            ];
        }
        return response()->json($response);
    }
    // use for reasearh
    public function pengetahuan(Type $var = null)
    {
        $menu = 'pengetahuan';
        $pengetahuan = basisPengetahuan::orderBy('id_pengetahuan', 'desc')->join('penyakit', 'basis_pengetahuan.id_penyakit', '=', 'penyakit.id_penyakit')->join('gejala', 'basis_pengetahuan.id_gejala', '=', 'gejala.id_gejala')->get();
        return view('dashboard', compact('menu', 'pengetahuan'));
    }
    public function pengetahuanAdd()
    {
        $menu = 'pengetahuanAdd';
        $penyakit = penyakit::orderBy('id_penyakit', 'desc')->get();
        $gejala = gejala::orderBy('id_gejala', 'desc')->get();
        return view('dashboard', compact('menu', 'penyakit', 'gejala'));
    }
    public function pengetahuanStore(Request $request)
    {
        $rules = [
            'id_penyakit' => 'required',
            'id_gejala' => 'required',
            'md' => 'required|numeric',
            'mb' => 'required|numeric',
        ];
        $messages = [
            'id_penyakit.required' => 'Penyakit harus diisi',
            'id_gejala.required' => 'Gejala harus diisi',
            'md.required' => 'MD harus diisi',
            'mb.required' => 'MB harus diisi',
            'md.numeric' => 'MD harus berupa angka',
            'mb.numeric' => 'MB harus berupa angka',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors(),
            ];
        } else {
            $checkPengetahuan = basisPengetahuan::where('id_penyakit', $request->id_penyakit)->where('id_gejala', $request->id_gejala)->first();
            if ($checkPengetahuan) {
                $response = [
                    'status' => 'data_ready',
                    'msg' => 'Pengetahuan sudah ada',
                ];
            } else {
                $pengetahuan = new basisPengetahuan;
                $pengetahuan->id_penyakit = $request->id_penyakit;
                $pengetahuan->id_gejala = $request->id_gejala;
                $pengetahuan->md = $request->md;
                $pengetahuan->mb = $request->mb;
                $pengetahuan->save();
                $response = [
                    'status' => 'success',
                    'msg' => 'Data berhasil disimpan',
                ];}
        }
        return response()->json($response);
    }
    public function pengetahuanDelete(Request $request)
    {
        $pengetahuan = basisPengetahuan::find($request->id_pengetahuan);
        $pengetahuan->delete();
        $response = [
            'status' => 'success',
            'msg' => 'Data berhasil dihapus',
        ];
        return response()->json($response);
    }
    public function pengetahuanEdit($id_pengetahuan)
    {
        $menu = 'pengetahuanEdit';
        $pengetahuan = basisPengetahuan::find($id_pengetahuan);
        $penyakit = penyakit::all();
        $gejala = gejala::all();
        return view('dashboard', compact('menu', 'pengetahuan', 'penyakit', 'gejala'));
    }
    public function pengetahuanUpdate(Request $request)
    {
        $rules = [
            'id_penyakit' => 'required',
            'id_gejala' => 'required',
            'md' => 'required|numeric',
            'mb' => 'required|numeric',
        ];
        $messages = [
            'id_penyakit.required' => 'Penyakit harus diisi',
            'id_gejala.required' => 'Gejala harus diisi',
            'md.required' => 'MD harus diisi',
            'mb.required' => 'MB harus diisi',
            'md.numeric' => 'MD harus berupa angka',
            'mb.numeric' => 'MB harus berupa angka',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors()->all(),
            ];
        } else {
            $pengetahuan = basisPengetahuan::find($request->id_pengetahuan);
            $pengetahuan->id_penyakit = $request->id_penyakit;
            $pengetahuan->id_gejala = $request->id_gejala;
            $pengetahuan->md = $request->md;
            $pengetahuan->mb = $request->mb;
            $pengetahuan->save();
            $response = [
                'status' => 'success',
                'msg' => 'Data berhasil disimpan',
            ];
        }
        return response()->json($response);
    }
    // use for about app
    public function about(Type $var = null)
    {
        $menu = 'about';
        return view('dashboard', compact('menu'));
    }
    // post
    public function post(Type $var = null)
    {
        $menu = 'post';
        $post = post::paginate(15);
        return view('dashboard', compact('menu', 'post'));
    }
    public function postAdd(Type $var = null)
    {
        $menu = 'postAdd';
        return view('dashboard', compact('menu'));
    }
    public function postStore(Request $request)
    {
        $rules = [
            'detail_post' => 'required',
            'saran_post' => 'required',
            'nama_post' => 'required',
        ];
        $messages = [
            'detail_post.required' => 'Detail Keterangan Tidak Boleh Kosong',
            'saran_post.required' => 'Saran Keterangan Tidak Boleh Kosong',
            'nama_post' => 'Nama Keterangan Tidak Boleh Kosong',
        ];
        if ($request->gambar) {
            $rules[] = ['gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'];
            $messages[] = [
                'gambar.image' => 'Foto Produk harus berupa gambar',
                'gambar.mimes' => 'Foto Produk harus berupa gambar',
                'gambar.max' => 'Foto Produk tidak boleh lebih dari 2MB'];
        }
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors(),
            ];
        } else {
            $filename = null;
            if ($request->gambar) {
                $image = $request->gambar;
                $destionationPath = 'image_penyakit/';
                $extention = $image->getClientOriginalExtension();
                $filename = time() . "-image-post." . $extention;
                $image->move($destionationPath, $filename);
            }
            $post = new post;
            $post->nama_post = $request->nama_post;
            $post->detail_post = $request->detail_post;
            $post->saran_post = $request->saran_post;
            $post->gambar = $filename;
            $post->save();
            $response = [
                'status' => 'success',
                'msg' => 'Data post berhasil di simpan',
            ];

        }
        return response()->json($response);
    }
    public function postEdit($id = null)
    {
        if ($id == null) {
            return redirect('/');
        }
        $menu = 'postEdit';
        $data = post::find(Crypt::decryptString($id))->first();
        return view('dashboard', compact('menu', 'data'));
    }
    public function postUpdate(Request $request)
    {
        $rules = [
            'detail_post' => 'required',
            'saran_post' => 'required',
            'nama_post' => 'required',
        ];
        $messages = [
            'detail_post.required' => 'Detail Keterangan Tidak Boleh Kosong',
            'saran_post.required' => 'Saran Keterangan Tidak Boleh Kosong',
            'nama_post' => 'Nama Keterangan Tidak Boleh Kosong',
        ];
        if ($request->gambar) {
            $rules[] = ['gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'];
            $messages[] = [
                'gambar.image' => 'Foto Produk harus berupa gambar',
                'gambar.mimes' => 'Foto Produk harus berupa gambar',
                'gambar.max' => 'Foto Produk tidak boleh lebih dari 2MB'];
        }
        $validation = Validator::make($request->all(), $rules, $messages);
        if ($validation->fails()) {
            $response = [
                'status' => 'failed',
                'msg' => $validation->errors(),
            ];
        } else {
            $post = post::find($request->id);
            if ($request->gambar) {
                $image = $request->gambar;
                $destionationPath = 'image_penyakit/';
                $extention = $image->getClientOriginalExtension();
                $filename = time() . "-image-post." . $extention;
                $image->move($destionationPath, $filename);
                $post->gambar = $filename;
            }
            $post->nama_post = $request->nama_post;
            $post->detail_post = $request->detail_post;
            $post->saran_post = $request->saran_post;
            $post->save();
            $response = [
                'status' => 'success',
                'msg' => 'Data post berhasil di simpan',
            ];

        }
        return response()->json($response);
    }
    public function postDelete(Request $request)
    {
        $post = post::find($request->id);
        $post->delete();
        $response = [
            'status' => 'success',
            'msg' => 'Data berhasil dihapus',
        ];
        return response()->json($response);
    }

}
