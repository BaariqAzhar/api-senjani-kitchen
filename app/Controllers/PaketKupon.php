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
}
