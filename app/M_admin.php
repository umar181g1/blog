<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_admin extends Model
{
    //
    protected $table = 'tbl_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = ['id_admin', 'nama', 'email', 'alamat',  'password', 'token', 'status'];
}
