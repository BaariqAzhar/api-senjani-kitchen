<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use DateTime;
use DateTimeZone;

class Pesanan extends ResourceController
{
    protected $modelName = 'App\Models\PesananModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function create()
    {
        date_default_timezone_set('asia/jakarta');
        $data = $this->request->getPost();
        $data['id_menu'] = explode(',', $data['ids_menu']);

        $newData = [];
        foreach ($data['id_menu'] as $item) {
            $dataItem['id_pelanggan'] = (int) $data['id_pelanggan'];
            $dataItem['id_menu'] = (int) $item;
            $dataItem['id_kupon_pelanggan'] = (int) $data['id_kupon_pelanggan'];
            $dataItem['created_by'] = 0;
            $dataItem['created_date'] = date("Y-m-d H:i:s");
            array_push($newData, $dataItem);
            $this->model->save($dataItem);
        }
        $data = $newData;
        return $this->respondCreated($data);
    }

    public function updatePesanan()
    {
        date_default_timezone_set('asia/jakarta');
        $data = $this->request->getPost();
        $data['id_pesanan'] = explode(',', $data['ids_pesanan']);
        $newData = [];
        foreach ($data['id_pesanan'] as $item) {
            $dataItem['id_pesanan'] = (int) $item;
            $dataItem['nama_penerima'] = $data['nama_penerima'];
            $dataItem['no_hp_wa_penerima'] = $data['no_hp_wa_penerima'];
            $dataItem['alamat_penerima'] = $data['alamat_penerima'];
            $dataItem['alergi_makanan_penerima'] = $data['alergi_makanan_penerima'];
            $dataItem['status_pesanan'] = 'belum_dikirim';
            $dataItem['catatan_pesanan'] = $data['catatan_pesanan'];
            $dataItem['updated_by'] = 0;
            $dataItem['updated_date'] = date("Y-m-d H:i:s");
            array_push($newData, $dataItem);
            $this->model->save($dataItem);
        }
        $data = $newData;
        return $this->respondUpdated($data);
    }
}
