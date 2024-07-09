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

        public function limitDataNum($table,$whereContent=[])
        {
            $builder = $this->db->table($table);
            foreach($whereContent as $index => $value){
                return $builder->where($index,$value)->countAllResults();
            }
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
        
        public function getData($table,$orderBy=[],$limit=[])
        {
            $builder = $this->db->table($table);
            $builder->select('*');

            if (!empty($orderBy)) {
                foreach ($orderBy as $index => $value)
                {
                    $query = $builder->orderBy($index,$value);
                }
            }

            if (!empty($limit)) {
                foreach ($limit as $index => $value)
                {
                    $query = $builder->get($index,$value);
                }
            }else{
                $query = $builder->get();
            }

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
        // join
        public function getJoinData($main_table,$select,$joinContent=[],$orderBy=[],$perPage,$offset,$whereContent=[])
        {
            $builder = $this->db->table($main_table);
            $builder->select($select);

            if(!empty($joinContent)){
                foreach($joinContent as $index => $value){
                    $builder->join($index,$value);
                }
            }

            if (!empty($orderBy)) {
                foreach($orderBy as $index => $value){
                    $builder->orderBy($index,$value);
                }
            }

            
            if (!empty($whereContent)) {
                $builder->where($whereContent);
            }

            $query = $builder->get($perPage,$offset);
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
        // delete
        public function deleteData($table,$deleteContent=[])
        {
            $builder = $this->db->table($table);
            $builder->where($deleteContent)->delete();
            //確認資料是否已被刪除
            return $deleted = !$builder->where($deleteContent)->countAllResults();
        }
    }