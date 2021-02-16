<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields = [
        'kode_menu',
        'tanggal_menu',
        'waktu_menu',
        'nama_menu',
        'keterangan_menu',
        'lauk_tambahan_menu',
        'foto_menu',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date'
    ];
    protected $useTimestamps = false;
}
