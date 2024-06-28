<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    
    public function getProducts()
    {
        
        return $this->findAll();

    }
}