<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Admin extends ResourceController
{
    protected $modelName = 'App\Models\AdminModel';
    protected $format = 'json';

    public function register()
    {
        $dataInput = $this->request->getPost();
        if (count($this->model->where('email_admin', $dataInput['email_admin'])->findAll()) > 0) {
            return $this->respond(['status' => 'failed', 'info' => 'email already has registered']);
        } else {
            $newData = $dataInput;
            $newData['password'] = md5($dataInput['password']);
            if ($this->model->save($newData)) {
                $idAdmin = $this->model->getInsertId();
                $dataAdminFromDatabase = $this->model->find($idAdmin);
                return $this->respond(['id_admin' => $idAdmin, 'status' => 'success', 'dataAdmin' => $dataAdminFromDatabase]);
            }
        }
    }

    public function login()
    {
        $dataInput = $this->request->getPost();
        $dataDatabase = $this->model->where('email_admin', $dataInput['email_admin'])->findAll();
        if (count($dataDatabase) == 0) {
            return $this->respond(['id_admin' => "", 'status' => 'failed', 'info' => 'email is not registered', 'dataAdmin' => ""]);
        } else {
            if (md5($dataInput['password']) == $dataDatabase[0]['password']) {
                return $this->respond(['id_admin' => $dataDatabase[0]['id_admin'], 'status' => 'success', 'info' => 'email & password are correct', 'dataAdmin' => $dataDatabase[0]]);
            } else {
                return $this->respond(['id_admin' => $dataDatabase[0]['id_admin'], 'status' => 'failed', 'info' => 'email is correct, password is incorrect', 'dataAdmin' => $dataDatabase[0]]);
            }
        }
    }
}
