<?php

namespace App\Http\Controllers;

use App\M_suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use App\M_pengadaan;



class Home extends Controller{
    //
      public function index(){
        
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDB = M_suplier::where('token', $token)->count();
        if($tokenDB > 0){
            $data['token'] = $token;
    
        }else{
            $data['token'] = "Kosong";
        }
        $data['pengadaan'] = M_pengadaan::where('status','1')->paginate(2);
        return view('home.home' , $data);
    }
}
