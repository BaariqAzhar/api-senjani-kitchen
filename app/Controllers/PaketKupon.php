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
}
