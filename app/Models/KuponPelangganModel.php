<?php

namespace App\Models;

use CodeIgniter\Model;

class KuponPelangganModel extends Model
{
    protected $table = 'paket_kupon';
    protected $primaryKey = 'id_kupon_pelanggan';
    protected $allowedFields = [
        'kode_kupon_pelanggan',
        'id_paket_kupon',
        'id_pelanggan',
        'tanggal_pembelian_kupon',
        'tanggal_kedaluwarsa',
        'jumlah_kupon_tersisa',
        'status_kupon',
        'cara_pembayaran',
        'waktu_batas_pembayaran',
        'bukti_pembayaran',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date'
    ];
    protected $useTimestamps = false;
}
