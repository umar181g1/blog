<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'Home@index');
Route::get('/registrasi', 'Registrasi@index');
Route::post('/simpanRegis' , 'Registrasi@registrasi');
Route::get('/login', 'Supleir@index' );
Route::post('/login', 'Supleir@masukSuplier' );
Route::get('/keluar', 'Supleir@keluar' );


//Route Admin
Route::get('/masukAdmin' , 'Admin@index');
Route::post('/loginAdmin', 'Admin@loginAdmin' );
Route::get('/pengajuan', 'Pengajuan@Pengajuan');
Route::get('/keluarAdmin', 'Admin@keluarAdmin');
Route::get('/listAdmin', 'Admin@listAdmin');
Route::post('/tambahAdmin', 'Admin@tambahAdmin');
Route::post('/ubahAdmin', 'Admin@ubahAdmin');
Route::get('/hapusAdmin/{id}', 'Admin@hapusAdmin');
Route::get('/listPg','Pengadaan@index');
Route::post('/tambahPg','Pengadaan@tambahPg');
Route::get('/hapusgambar/{id}','Pengadaan@hapusGambar');
Route::post('/tambahgambar','Pengadaan@uploadgambar');
Route::get('/hapusdata/{id}','Pengadaan@hapusData');
Route::post('/ubahPasswordadm', 'Admin@ubahPassword');

Route::post('/ubahData', 'Pengadaan@ubahData');


//Route Suplier
Route::get('/listSup', 'Pengadaan@listSup');
Route::post('/tambahPengajuan', 'Pengajuan@tambahPengajuan');
Route::get('/terimaPengajuan/{id}','Pengajuan@terimaPengajuan');
Route::get('/tolakPengajuan/{id}','Pengajuan@tolakPengajuan');
Route::get('/riwayatKu','Pengajuan@riwayatKu');
Route::post('/tambahLaporan', 'Pengajuan@tambahLaporan');
Route::get('/Laporan','Pengajuan@Laporan');
Route::get('/selesaiPengajuan/{id}','Pengajuan@selesaiPengajuan');
Route::get('/pengajuanSelesai','Pengajuan@pengajuanSelesai');
Route::get('/tolakLaporan/{id}','Pengajuan@tolakLaporan');
Route::get('/listSupleir', 'Supleir@listSupleir');
Route::get('/nonAktif/{id}', 'Supleir@nonAktif');
Route::get('/Aktif/{id}', 'Supleir@Aktif');
Route::post('/ubahPassword', 'Supleir@ubahPassword');