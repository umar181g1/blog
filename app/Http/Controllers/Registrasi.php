<?php

namespace App\Http\Controllers;

use App\M_suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Response;

class Registrasi extends Controller
{
    //

    public function index()
    {
        return view('registrasi.registrasi');
    }

    public function registrasi(Request $request)
    {
        $this->validate($request, [
            'nama_usaha' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_npwp' => 'required',
            'password' => 'required'
        ]);

        if (M_suplier::create(
            [
                "nama_usaha" => $request->nama_usaha,
                "email" => $request->email,
                "no_npwp" => $request->no_npwp,
                "alamat" => $request->alamat,
                "password" => encrypt($request->password)
            ]
        )) {
            return redirect('/registrasi')->with('berhasil', 'data berhasil disimpan');
        } else {
            return redirect('/registrasi')->with('gagal', 'data gagal di simpan');
        }
    }
}
