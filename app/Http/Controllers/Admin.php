<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use App\M_admin;

class Admin extends Controller
{
    //
    public function index(){
        return view('admin.login');
    }


    public function loginAdmin(Request $request){
        $this->validate($request, [

            'email' => 'required',
            'password' => 'required'
        ]);
        $cek = M_admin::where('email', $request->email)->count();
        $pass =M_admin::where('email', $request->email)->get();

        if ($cek > 0) {
            foreach ($pass as $c) {
                if (decrypt($c->password) == $request->password) {
                    $key = env('APP_KEY');
                    $data = array(
                        "id_admin" => $c->id_admin
                    );
                    $jwt = JWT::encode($data, $key , 'HS256');
                    M_admin::where('id_admin', $c->id_admin)->update([
                        'token' => $jwt
                    ]);
                    Session::put('token', $jwt);
                    return redirect('/pengajuan')->with('berhasih', 'Selamat dtang kembali');
                } else {
                    return redirect('/loginAdmin')->with('gagal', 'Data Password Anda Salah');
                }
            }
        }else{
            return redirect('/loginAdmin')->with('gagal', 'Data Password Anda Salah');
        }
    }

    public function keluarAdmin(){
        $token = Session::get('token');

        if (M_admin::where('token', $token)->update([
            'token' => 'keluar'
        ])) {
            Session::put('token', "");
            return redirect('/masukAdmin')->with('berhasil', 'anda sudah log out silahkan login lagi');
        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');
        }

    }

    public function listAdmin(){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if ($tokenDb > 0) {
           $data['adm'] = M_admin::where('token', $token)->first();
           $data['admin'] = M_admin::where('status','1')->paginate(15);
           return view('admin.list', $data);
       }else{
        return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

    }

}

public function tambahAdmin(Request $request){
    $this->validate($request, [

        'nama' => 'required',
        'email' => 'required',
        'alamat' => 'required',
        'password' => 'required',
    ]);
    $token = Session::get('token');
    $tokenDb= M_admin::where('token', $token)->count();
    if($tokenDb > 0){
        if (M_admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'password' => encrypt($request->password),
        ])) {
            return redirect('/listAdmin')->with('berhasil', 'Data berhasil di simpan');
        }else{
            return redirect('/listAdmin')->with('gagal', 'Data gagal di simpan');
        }
    }else{
        return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

    }

}

public function ubahAdmin(Request $request){
    $this->validate($request, [

        'u_nama' => 'required',
        'u_email' => 'required',
        'u_alamat' => 'required',
    ]);
    $token = Session::get('token');
    $tokenDb= M_admin::where('token', $token)->count();
    if($tokenDb > 0){
        if (M_admin::where("id_admin" , $request->id_admin)->update([
            'nama' => $request->u_nama,
            'email' => $request->u_email,
            'alamat' => $request->u_alamat,
        ])) {
            return redirect('/listAdmin')->with('berhasil', 'Data berhasil di ubah');
        }else{
            return redirect('/listAdmin')->with('gagal', 'Data gagal di ubah');
        }
    }else{
        return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

    }

}

public function hapusAdmin($id){
    $token = Session::get('token');
    $tokenDb= M_admin::where('token', $token)->count();
    if($tokenDb > 0){
        if (M_admin::where("id_admin" , $id)->delete()) {
            return redirect('/listAdmin')->with('berhasil', 'Data berhasil di hapus');
        }else{
            return redirect('/listAdmin')->with('gagal', 'Data gagal di hapus');
        }
    }else{
        return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

    }

}

public function ubahPassword(Request $request){
  $token = Session::get('token');
  $tokenDb = M_admin::where('token', $token)->count();

  if ($tokenDb > 0) { 
    $key = env('APP_KEY');
    $sup = M_admin::where('token', $token)->first();
    $decode = JWT::decode($token , new Key($key, 'HS256'));
    $decode_array = (array) $decode;
    if (decrypt($sup->password) == $request->passwordLama) {
        if (M_admin::where('id_admin',$decode_array['id_admin'] )->update([
        "password" => encrypt($request->password),
    ])) {
        return redirect('/masukAdmin')->with('gagal', 'password berhasil di update');
    }else{
      return redirect('/pengajuan')->with('gagal', 'password gagal di update');
  }
}else{
 return redirect('/pengajuan')->with('gagal', 'password lama tidak sama');

}

}else{
    return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

}

}
}
