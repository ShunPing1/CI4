<?php
    namespace App\Services;


    class DatabaseService
    {
        protected $db;

        public function __construct()
        {
            $this->db = \Config\Database::connect(); 
        }

        public function allDataNum($table)
        {
            return $this->db->table($table)->countAll();
        }

        public function getProducts($perPage,$offset)
        {
            $builder = $this->db->table('products');
            $builder->select('*');
            $builder->orderBy('sSort', 'ASC');
            $query = $builder->get($perPage,$offset);
            return $query->getResultArray();
        }

        public function getCategory()
        {
            $builder = $this->db->table('category');
            $builder->select('*');
            $builder->orderBy('categoryID', 'ASC');
            $query = $builder->get();
            return $query->getResultArray();
        }

        public function getSubCategory()
        {
            $builder = $this->db->table('subcategory');
            $builder->select('*');
            $builder->orderBy('subcategoryID', 'ASC');
            $query = $builder->get();
            return $query->getResultArray();
        }

        public function getAdmindata($keyword = null)
        {
            $builder = $this->db->table('admindata');
            $builder->select('*');

            // 判斷是否為search
            if ($keyword !== null) {
                $builder->like('a_username', $keyword);
            }

            $query = $builder->get();
            return $query->getResultArray();
        }

        public function getMemberdata()
        {
            $builder = $this->db->table('memberdata');
            $builder->select('*');
            $query = $builder->get();
            return $query->getResultArray();
        }
        // select where
        public function getWhereData($table,$whereContent=[])
        {
            $builder = $this->db->table($table);
            $builder->select('*');

            foreach($whereContent as $index => $value){
                $builder->where($index,$value);
            }
            
            $query = $builder->get();
            return $query->getResultArray();
        }
        // insert into
        public function insertData($table,$data_arr)
        {
            $builder = $this->db->table($table);
            return $builder->insert($data_arr);
        }
        // update
        public function updateData($table,$whereContent=[],$data_arr)
        {
            $builder = $this->db->table($table);

            foreach($whereContent as $index => $value){
                $builder->where($index,$value);
            }

            return $builder->update($data_arr);
        }
    }