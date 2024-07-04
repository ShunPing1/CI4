<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class ShoppingStore extends BaseController
{
    protected $dbService;

    public function __construct()
    {
        $this->dbService = new DatabaseService(); 
    }

    public function index(string $page = 'shopping_store')
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        // 取得產品
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/ShoppingStore');
        $product_page = (int) ($this->request->getGet('page') ?? 1);
        // 每頁顯示的資料筆數
        $perPage = 9;
        // 計算偏移量
        $offset = ($product_page - 1) * $perPage;
        $data['products'] = $this->dbService->getProducts($perPage,$offset);
        // 總資料筆數
        $products_total = $this->dbService->allDataNum('products');
        $data['products_total'] = $products_total;
        // 如果要使用 Pager 類別來生成分頁連結
        $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');
        $data['products_links'] = $products_links;
        
        
        // 取得類別
        $data['category'] = $this->dbService->getCategory();
        // 取得項目
        $data['subcategory'] = $this->dbService->getSubcategory();

        return view('Member/header', $data)
            . view('Member/' . $page)
            . view('Member/footer');
    }
    
}