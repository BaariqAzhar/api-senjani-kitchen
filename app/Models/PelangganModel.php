<?php 

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    protected $allowedFields = [
        'email',
        'password',
        'salt',
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