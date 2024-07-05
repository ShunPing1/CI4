<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class BackendPage extends BaseController
{
    protected $dbService;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
    }

    // public function index()
    // {   
    //     $session = session();
    //     // 取得當前管理員資料
    //     $curr_username =  $session->get('username');
    //     if ($curr_username) {
    //         $db = \Config\Database::connect();

    //         $pager = service('pager');
    //         // 設置基礎路徑
    //         $pager->setPath('/Herry/CI4.3-Herry/BackendPage');


    //         // 產品分頁
    //         // 當前頁碼，使用getGet('page_products')分組
    //         $product_page = (int) ($this->request->getGet('page') ?? 1);
    //         // 每頁顯示的資料筆數
    //         $perPage = 5;
    //         // 計算偏移量
    //         $offset = ($product_page - 1) * $perPage;
    //         // 總資料筆數
    //         $products_total = $db->table('products')->countAll();
    //         $builder = $db->table('products');
    //         $builder->select('products.*, subcategory.subcategoryName');
    //         $builder->join('subcategory', 'products.subcategoryID = subcategory.subcategoryID');
    //         $builder->orderBy('sSort', 'ASC');
    //         $query = $builder->get($perPage,$offset);
    //         $products_result = $query->getResultArray();
    //         // 如果要使用 Pager 類別來生成分頁連結
    //         $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');
    //         $data['products'] = $products_result;
    //         $data['products_total'] = $products_total;
    //         $data['products_links'] = $products_links;


    //         // 類別分頁
    //         $category_page = (int) ($this->request->getGet('page') ?? 1);
    //         $perPage = 10;
    //         $offset = ($category_page - 1) * $perPage;
    //         $category_total = $db->table('category')->countAll();
    //         $builder = $db->table('category');
    //         $builder->select('category.*');
    //         $query = $builder->get($perPage,$offset);
    //         $category_result = $query->getResultArray();
    //         $category_links = $pager->makeLinks($category_page, $perPage, $category_total,'default_full');
    //         $data['category'] = $category_result;
    //         $data['category_total'] = $category_total;
    //         $data['category_links'] = $category_links;

    //         // 項目分頁
    //         $subcategory_page = (int) ($this->request->getGet('page') ?? 1);
    //         $perPage = 3;
    //         $offset = ($subcategory_page - 1) * $perPage;
    //         $total = $db->table('subcategory')->countAll();
    //         $builder = $db->table('subcategory');
    //         $builder->select('subcategory.*');
    //         $query = $builder->get($perPage,$offset);
    //         $subcategory_result = $query->getResultArray();
    //         $subcategory_links = $pager->makeLinks($subcategory_page, $perPage, $total,'default_full');
    //         $data['subcategory'] = $subcategory_result;
    //         $data['subcategory_total'] = $total;
    //         $data['subcategory_links'] = $subcategory_links;
            
    //         // 會員名單分頁
    //         $members_page = (int) ($this->request->getGet('page') ?? 1);
    //         $perPage = 10;
    //         $offset = ($members_page - 1) * $perPage;
    //         $total = $db->table('memberdata')->countAll();
    //         $builder = $db->table('memberdata');
    //         $builder->select('memberdata.*');
    //         $query = $builder->get($perPage,$offset);
    //         $members_result = $query->getResultArray();
    //         $members_links = $pager->makeLinks($members_page, $perPage, $total,'default_full');
    //         $data['members'] = $members_result;
    //         $data['members_total'] = $total;
    //         $data['members_links'] = $members_links;

    //         // 管理員名單分頁
    //         $admins_page = (int) ($this->request->getGet('page') ?? 1);
    //         $perPage = 3;
    //         $offset = ($admins_page - 1) * $perPage;
    //         $total = $db->table('admindata')->countAll();
    //         $builder = $db->table('admindata');
    //         $builder->select('admindata.*');
    //         $query = $builder->get($perPage,$offset);
    //         $admins_result = $query->getResultArray();
    //         $admins_links = $pager->makeLinks($admins_page, $perPage, $total,'default_full');
    //         $data['admins'] = $admins_result;
    //         $data['admins_total'] = $total;
    //         $data['admins_links'] = $admins_links;

    //         // 訂單分頁
    //         $order_page = (int) ($this->request->getGet('page') ?? 1);
    //         $perPage = 10;
    //         $offset = ($order_page - 1) * $perPage;
    //         $total = $db->table('order_info')->countAll();
    //         $builder = $db->table('order_info');
    //         $builder->select('order_info.*, memberdata.m_username');
    //         $builder->join('memberdata', 'order_info.m_ID = memberdata.m_ID');
    //         $query = $builder->get($perPage,$offset);
    //         $builder->orderBy('oi_ID', 'DESC');
    //         $order_info_result = $query->getResultArray();
    //         $order_info_links = $pager->makeLinks($order_page, $perPage, $total,'default_full');
    //         $data['order_info'] = $order_info_result;
    //         $data['order_info_total'] = $total;
    //         $data['order_info_links'] = $order_info_links;


    //         echo view('Admin/Backend_system', $data);

    //     }else{
    //         // 查無管理員資料時導至登入介面
    //         return redirect()->to('AdminLogin');
    //     }
        

        
    // }

    public function index()
    {
        $session = session();
        // 取得當前管理員資料
        $curr_username =  $session->get('username');
        if ($curr_username) {
            

            return view('Admin/BackendPage/Backend_tags')
                  .view('Admin/BackendPage/edit_account');
        }else{
            // 查無管理員資料時導至登入介面
            return redirect()->to('AdminLogin');
        }
    }

    public function ChangePassword()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/change_password');
    }

    public function Products()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/products_list');
    }

    public function deleteProduct($sId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->delete(['sID' => $sId]);
        return redirect()->to('BackendPage');
    }

    public function Category()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/category_list');
    }

    public function Subcategory()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/subcategory_list');
    }

    public function Admin()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/admin_list');
    }

    public function Member()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/member_list');
    }

    public function Order()
    {
        return view('Admin/BackendPage/Backend_tags')
               .view('Admin/BackendPage/order_list');
    }
    
}
?>