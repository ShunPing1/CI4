<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admindata'; 
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['name', 'email'];
    public function getAdmins()
    {
        
        return $this->findAll();

    }
}