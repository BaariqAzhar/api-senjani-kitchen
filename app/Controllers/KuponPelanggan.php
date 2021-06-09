<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use DateTime;
use DateTimeZone;

class KuponPelanggan extends ResourceController
{
    protected $modelName = 'App\Models\KuponPelangganModel';
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
        $data = $this->request->getPost();
        date_default_timezone_set('asia/jakarta');
        $kode_kupon_pelanggan = "KP" . rand(0, 999) . "-PK" . $data['kode_paket_kupon'] . "-D" . date("YmdHis");
        unset($data['kode_paket_kupon']);
        $data['id_paket_kupon'] = (int) $data['id_paket_kupon'];
        $data['id_pelanggan'] = (int) $data['id_pelanggan'];
        $data['kode_kupon_pelanggan'] = $kode_kupon_pelanggan;
        $data['tanggal_pembelian_kupon'] = date("Y-m-d H:i:s");
        $data['tanggal_kedaluwarsa'] = date("Y-m-d H:i:s", strtotime("+1 year"));
        $data['jumlah_kupon_tersisa'] = (int) $data['jumlah_kupon'];
        unset($data['jumlah_kupon']);
        $data['status_kupon'] = "belum_dibayar";
        $data['created_by'] = 0;
        $data['created_date'] = date("Y-m-d H:i:s");
        if ($this->model->save($data)) {
            $id_kupon_pelanggan = $this->model->getInsertId();
            return $this->respondCreated(['id_kupon_pelanggan' => $id_kupon_pelanggan, 'status' => 'success', 'info' => 'create (kupon pelanggan)', 'data' => $data]);
        }
        // return $this->respond($data);
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->fail('id tidak ditemukan');
        };

        $data = $this->request->getRawInput();
        $data['id_kupon_pelanggan'] = $id;
        date_default_timezone_set('asia/jakarta');
        $data['waktu_batas_pembayaran'] = date("Y-m-d H:i:s", strtotime("+3 hour"));
        $data['updated_by'] = 0;
        $data['updated_date'] = date("Y-m-d H:i:s");

        if ($this->model->save($data)) {
            $id_kupon_pelanggan = $this->model->getInsertId();
            return $this->respondUpdated(['id_kupon_pelanggan' => $id_kupon_pelanggan, 'status' => 'success', 'info' => 'update (kupon pelanggan)', 'data' => $data]);
        }
        // return $this->respondUpdated($data);
    }

    public function uploadBukti()
    {
        helper(['form']);
        $data = $this->request->getPost();
        // if (!$this->model->find($data['id_kupon_pelanggan'])) {
        //     return $this->fail('id tidak ditemukan');
        // };

        $file = $this->request->getFile('bukti_pembayaran');
        $file->move('./assets/UploadBuktiPembayaran');

        date_default_timezone_set('asia/jakarta');
        $data['updated_by'] = 0;
        $data['updated_date'] = date("Y-m-d H:i:s");

        // return $path = $this->request->getFile('bukti_pembayaran')->store('head_img/', 'user_name.jpg');

        return $this->respondUpdated($data);
    }

    public function createKuponPelanggan()
    {
        $data = $this->request->getPost();
        date_default_timezone_set('asia/jakarta');
        $kode_kupon_pelanggan = "KP" . rand(0, 999) . "-PK" . $data['kode_paket_kupon'] . "-D" . date("YmdHis");
        unset($data['kode_paket_kupon']);
        $data['id_paket_kupon'] = (int) $data['id_paket_kupon'];
        $data['id_pelanggan'] = (int) $data['id_pelanggan'];
        $data['kode_kupon_pelanggan'] = $kode_kupon_pelanggan;
        $data['tanggal_pembelian_kupon'] = date("Y-m-d H:i:s");
        $data['tanggal_kedaluwarsa'] = date("Y-m-d H:i:s", strtotime("+1 year"));
        $data['waktu_batas_pembayaran'] = date("Y-m-d H:i:s", strtotime("+3 hour"));
        $data['jumlah_kupon_tersisa'] = (int) $data['jumlah_kupon'];
        unset($data['jumlah_kupon']);
        $data['status_kupon'] = "belum_dibayar";
        $data['created_by'] = 0;
        $data['created_date'] = date("Y-m-d H:i:s");
        if ($this->model->save($data)) {
            $id_kupon_pelanggan = $this->model->getInsertId();
            return $this->respondCreated(['id_kupon_pelanggan' => $id_kupon_pelanggan, 'status' => 'success', 'info' => 'create (kupon pelanggan)', 'dataKuponPelanggan' => $data]);
        }
    }

    public function updateKuponPelanggan()
    {
        date_default_timezone_set('asia/jakarta');
        helper(['form']);
        $data = $this->request->getPost();
        if (!$this->model->find($data['id_kupon_pelanggan'])) {
            return $this->fail('id tidak ditemukan');
        };
        // $kodeKuponPelanggan = $this->model->where('id_kupon_pelanggan', $data['id_kupon_pelanggan'])->findColumn('kode_kupon_pelanggan');
        // implode($kodeKuponPelanggan);
        // return $this->respond(implode($kodeKuponPelanggan));

        $file = $this->request->getFile('bukti_pembayaran');
        $newName = "BP" . rand(0, 999) . date("YmdHis");
        $newName = $newName . ".jpg";
        $file->move('./assets/UploadBuktiPembayaran', $newName);

        $data['bukti_pembayaran'] = $newName;
        $data['status_kupon'] = "menunggu_diverifikasi";
        $data['updated_by'] = 0;
        $data['updated_date'] = date("Y-m-d H:i:s");

        if ($this->model->save($data)) {
            // $id_kupon_pelanggan = $this->model->getInsertId();
            return $this->respondUpdated(['id_kupon_pelanggan' => $data['id_kupon_pelanggan'], 'status' => 'success', 'info' => 'update (kupon pelanggan)', 'data' => $data]);
        }
    }

    public function adminUpdateKuponPelanggan()
    {
        // return $this->respond("hahahah");

        date_default_timezone_set('asia/jakarta');
        helper(['form']);

        $dataInput = $this->request->getPost();
        $file = $this->request->getFile('bukti_pembayaran');
        $newName = "BP" . rand(0, 999) . date("YmdHis");
        $newName = $newName . ".jpg";
        $file->move('./assets/UploadBuktiPembayaran', $newName);

        $dataInput['bukti_pembayaran'] = $newName;
        $dataInput['updated_by'] = 10;
        $dataInput['updated_date'] = date("Y-m-d H:i:s");

        if ($this->model->save($dataInput)) {
            $dataMenuFromDatabase = $this->model->find($dataInput['id_kupon_pelanggan']);
            return $this->respond(['id_kupon_pelanggan' => $dataInput['id_kupon_pelanggan'], 'status' => 'success', 'info' => 'update kupon pelanggan successfully', 'dataKuponPelanggan' => $dataMenuFromDatabase]);
        }
    }

    public function adminUpdateKuponPelangganNoFoto()
    {
        date_default_timezone_set('asia/jakarta');
        helper(['form']);

        $dataInput = $this->request->getPost();
        $dataInput['updated_by'] = 10;
        $dataInput['updated_date'] = date("Y-m-d H:i:s");

        if ($this->model->save($dataInput)) {
            $dataMenuFromDatabase = $this->model->find($dataInput['id_kupon_pelanggan']);
            return $this->respond(['id_kupon_pelanggan' => $dataInput['id_kupon_pelanggan'], 'status' => 'success', 'info' => 'update kupon pelanggan successfully', 'dataKuponPelanggan' => $dataMenuFromDatabase]);
        }
    }
}
