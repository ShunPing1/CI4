<?php
    namespace App\Controllers\Ctr;

    use App\Controllers\BaseController;
    
    class SearchProducts extends BaseController
    {
        public function index()
        {
           if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $keyword = $_GET['keyword'];
                $db = \Config\Database::connect();
                $pager = service('pager');
                $pager->setPath('/Herry/CI4.3-Herry/BackendPage');
                // 產品分頁
                // 當前頁碼，使用getGet('page_products')分組
                $product_page = (int) ($this->request->getGet('page') ?? 1);
                // 每頁顯示的資料筆數
                $perPage = 5;
                // 計算偏移量
                $offset = ($product_page - 1) * $perPage;
                // 總資料筆數（如果需要）
                $products_total = $db->table('products')->countAll();
                $builder = $db->table('products');
                $builder->select('products.*, subcategory.subcategoryName');
                $builder->join('subcategory', 'products.subcategoryID = subcategory.subcategoryID');
                $builder->like('sName',$keyword);
                $builder->orderBy('sSort', 'ASC');
                $query = $builder->get($perPage,$offset);
                $products_result = $query->getResultArray();
                // 如果要使用 Pager 類別來生成分頁連結
                $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');
                $data['products'] = $products_result;
                $data['products_total'] = $products_total;
                $data['products_links'] = $products_links;
                foreach($products_result as $product){
                    echo $product['sName'].'<br>';
                }
                // echo view('Admin/Backend_system', $data);
                
           }
        }
        
    }