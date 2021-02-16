<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $allowedFields = [
        'id_pelanggan',
        'id_menu',
        'id_kupon_pelanggan',
        'kode_pesanan',
        'waktu_pemesanan',
        'nama_penerima',
        'no_hp_wa_penerima',
        'alamat_penerima',
        'alergi_makanan_penerima',
        'status_pesanan',
        'catatan_pesanan',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date'
    ];
    protected $useTimestamps = false;
}
