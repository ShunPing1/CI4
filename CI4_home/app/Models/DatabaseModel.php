<?php
    namespace App\Models;

    use CodeIgniter\Model;
    
    class DatabaseModel extends Model
    {
        protected $table = 'order_state';
        protected $primaryKey = 'os_ID';
        protected $allowedFields = ['os_name','os_sort'];
    
        
    }