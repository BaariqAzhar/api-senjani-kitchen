<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketKuponModel extends Model
{
    protected $table = 'paket_kupon';
    protected $primaryKey = 'id_paket_kupon';
    protected $allowedFields = [
        'kode_paket_kupon',
        'jenis_paket_kupon',
        'jumlah_kupon',
        'jenis_nasi',
        'jumlah_nasi',
        'lauk_tambahan',
        'harga',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date'
    ];
    protected $useTimestamps = false;
}
