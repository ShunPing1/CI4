<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class BackendPage extends BaseController
{
    public function index()
    {   
        $db = \Config\Database::connect();

        $pager = service('pager');
        // 設置基礎路徑
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
        $builder->orderBy('sSort', 'ASC');
        $query = $builder->get($perPage,$offset);
        $products_result = $query->getResultArray();
        // 如果要使用 Pager 類別來生成分頁連結
        $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');
        $data['products'] = $products_result;
        $data['products_total'] = $products_total;
        $data['products_links'] = $products_links;


        // 類別分頁
        $category_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $offset = ($category_page - 1) * $perPage;
        $category_total = $db->table('category')->countAll();
        $builder = $db->table('category');
        $builder->select('category.*');
        $query = $builder->get($perPage,$offset);
        $category_result = $query->getResultArray();
        $category_links = $pager->makeLinks($category_page, $perPage, $category_total,'default_full');
        $data['category'] = $category_result;
        $data['category_total'] = $category_total;
        $data['category_links'] = $category_links;

        // 項目分頁
        $subcategory_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 3;
        $offset = ($subcategory_page - 1) * $perPage;
        $total = $db->table('subcategory')->countAll();
        $builder = $db->table('subcategory');
        $builder->select('subcategory.*');
        $query = $builder->get($perPage,$offset);
        $subcategory_result = $query->getResultArray();
        $subcategory_links = $pager->makeLinks($subcategory_page, $perPage, $total,'default_full');
        $data['subcategory'] = $subcategory_result;
        $data['subcategory_total'] = $total;
        $data['subcategory_links'] = $subcategory_links;
        
        // 會員名單分頁
        $members_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $offset = ($members_page - 1) * $perPage;
        $total = $db->table('memberdata')->countAll();
        $builder = $db->table('memberdata');
        $builder->select('memberdata.*');
        $query = $builder->get($perPage,$offset);
        $members_result = $query->getResultArray();
        $members_links = $pager->makeLinks($members_page, $perPage, $total,'default_full');
        $data['members'] = $members_result;
        $data['members_total'] = $total;
        $data['members_links'] = $members_links;

        // 管理員名單分頁
        $admins_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 3;
        $offset = ($admins_page - 1) * $perPage;
        $total = $db->table('admindata')->countAll();
        $builder = $db->table('admindata');
        $builder->select('admindata.*');
        $query = $builder->get($perPage,$offset);
        $admins_result = $query->getResultArray();
        $admins_links = $pager->makeLinks($admins_page, $perPage, $total,'default_full');
        $data['admins'] = $admins_result;
        $data['admins_total'] = $total;
        $data['admins_links'] = $admins_links;

        // 訂單分頁
        $order_page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $offset = ($order_page - 1) * $perPage;
        $total = $db->table('order_info')->countAll();
        $builder = $db->table('order_info');
        $builder->select('order_info.*, memberdata.m_username');
        $builder->join('memberdata', 'order_info.m_ID = memberdata.m_ID');
        $query = $builder->get($perPage,$offset);
        $builder->orderBy('oi_ID', 'DESC');
        $order_info_result = $query->getResultArray();
        $order_info_links = $pager->makeLinks($order_page, $perPage, $total,'default_full');
        $data['order_info'] = $order_info_result;
        $data['order_info_total'] = $total;
        $data['order_info_links'] = $order_info_links;


        echo view('Admin/Backend_system', $data);
    }


    // 待測試
    // private function paginate($tableName, $pageParam, $perPage, $selectFields = '*', $joins = [], $orderBy = null)
    // {
    //     $db = \Config\Database::connect();
    //     $pager = service('pager');
    //     $page = (int) ($this->request->getGet($pageParam) ?? 1);
    //     $offset = ($page - 1) * $perPage;
    //     $total = $db->table($tableName)->countAll();
        
    //     $builder = $db->table($tableName);
    //     $builder->select($selectFields);
        
    //     // 加入聯接表
    //     foreach ($joins as $join) {
    //         $builder->join($join['table'], $join['condition']);
    //     }

    //     // 設定排序
    //     if ($orderBy) {
    //         $builder->orderBy($orderBy['field'], $orderBy['direction']);
    //     }

    //     $query = $builder->get($perPage, $offset);
    //     $result = $query->getResultArray();
    //     $links = $pager->makeLinks($page, $perPage, $total, 'default_full', 0, $pageParam);

    //     return [
    //         'result' => $result,
    //         'total' => $total,
    //         'links' => $links,
    //     ];
    // }

    // public function index()
    // {
    //     $data = [];

    //     // 產品分頁
    //     $products = $this->paginate(
    //         'products', 
    //         'product_page', 
    //         5, 
    //         'products.*, subcategory.subcategoryName', 
    //         [['table' => 'subcategory', 'condition' => 'products.subcategoryID = subcategory.subcategoryID']], 
    //         ['field' => 'sSort', 'direction' => 'ASC']
    //     );
    //     $data['products'] = $products['result'];
    //     $data['products_total'] = $products['total'];
    //     $data['products_links'] = $products['links'];

    //     // 類別分頁
    //     $category = $this->paginate(
    //         'category', 
    //         'category_page', 
    //         10
    //     );
    //     $data['category'] = $category['result'];
    //     $data['category_total'] = $category['total'];
    //     $data['category_links'] = $category['links'];

    //     // 項目分頁
    //     $subcategory = $this->paginate(
    //         'subcategory', 
    //         'subcategory_page', 
    //         3
    //     );
    //     $data['subcategory'] = $subcategory['result'];
    //     $data['subcategory_total'] = $subcategory['total'];
    //     $data['subcategory_links'] = $subcategory['links'];

    //     // 會員名單分頁
    //     $members = $this->paginate(
    //         'memberdata', 
    //         'members_page', 
    //         10
    //     );
    //     $data['members'] = $members['result'];
    //     $data['members_total'] = $members['total'];
    //     $data['members_links'] = $members['links'];

    //     // 管理員名單分頁
    //     $admins = $this->paginate(
    //         'admindata', 
    //         'admins_page', 
    //         3
    //     );
    //     $data['admins'] = $admins['result'];
    //     $data['admins_total'] = $admins['total'];
    //     $data['admins_links'] = $admins['links'];

    //     // 訂單分頁
    //     $order_info = $this->paginate(
    //         'order_info', 
    //         'order_page', 
    //         10, 
    //         'order_info.*, memberdata.m_username', 
    //         [['table' => 'memberdata', 'condition' => 'order_info.m_ID = memberdata.m_ID']],
    //         ['field' => 'oi_ID', 'direction' => 'DESC']
    //     );
    //     $data['order_info'] = $order_info['result'];
    //     $data['order_info_total'] = $order_info['total'];
    //     $data['order_info_links'] = $order_info['links'];

    //     echo view('Admin/Backend_system', $data);
    // }

    public function deleteProduct($sId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->delete(['sID' => $sId]);
        return redirect()->to('BackendPage');
    }
    
}
?>