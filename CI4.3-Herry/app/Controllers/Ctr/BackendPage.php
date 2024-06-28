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

        // 當前頁碼
        $page = (int) ($this->request->getGet('page') ?? 1);

        // 每頁顯示的資料筆數
        $perPage = 5;

        // 計算偏移量
        $offset = ($page - 1) * $perPage;

        // 總資料筆數（如果需要）
        $total = $db->table('products')->countAll();

        // 設置基礎路徑
        $pager->setPath('/Herry/CI4.3-Herry/BackendPage');

        // 如果要使用 Pager 類別來生成分頁連結
        $pager_links = $pager->makeLinks($page, $perPage, $total,'default_full');

        // 取得商品資料
        $query = $db->query("
            SELECT products.*, subcategory.subcategoryName 
            FROM products
            JOIN subcategory ON products.subcategoryID = subcategory.subcategoryID
            LIMIT $perPage OFFSET $offset
        ");
        $products_result = $query->getResultArray();


        
        // 管理員分頁效果
        $perPage = 10;
        $total = $db->table('admindata')->countAll();
        // 取得商品資料
        $query = $db->query("SELECT * FROM admindata LIMIT $perPage OFFSET $offset");
        // 取資料時使用陣列版本
        $admins_result = $query->getResultArray();


        $data = [
            'products' => $products_result,
            'admins' => $admins_result,
            'pager_links' => $pager_links,
        ];


        echo view('Admin/Backend_system', $data);
    }
    
}
?>