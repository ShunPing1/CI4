<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class ShoppingStore extends BaseController
{
    public function index(string $page = 'shopping_store')
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        $db = \Config\Database::connect();
        $pager = service('pager');
        $pager->setPath('/Herry/CI4.3-Herry/ShoppingStore');
        $product_page = (int) ($this->request->getGet('page') ?? 1);
        // 每頁顯示的資料筆數
        $perPage = 9;
        // 計算偏移量
        $offset = ($product_page - 1) * $perPage;
        // 總資料筆數
        $products_total = $db->table('products')->countAll();
        $builder = $db->table('products');
        $builder->select('*');
        $builder->orderBy('sSort', 'ASC');
        $query = $builder->get($perPage,$offset);
        $products_result = $query->getResultArray();
        // 如果要使用 Pager 類別來生成分頁連結
        $products_links = $pager->makeLinks($product_page, $perPage, $products_total,'default_full');
        $data['products'] = $products_result;
        $data['products_total'] = $products_total;
        $data['products_links'] = $products_links;


        $builder = $db->table('category');
        $builder->select('*');
        $builder->orderBy('categoryID', 'ASC');
        $query = $builder->get();
        $category_result = $query->getResultArray();
        $data['category'] = $category_result;

        $builder = $db->table('subcategory');
        $builder->select('*');
        $builder->orderBy('subcategoryID', 'ASC');
        $query = $builder->get();
        $subcategory_result = $query->getResultArray();
        $data['subcategory'] = $subcategory_result;

        return view('Member/header', $data)
            . view('Member/' . $page)
            . view('Member/footer');
    }
    
}