<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;
use App\Services\DatabaseService;

class ShoppingStore extends BaseController
{
    public function index(string $page = 'shopping_store')
    {
        $db = \Config\Database::connect();
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        // 取得產品
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/ShoppingStore');
        $product_page = (int) ($this->request->getGet('page') ?? 1);
        $search = $this->request->getGet('subcategoryID_search') ?? '';
        // 每頁顯示的資料筆數
        $perPage = 9;
        // 計算偏移量
        $offset = ($product_page - 1) * $perPage;
        $builder = $db->table('products');
        $builder->select('*');

        if ($search) {
            $builder->where('subcategoryID', $search);
        }

        $builder->orderBy('sSort', 'ASC');
        $query = $builder->get($perPage,$offset);
        $products =  $query->getResultArray();
        // 總資料筆數
        
        if ($search) {
            $builder->resetQuery();
            $builder->select('*');
            $builder->where('subcategoryID', $search);
            $products_total = $builder->countAllResults();
        }else{
            $products_total = $db->table('products')->countAll();
        }
        // 如果要使用 Pager 類別來生成分頁連結
        $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');
        
        
        // 取得類別
        $category = $db->table('category')->select('*')->orderBy('categoryID', 'ASC')->get()->getResultArray();
        // 取得項目
        $subcategory = $db->table('subcategory')->select('*')->orderBy('subcategoryID', 'ASC')->get()->getResultArray();

        $data = [
            'products' => $products,
            'products_total' => $products_total,
            'products_links' =>  $products_links,
            'category' => $category,
            'subcategory' => $subcategory,
        ];

        // 會員登入版
        $session = session();
        if ($session->has('member_username')) {
            $m_username = $session->get('member_username');
            $favourite_result = $db->table('favourite')->select('*')->where('m_username', $m_username)->get()->getResultArray();;
            if ($favourite_result) {
               $data['favourite'] = $favourite_result;
            }
        }

        return view('Member/header', $data)
            . view('Member/' . $page)
            . view('Member/footer');
    }
    
}