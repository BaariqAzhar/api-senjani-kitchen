<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

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

    public function showAllMenu()
    {
        return $this->respond($this->model->findAll());
    }

    public function createMenu()
    {
        date_default_timezone_set('asia/jakarta');
        helper(['form']);

        $dataInput = $this->request->getPost();
        $file = $this->request->getFile('foto_menu');
        $newName = "FM" . rand(0, 999) . date("YmdHis");
        $newName = $newName . ".jpg";
        $file->move('./assets/fotoMenu', $newName);

        $dataInput['foto_menu'] = $newName;
        $dataInput['created_by'] = 1;
        $dataInput['created_date'] = date("Y-m-d H:i:s");

        if ($this->model->save($dataInput)) {
            $idMenu = $this->model->getInsertId();
            $dataMenuFromDatabase = $this->model->find($idMenu);
            return $this->respond(['id_menu' => $idMenu, 'status' => 'success', 'info' => 'new menu insert successfully', 'dataMenu' => $dataMenuFromDatabase]);
        }
    }

    public function updateMenu()
    {
        date_default_timezone_set('asia/jakarta');
        helper(['form']);

        $dataInput = $this->request->getPost();
        $file = $this->request->getFile('foto_menu');
        $newName = "FM" . rand(0, 999) . date("YmdHis");
        $newName = $newName . ".jpg";
        $file->move('./assets/fotoMenu', $newName);

        $dataInput['foto_menu'] = $newName;
        $dataInput['updated_by'] = 1;
        $dataInput['updated_date'] = date("Y-m-d H:i:s");
        
        if ($this->model->save($dataInput)) {
            $dataMenuFromDatabase = $this->model->find($dataInput['id_menu']);
            return $this->respond(['id_menu' => $dataInput['id_menu'], 'status' => 'success', 'info' => 'update menu successfully', 'dataMenu' => $dataMenuFromDatabase]);
        }
    }

    public function updateMenuNoFoto()
    {
        date_default_timezone_set('asia/jakarta');
        helper(['form']);

        $dataInput = $this->request->getPost();
        $dataInput['updated_by'] = 1;
        $dataInput['updated_date'] = date("Y-m-d H:i:s");
        
        if ($this->model->save($dataInput)) {
            $dataMenuFromDatabase = $this->model->find($dataInput['id_menu']);
            return $this->respond(['id_menu' => $dataInput['id_menu'], 'status' => 'success', 'info' => 'update menu no foto successfully', 'dataMenu' => $dataMenuFromDatabase]);
        }
    }
}
