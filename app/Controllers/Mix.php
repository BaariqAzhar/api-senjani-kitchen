<?php

namespace App\Controllers;

use App\Models\KuponPelangganModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MixModel;
use App\Models\PesananModel;

class Mix extends ResourceController
{

    public function showKuponPelangganBerdasarkanIdPelanggan()
    {
        $dataRequest = $this->request->getPost();
        // return $this->respond($dataRequest['id_pelanggan']);

        $model = new MixModel();
        $data = $model->getPaketKuponPelanggan($dataRequest['id_pelanggan']);
        // echo view('view_siswa',$data);
        return $this->respond($data);
    }

    public function createPesanan()
    {
        $PesananModel = new PesananModel();
        $KuponPelangganModel = new KuponPelangganModel();

        date_default_timezone_set('asia/jakarta');
        $data = $this->request->getPost();
        $data['id_menu'] = explode(',', $data['ids_menu']);

        $newData = [];
        $loopNumber = 0;
        foreach ($data['id_menu'] as $item) {
            $dataItem['id_pelanggan'] = (int) $data['id_pelanggan'];
            $dataItem['id_menu'] = (int) $item;
            $dataItem['id_kupon_pelanggan'] = (int) $data['id_kupon_pelanggan'];
            $dataItem['kode_pesanan'] = "P" . rand(0, 999) . "-KP" . $data['id_kupon_pelanggan'] . "-D" . date("YmdHis");
            $dataItem['waktu_pemesanan'] = date("Y-m-d H:i:s");
            $dataItem['nama_penerima'] = $data['nama_penerima'];
            $dataItem['no_hp_wa_penerima'] = $data['no_hp_wa_penerima'];
            $dataItem['alamat_penerima'] = $data['alamat_penerima'];
            $dataItem['alergi_makanan_penerima'] = $data['alergi_makanan_penerima'];
            $dataItem['status_pesanan'] = "belum_dikirim";
            $dataItem['catatan_pesanan'] = $data['catatan_pesanan'];
            $dataItem['created_by'] = 0;
            $dataItem['created_date'] = date("Y-m-d H:i:s");
            array_push($newData, $dataItem);
            $loopNumber = $loopNumber + 1;
            $PesananModel->save($dataItem);
        }

        $jumlahKuponTersisa = $KuponPelangganModel->where('id_kupon_pelanggan', (int) $data['id_kupon_pelanggan'])->findColumn('jumlah_kupon_tersisa');
        $jumlahKuponTersisa = implode($jumlahKuponTersisa);
        $jumlahKuponSetelahPenggunaan = $jumlahKuponTersisa - $loopNumber;

        $dataKuponPelanggan['id_kupon_pelanggan'] = $data['id_kupon_pelanggan'];
        $dataKuponPelanggan['jumlah_kupon_tersisa'] = $jumlahKuponSetelahPenggunaan;
        $KuponPelangganModel->save($dataKuponPelanggan);

        return $this->respond($newData);
    }

    public function showPesananBerdasarkanIdPelanggan()
    {
        $dataRequest = $this->request->getPost();

        $mixModel = new MixModel();
        $data = $mixModel->getPesananKuponPelangganMenu($dataRequest['id_pelanggan']);

        return $this->respond($data);
    }
}
