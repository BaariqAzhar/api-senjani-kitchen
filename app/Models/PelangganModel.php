<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $allowedFields = [
        'email',
        'password',
        'nama_lengkap',
        'alamat',
        'no_hp_wa',
        'alergi_makanan',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date'
    ];
    protected $returnType = 'App\Entities\Pelanggan';
    protected $useTimestamps = false;
}
