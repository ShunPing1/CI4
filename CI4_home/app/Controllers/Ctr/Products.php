<?php
namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class Products extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $pager = service('pager');
        $product_page = (int) ($this->request->getGet('page') ?? 1);
        $search_query = $this->request->getGet('search') ?? '';
        $perPage = 5;
        $offset = ($product_page - 1) * $perPage;

        $builder = $db->table('products');
        $builder->select('*');

        if ($search_query) {
            $builder->like('sName', $search_query);
        }

        $builder->orderBy('sSort');
        $query = $builder->get($perPage,$offset);
        $products_result = $query->getResultArray();

        // 判斷是否有進行搜索得出不同結果
        if ($search_query) {
            // 重設計錄總數，不過濾掉已經分頁的結果
            $builder->resetQuery();
            $builder->select('*');
            $builder->like('sName', $search_query);
            $products_total = $builder->countAllResults();
        } else {
            $products_total = $db->table('products')->countAll();
        }

        $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');
        $data['products'] = $products_result;
        $data['products_total'] = $products_total;
        $data['products_links'] = $products_links;
        return view('Pages/products',$data);


        $products_total = $db->table('products')->countAll();
    }

    public function search(){
        $db = \Config\Database::connect();
        if (isset($_POST)) {
            $keyword = $this->request->getPost('keyword');
            $builder = $db->table('products');
            $builder->select('*');
            

        }else{
            echo 'error';
        }
    }
}
