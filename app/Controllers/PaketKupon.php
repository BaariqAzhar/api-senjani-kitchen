<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class PaketKupon extends ResourceController
{
    protected $modelName = 'App\Models\PaketKuponModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function showPaketKupon()
    {
        $data = $this->request->getPost();
        $jenisPaketKupon = $data['jenis_paket_kupon'];
        $dataFromDatabase = $this->model->where('jenis_paket_kupon', $jenisPaketKupon)->findAll();
        return $this->respond($dataFromDatabase);
    }

    public function showPaketKuponBerdasarkanJenisPaketKupon()
    {
        $data = $this->request->getPost();
        $jenisPaketKupon = $data['jenis_paket_kupon'];
        $dataFromDatabase = $this->model->where('jenis_paket_kupon', $jenisPaketKupon)->findAll();
        return $this->respond($dataFromDatabase);
    }

    public function showAllPaketKupon()
    {
        return $this->respond($this->model->findAll());
    }

    public function updatePaketKupon()
    {
        date_default_timezone_set('asia/jakarta');

        $dataInput = $this->request->getPost();
        $dataInput['updated_by'] = 10;
        $dataInput['updated_date'] = date("Y-m-d H:i:s");

        if ($this->model->save($dataInput)) {
            $dataFromDatabase = $this->model->find($dataInput['id_paket_kupon']);
            return $this->respond(['id_menu' => $dataInput['id_paket_kupon'], 'status' => 'success', 'info' => 'update paket kupon successfully', 'dataPaketKupon' => $dataFromDatabase]);
        }
    }
}
