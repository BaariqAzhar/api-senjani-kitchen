<?php

namespace App\Models;

use CodeIgniter\Model;

class MixModel extends Model
{
    public function getPaketKuponPelanggan($idPelanggan)
    {
        return $this->db->table('kupon_pelanggan')
            ->join('paket_kupon', 'paket_kupon.id_paket_kupon=kupon_pelanggan.id_paket_kupon')
            ->getWhere(['id_pelanggan' => $idPelanggan])->getResultArray();
    }

    public function getPesananKuponPelangganMenu($idPelanggan)
    {
        // return $this->db->table('pesanan')
        //     ->join('kupon_pelanggan', 'pesanan.id_kupon_pelanggan=kupon_pelanggan.id_kupon_pelanggan')
        //     ->join('menu', 'pesanan.id_menu=menu.id_menu')
        //     ->getWhere(['id_pelanggan' => $idPelanggan])->getResultArray();

        // return $this->db->table('pesanan')
        //     ->join('kupon_pelanggan', 'kupon_pelanggan.id_kupon_pelanggan=pesanan.id_kupon_pelanggan')
        //     ->join('menu', 'menu.id_menu=pesanan.id_menu')
        //     ->get()->getResultArray();

        return $this->db->table('pesanan')
            ->join('menu', 'menu.id_menu=pesanan.id_menu')
            ->join('kupon_pelanggan', 'pesanan.id_kupon_pelanggan=kupon_pelanggan.id_kupon_pelanggan')
            ->join('paket_kupon', 'paket_kupon.id_paket_kupon=kupon_pelanggan.id_paket_kupon')
            ->getWhere(['pesanan.id_pelanggan' => $idPelanggan])->getResultArray();

        // $builder = $this->db->table('pesanan');
        // $builder->select('*');

        // return $builder->get();
    }
}
