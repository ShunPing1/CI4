<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class ShoppingDetail extends BaseController
{
    public function index($sId,string $page = 'shopping_detail')
    {
        // 檢查檔案是否存在，若是不存在就拋出PageNotFoundException異常
        if (! is_file(APPPATH . 'Views/Member/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('products');
        $builder->where('sID', $sId);
        $query = $builder->get();
        $data=[];
        foreach($query->getResultArray() as $row){
            $data['sID'] = $row['sID'];
            $data['categoryID'] = $row['categoryID'];
            $data['subcategoryID'] = $row['subcategoryID'];
            $data['sSort'] = $row['sSort'];
            $data['sIMG'] = $row['sIMG'];
            $data['sName'] = $row['sName'];
            $data['sOri_Price'] = $row['sOri_Price'];
            $data['sDiscount'] = $row['sDiscount'];
            $data['sNarrate'] = $row['sNarrate'];
            $data['sContent1'] = $row['sContent1'];
            $data['sContent2'] = $row['sContent2'];
            $data['sContent3'] = $row['sContent3'];
        }

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


        return view('Member/header',$data)
            . view('Member/' . $page)
            . view('Member/footer');
    }
    
}