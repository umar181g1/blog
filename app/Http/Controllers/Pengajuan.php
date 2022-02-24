<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\M_admin;
use App\M_suplier;
use App\M_pengajuan;
use App\M_pengadaan;
use App\M_laporan;

class Pengajuan extends Controller
{
    //
    public function Pengajuan(){
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDB = M_admin::where('token', $token)->count();

        if($tokenDB > 0){
            $pengajuan = M_pengajuan::where('status','1')->paginate(15);

            $dataP = array();

            foreach ($pengajuan as $p ) {
                $pengadaan = M_pengadaan::where('id_pengadaan' , $p->id_pengadaan)->first();
                $sup = M_suplier::where('id_suplier', $p->id_suplier)->first();
                $dataP[]= array(
                    "id_pengajuan" => $p->id_pengajuan,
                    "nama_pengadaan" => $pengadaan->nama_pengadaan,
                    "gambar"    => $pengadaan->gambar,
                    "anggaran"  => $pengadaan->anggaran,
                    "proposal"  => $p->proposal,
                    "anggaran_pengajuan"  => $p->anggaran,
                    "status_pengajuan"  => $p->status,
                    "nama_suplier"  => $sup->nama_usaha,
                    "email_suplier" => $sup->email,
                    "alamat_suplier"  => $sup->alamat,  
                );
            }
             $data['adm'] = M_admin::where('token', $token)->first();
            $data['pengajuan'] = $dataP;
            return view('pengajuan.List', $data);
        }else{
            return redirect('/masukAdmin' , 'anda belom login');
        }

        
    }

    public function tambahPengajuan(Request $request){
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDb = M_suplier::where('token', $token)->count();
        $decode = JWT::decode($token , new Key($key, 'HS256'));
        $decode_array = (array) $decode;        

        if ($tokenDb > 0) {
            $this->validate($request, [
                'id_pengadaan' => 'required',
                'proposal' => 'required|mimes:pdf|max:10000',
                'anggaran' => ' required'
            ]);

            $cekPengajuan = M_pengajuan::where('id_suplier', $decode_array['id_suplier'])->where('id_pengadaan',$request->id_pengadaan)->count();


            if ($cekPengajuan == 0) {

                $path = $request->file('proposal')->store('public/proposal');

                if (M_pengajuan::create([
                    "id_pengadaan" => $request->id_pengadaan,
                    "id_suplier"     =>  $decode_array['id_suplier'],
                    "proposal"        => $path,
                    "anggaran"      => $request->anggaran,
                ])) {
                    return redirect('/listSup')->with('berhasil', 'data pengajuan berhasil di simpan');

                }else{
                    return redirect('/listSup')->with('gagal', 'data pengajuan gagal di simpan');

                }

            }else{
                return redirect('/listSup')->with('gagal', 'data pengajuan pernah di buat');
            }

            
        }else{
            return redirect('/masukSuplier')->with('gagal', 'anda telah logout');

        }

    }



    public function terimaPengajuan($id){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            if (M_pengajuan::where('id_pengajuan', $id)->update(
                [
                    "status" => "2"
                ]
            )) {
                return redirect('/pengajuan')->with('berhasil', 'Status Pengajuan berhasil Di Ubah');
            }else{
                return redirect('/pengajuan')->with('gagal', 'data gagal di simpan');
            }
        }else{
            return redirect('/masukAdmin')->with('gagal', 'Anda telah logout silahkan login');
        }

    }
    


    public function tolakPengajuan($id){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            if (M_pengajuan::where('id_pengajuan', $id)->update(
                [
                    "status" => "0"
                ]
            )) {
                return redirect('/pengajuan')->with('berhasil', 'Status Pengajuan berhasil Di Ubah');
            }else{
                return redirect('/pengajuan')->with('gagal', 'data gagal di simpan');
            }
        }else{
            return redirect('/masukAdmin')->with('gagal', 'Anda telah logout silahkan login');
        }

    }


    public function riwayatKu(){
       $key = env('APP_KEY');
       $token = Session::get('token');
       $tokenDb = M_suplier::where('token', $token)->count();
       $decode = JWT::decode($token , new Key($key, 'HS256'));
       $decode_array = (array) $decode;        

       if ($tokenDb > 0) {
        $pengajuan = M_pengajuan::where('id_suplier', $decode_array['id_suplier'])->get();

        $dataArr= array();
        foreach ($pengajuan as $p ) {
            $pengadaan = M_pengadaan::where('id_pengadaan' , $p->id_pengadaan)->first();
            $sup = M_suplier::where('id_suplier', $decode_array['id_suplier'])->first();

            $lapCount = M_laporan::where('id_pengajuan', $p->id_pengajuan)->count();
            $lap = M_laporan::where('id_pengajuan', $p->id_pengajuan)->first();

            if (  $lapCount > 0) {

              $lapLk =   $lap->laporan;
          }else{
              $lapLk = "-";

          }

          $dataArr[]= array(
            "id_pengajuan" => $p->id_pengajuan,
            "nama_pengadaan" => $pengadaan->nama_pengadaan,
            "gambar"    => $pengadaan->gambar,
            "anggaran"  => $pengadaan->anggaran,
            "proposal"  => $p->proposal,
            "anggaran_pengajuan"  => $p->anggaran,
            "status_pengajuan"  => $p->status,
            "nama_suplier"  => $sup->nama_usaha,
            "email_suplier" => $sup->email,
            "alamat_suplier"  => $sup->alamat,
            "laporan"       =>   $lapLk,  
        );
      }
       $data['sup'] = M_suplier::where('token', $token)->first();

      $data['pengajuan'] = $dataArr;

      return view('suplier.riwayatP' ,$data);

  }else{
    return redirect('/listSup')->with('gagal', 'Anda telah logout silahkan login');

}
}


public function tambahLaporan(Request $request){
    $key = env('APP_KEY');
    $token = Session::get('token');
    $tokenDb = M_suplier::where('token', $token)->count();
    $decode = JWT::decode($token , new Key($key, 'HS256'));
    $decode_array = (array) $decode;        

    if ($tokenDb > 0) {
        $this->validate($request, [
            'id_pengajuan' => 'required',
            'laporan' => 'required|mimes:pdf|max:10000',

        ]);

        $cekLaporan = M_laporan::where('id_suplier', $decode_array['id_suplier'])->where('id_pengajuan',$request->id_pengajuan)->count();


        if ($cekLaporan == 0) {

            $path = $request->file('laporan')->store('public/laporan');

            if (M_laporan::create([
                "id_pengajuan" => $request->id_pengajuan,
                "id_suplier"     =>  $decode_array['id_suplier'],
                "laporan"        => $path,

            ])) {
                return redirect('/riwayatKu')->with('berhasil', 'laporan berhasil di simpan');

            }else{
                return redirect('/riwayatKu')->with('gagal', 'laporan gagal di simpan');

            }

        }else{
            return redirect('/riwayatKu')->with('gagal', 'laporan pernah di buat');
        }


    }else{
        return redirect('/masukSuplier')->with('gagal', 'anda telah logout');

    }

}

public function Laporan(){
    $key = env('APP_KEY');
    $token = Session::get('token');
    $tokenDB = M_admin::where('token', $token)->count();

    if($tokenDB > 0){
        $pengajuan = M_pengajuan::where('status','2')->paginate(15);

        $dataP = array();

        foreach ($pengajuan as $p ) {
            $pengadaan = M_pengadaan::where('id_pengadaan' , $p->id_pengadaan)->first();
            $sup = M_suplier::where('id_suplier', $p->id_suplier)->first();
            $c_laporan = M_laporan::where('id_pengajuan', $p->id_pengajuan)->count();
            $laporan = M_laporan::where('id_pengajuan', $p->id_pengajuan)->first();

            if ($c_laporan > 0) {

              $dataP[]= array(
                "id_pengajuan" => $p->id_pengajuan,
                "nama_pengadaan" => $pengadaan->nama_pengadaan,
                "gambar"    => $pengadaan->gambar,
                "anggaran"  => $pengadaan->anggaran,
                "proposal"  => $p->proposal,
                "anggaran_pengajuan"  => $p->anggaran,
                "status_pengajuan"  => $p->status,
                "nama_suplier"  => $sup->nama_usaha,
                "email_suplier" => $sup->email,
                "alamat_suplier"  => $sup->alamat,  
                "laporan"   =>  $laporan->laporan,
                "id_laporan"   =>  $laporan->id_laporan,
            );
          }

      }
       $data['adm'] = M_admin::where('token', $token)->first();
      $data['pengajuan'] = $dataP;

      return view('admin.laporan', $data);
  }else{
    return redirect('/masukAdmin' , 'anda belom login');
}


}

public function selesaiPengajuan($id){
    $token = Session::get('token');
    $tokenDb = M_admin::where('token', $token)->count();

    if ($tokenDb > 0) {
        if (M_pengajuan::where('id_pengajuan', $id)->update(
            [
                "status" => "3"
            ]
        )) {
            return redirect('/Laporan')->with('berhasil', 'Status laporan selesai');
        }else{
            return redirect('/Laporan')->with('gagal', 'data gagal di simpan');
        }
    }else{
        return redirect('/masukAdmin')->with('gagal', 'Anda telah logout silahkan login');
    }

}

public function pengajuanSelesai(){
   $key = env('APP_KEY');
   $token = Session::get('token');
   $tokenDb = M_suplier::where('token', $token)->count();
   $decode = JWT::decode($token , new Key($key, 'HS256'));
   $decode_array = (array) $decode;        

   if ($tokenDb > 0) {
    $pengajuan = M_pengajuan::where('id_suplier', $decode_array['id_suplier'])->where('status','3')->get();

    $dataArr= array();
    foreach ($pengajuan as $p ) {
        $pengadaan = M_pengadaan::where('id_pengadaan' , $p->id_pengadaan)->first();
        $sup = M_suplier::where('id_suplier', $decode_array['id_suplier'])->first();

        $lapCount = M_laporan::where('id_pengajuan', $p->id_pengajuan)->count();
        $lap = M_laporan::where('id_pengajuan', $p->id_pengajuan)->first();

        if (  $lapCount > 0) {

          $lapLk =   $lap->laporan;
      }else{
          $lapLk = "-";

      }

      $dataArr[]= array(
        "id_pengajuan" => $p->id_pengajuan,
        "nama_pengadaan" => $pengadaan->nama_pengadaan,
        "gambar"    => $pengadaan->gambar,
        "anggaran"  => $pengadaan->anggaran,
        "proposal"  => $p->proposal,
        "anggaran_pengajuan"  => $p->anggaran,
        "status_pengajuan"  => $p->status,
        "nama_suplier"  => $sup->nama_usaha,
        "email_suplier" => $sup->email,
        "alamat_suplier"  => $sup->alamat,
        "laporan"       =>   $lapLk,  
    
    );
  }
   $data['sup'] = M_suplier::where('token', $token)->first();

  $data['pengajuan'] = $dataArr;

  return view('suplier.pengajuanSelesai' ,$data);

}else{
    return redirect('/listSup')->with('gagal', 'Anda telah logout silahkan login');

}
}

public function tolakLaporan($id){
        $token = Session::get('token');
        $tokenDb = M_admin::where('token', $token)->count();

        if($tokenDb > 0 ){
            $laporan = M_laporan::where('id_laporan', $id)->count();

            if($laporan > 0){
                $datalaporan = M_laporan::where('id_laporan', $id)->first();

                if (Storage::delete($datalaporan->laporan)) {
                    if (M_laporan::where('id_laporan', $id)->delete()) {
                        return redirect('/Laporan')->with('berhasil', 'data berhasil di tolak');
                    }


                  
                }else{
                    return redirect('/Laporan')->with('gagal', 'data gagal di  tolak');

                }

            }else{
                return redirect('/Laporan')->with('gagal', 'data tidak di temukan');

            }


        }else{
            return redirect('/masukAdmin')->with('gagal', 'anda telah logout');


        }


    }

}
