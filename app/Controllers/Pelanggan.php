<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Pelanggan extends ResourceController
{
    protected $modelName = 'App\Models\PelangganModel';
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
        $validate = $this->validation->run($data, 'register');
        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $pelanggan = new \App\Entities\Pelanggan();
        $pelanggan->fill($data);
        $pelanggan->created_by = 0;
        $pelanggan->created_date = date("Y-m-d H:i:s");

        if ($this->model->save($pelanggan)) {
            $pelanggan_id = $this->model->getInsertId();

            // return $this->respondCreated($pelanggan, 'pelanggan baru terbuat (created)');

            return $this->respondCreated(['pelanggan_id' => $pelanggan_id, 'status' => 'success', 'info' => 'register, create']);
        }
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->fail('id tidak ditemukan');
        }

        $data = $this->request->getRawInput();
        $data['pelanggan_id'] = $id;
        $validate = $this->validation->run($data, 'registerNext');
        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $pelanggan = new \App\Entities\Pelanggan();
        $pelanggan->fill($data);
        $pelanggan->updated_by = 0;
        $pelanggan->updated_date = date("Y-m-d H:i:s");

        if ($this->model->save($pelanggan)) {
            // return $this->respondUpdated($pelanggan, 'pelanggan telah diperbaharui (updated)');
            return $this->respondUpdated(['pelanggan_id' => $id, 'status' => 'success', 'info' => 'registerNext, update']);
        }
    }

    public function login()
    {
        $data = $this->request->getPost();
        $pelanggan = new \App\Entities\Pelanggan();
        $pelanggan->fill($data);
        $pelangganIdFromDatabase = $this->model->where('email', $pelanggan->email)->findColumn('pelanggan_id');
        $passwordFromDatabase = $this->model->where('email', $pelanggan->email)->findColumn('password');

        if (empty($passwordFromDatabase)) {
            return $this->respond(['pelanggan_id' => '', 'status' => 'fail', 'info' => 'Login, login, email not found']);
        }

        $passwordInput = $pelanggan->password;

        if (implode($passwordFromDatabase) === $passwordInput) {
            return $this->respond(['pelanggan_id' => implode($pelangganIdFromDatabase), 'status' => 'success', 'info' => 'Login, login']);
        } else {
            return $this->respond(['pelanggan_id' => implode($pelangganIdFromDatabase), 'status' => 'fail', 'info' => 'Login, login, wrong password']);
        }
    }
}
