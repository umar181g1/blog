<?php

namespace App\Http\Controllers;

use App\M_suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use App\M_admin;



class Supleir extends Controller
{
    //
    public function index()
    {
        return view('suplier.login');
    }

    public function masukSuplier(Request $request)
    {
        $this->validate($request, [

            'email' => 'required',
            'password' => 'required'
        ]);
        $cek = M_suplier::where('email', $request->email)->count();
        $pass =M_suplier::where('email', $request->email)->get();

        if ($cek > 0) {
            foreach ($pass as $c) {
                if (decrypt($c->password) == $request->password) {
                    $key = env('APP_KEY');
                    $data = array(
                        "id_suplier" => $c->id_suplier
                    );
                    $jwt = JWT::encode($data, $key , 'HS256');
                    M_suplier::where('id_suplier', $c->id_suplier)->update([
                        'token' => $jwt
                    ]);
                    Session::put('token', $jwt);
                    return redirect('/listSup');
                } else {
                    return redirect('/login')->with('gagal', 'Data Password Anda Salah');
                }
            }
        } else {
            return redirect('/login')->with('gagal', 'Data Email Tidak Terdaftar');
        }
    }

    public function keluar(){
        $token = Session::get('token');

        if (M_suplier::where('token', $token)->update([
            'token' => 'keluar'
        ])) {
            Session::put('token', "");
            return redirect('/login');
        }else{
            return redirect('/login')->with('gagal', 'anda gagal logout');
        }

    }

    public function listSupleir(){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if ($tokenDb > 0) {
         $data['adm'] = M_admin::where('token', $token)->first();
         $data['suplier'] = M_suplier::paginate(15);
         return view('admin.listSuplier', $data);
     }else{
        return redirect('/login')->with('gagal', 'anda telah logout');

    }

}

public function nonAktif($id){
    $token = Session::get('token');
    $tokenDb = M_admin::where('token', $token)->count();

    if ($tokenDb > 0) {
        if (M_suplier::where('id_suplier', $id )->update([
            "status" => 0,
        ])) {
            return redirect('/listSupleir')->with('berhasil', 'data berhasil di update');
        }else{
          return redirect('/listSupleir')->with('gagal', 'data gagal di update');
      }


  }else{
    return redirect('/login')->with('gagal', 'anda telah logout');

}

}
public function Aktif($id){
    $token = Session::get('token');
    $tokenDb = M_admin::where('token', $token)->count();

    if ($tokenDb > 0) {
        if (M_suplier::where('id_suplier', $id )->update([
            "status" => 1,
        ])) {
            return redirect('/listSupleir')->with('berhasil', 'data berhasil di update');
        }else{
          return redirect('/listSupleir')->with('gagal', 'data gagal di update');
      }


  }else{
    return redirect('/login')->with('gagal', 'anda telah logout');

}

}

public function ubahPassword(Request $request){
  $token = Session::get('token');
  $tokenDb = M_suplier::where('token', $token)->count();

  if ($tokenDb > 0) { 
    $key = env('APP_KEY');
    $sup = M_suplier::where('token', $token)->first();
    $decode = JWT::decode($token , new Key($key, 'HS256'));
    $decode_array = (array) $decode;
    if (decrypt($sup->password) == $request->passwordLama) {
       if (M_suplier::where('id_suplier',$decode_array['id_suplier'] )->update([
        "password" => encrypt($request->password),
    ])) {
        return redirect('/login')->with('gagal', 'password berhasil di update');
    }else{
      return redirect('/login')->with('gagal', 'password gagal di update');
  }
}else{
   return redirect('/listSup')->with('gagal', 'password lama tidak sama');

}

}else{
    return redirect('/login')->with('gagal', 'anda telah logout');

}

}
}
