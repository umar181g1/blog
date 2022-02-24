<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use App\M_admin;
use App\M_pengadaan;
use App\M_suplier;
use Illuminate\Support\Facades\Storage;

class Pengadaan extends Controller
{
    //

    public function index(){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();
        if ($tokenDb > 0) {
             $data['adm'] = M_admin::where('token', $token)->first();
            $data['pengadaan'] = M_pengadaan::where('status','1')->paginate(15);
            return view('pengadaan.list', $data);
        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');
        }

    }

    public function tambahPg(Request $request){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            $this->validate($request, [
                'nama_pengadaan' => 'required',
                'deskripsi' => 'required',
                'gambar' => 'required|image|mimes:jpg,png,gif|max:10000',
                'anggaran' => ' required'
            ]);

            $path = $request->file('gambar')->store('public/gambar');

            if (M_pengadaan::create([
                "nama_pengadaan" => $request->nama_pengadaan,
                "deskripsi"     => $request->deskripsi,
                "gambar"        => $path,
                "anggaran"      => $request->anggaran,
            ])) {
                return redirect('/listPg')->with('berhasil', 'data berhasil di simpan');
                
            }else{
                return redirect('/listPg')->with('gagal', 'data gagal di simpan');

            }
        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

        }

    }

    public function hapusGambar($id){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if($tokenDb > 0 ){
            $pengadaan = M_pengadaan::where("id_pengadaan", $id)->count();

            if($pengadaan > 0){
                $dataPengadaan = M_pengadaan::where("id_pengadaan", $id)->first();

                if (Storage::delete($dataPengadaan->gambar)) {
                    if (M_pengadaan::where("id_pengadaan", $id)->update(["gambar" => "."])) {
                        return redirect('/listPg')->with('berhasil', 'data berhasil di hapus');
                    }
                    echo "id_pengadaan";
                }else{
                    return redirect('/listPg')->with('gagal', 'data gagal di hapus');

                }

            }else{
                return redirect('/listPg')->with('gagal', 'data tida di temukan');

            }


        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');


        }


    }

    public function uploadgambar(Request $request){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            $this->validate($request, [
                'gambar' => 'required|image|mimes:jpg,png,gif|max:10000',

            ]);

            $path = $request->file('gambar')->store('public/gambar');

            if (M_pengadaan::where('id_pengadaan', $request->id_pengadaan )->update([
                "gambar"        => $path,
            ])) {
                return redirect('/listPg')->with('berhasil', 'data berhasil di simpan');
                
            }else{
                return redirect('/listPg')->with('gagal', 'data gagal di simpan');

            }
        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

        }

    }

    public function hapusData($id){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if($tokenDb > 0 ){
            $pengadaan = M_pengadaan::where("id_pengadaan", $id)->count();

            if($pengadaan > 0){
                $dataPengadaan = M_pengadaan::where("id_pengadaan", $id)->first();

                if (Storage::delete($dataPengadaan->gambar)) {
                    if (M_pengadaan::where("id_pengadaan", $id)->delete()) {
                        return redirect('/listPg')->with('berhasil', 'data berhasil di hapus');
                    }
                    echo "id_pengadaan";
                }else{
                    return redirect('/listPg')->with('gagal', 'data gagal di hapus');

                }

            }else{
                return redirect('/listPg')->with('gagal', 'data tida di temukan');

            }


        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');


        }


    }

    public function ubahData(Request $request){
        $this->validate($request, [

            'u_nama_pengadaan' => 'required',
            'u_deskripsi' => 'required',
            'u_anggaran' => 'required',
        ]);
        $token = Session::get('token');
        $tokenDb= M_admin::where('token', $token)->count();
        if($tokenDb > 0){
            if (M_pengadaan::where("id_pengadaan" , $request->id_pengadaan)->update([
                'nama_pengadaan' => $request->u_nama_pengadaan,
                'deskripsi' => $request->u_deskripsi,
                'anggaran' => $request->u_anggaran,
            ])) {
                return redirect('/listPg')->with('berhasil', 'Data berhasil di ubah');
            }else{
                return redirect('/listPg')->with('gagal', 'Data gagal di ubah');
            }
        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');

        }

    }

    public function listSup(){
        $token = Session::get('token');
        $tokenDb = M_suplier::where('token', $token)->count();
        if ($tokenDb > 0) {
          $data['sup'] = M_suplier::where('token', $token)->first();
          $data['pengadaan'] = M_pengadaan::where('status','1')->paginate(15);
          return view('suplier.pengadaan', $data);
      }else{
        return redirect('/login')->with('gagal', 'anda telah logout');
    }

}



}
