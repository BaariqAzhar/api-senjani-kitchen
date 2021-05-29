<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = [
        'email_admin',
        'password',
        'nama_lengkap_admin',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date'
    ];
    protected $useTimestamps = false;
}
