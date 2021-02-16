<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use DateTime;
use DateTimeZone;

class Menu extends ResourceController
{
    protected $modelName = 'App\Models\MenuModel';
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
