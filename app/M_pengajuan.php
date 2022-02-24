<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_pengajuan extends Model
{
    //
     protected $table = 'tbl_pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $fillable = ['id_pengajuan', 'id_suplier', 'id_pengadaan', 'proposal', 'anggaran', 'status'];
}
