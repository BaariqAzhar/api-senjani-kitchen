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
            $id_pelanggan = $this->model->getInsertId();

            // return $this->respondCreated($pelanggan, 'pelanggan baru terbuat (created)');

            return $this->respondCreated(['id_pelanggan' => $id_pelanggan, 'status' => 'success', 'info' => 'register, create']);
        }
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->fail('id tidak ditemukan');
        }

        $data = $this->request->getRawInput();
        $data['id_pelanggan'] = $id;
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
            return $this->respondUpdated(['id_pelanggan' => $id, 'status' => 'success', 'info' => 'registerNext, update']);
        }
    }

    public function login()
    {
        $data = $this->request->getPost();
        $pelanggan = new \App\Entities\Pelanggan();
        $pelanggan->fill($data);
        $pelangganIdFromDatabase = $this->model->where('email', $pelanggan->email)->findColumn('id_pelanggan');
        $passwordFromDatabase = $this->model->where('email', $pelanggan->email)->findColumn('password');

        if (empty($passwordFromDatabase)) {
            return $this->respond(['id_pelanggan' => '', 'status' => 'fail', 'info' => 'Login, login, email not found']);
        }

        $passwordInput = $pelanggan->password;

        if (implode($passwordFromDatabase) === $passwordInput) {
            $dataPelangganFromDatabase = $this->model->find($pelangganIdFromDatabase);
            return $this->respond(['id_pelanggan' => implode($pelangganIdFromDatabase), 'status' => 'success', 'info' => 'Login, login', 'dataPelanggan' => $dataPelangganFromDatabase]);
        } else {
            return $this->respond(['id_pelanggan' => implode($pelangganIdFromDatabase), 'status' => 'fail', 'info' => 'Login, login, wrong password']);
        }
    }

    public function register()
    {
        $data = $this->request->getPost();
        if (!$this->model->where('email', $data['email'])) {
            return $this->respond(['messages' => "email telah terdaftar"]);
        }
        $validate = $this->validation->run($data, 'register');
        $errors = $this->validation->getErrors();

        if ($errors) {
            // return $this->fail($errors);
            return $this->respond($errors);
        }

        $pelanggan = new \App\Entities\Pelanggan();
        $pelanggan->fill($data);
        $pelanggan->created_by = 0;
        $pelanggan->created_date = date("Y-m-d H:i:s");

        if ($this->model->save($pelanggan)) {
            $id_pelanggan = $this->model->getInsertId();
            $dataPelangganFromDatabase = $this->model->find($id_pelanggan);
            // return $this->respondCreated($pelanggan, 'pelanggan baru terbuat (created)');

            return $this->respondCreated(['id_pelanggan' => $id_pelanggan, 'status' => 'success', 'info' => 'register, create', 'dataPelanggan' => $dataPelangganFromDatabase]);
        }
    }
}
