<?php

namespace App\Controllers\Ctr;

use App\Models\ProductModel;

use App\Controllers\BaseController;

class AddProduct extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('subcategory');

        // 使用 JOIN 關聯 orders 表格
        $builder->select('subcategory.*, category.categoryName');
        $builder->join('category', 'subcategory.categoryID = category.categoryID');
        $query = $builder->get();

        $data['subcategory'] = $query->getResultArray();

        return view('EditPage/add_product',$data);
    }

    public function Insert()
    {   
        $model = new ProductModel();
        $data = [
            'categoryID' => $this->request->getPost('categoryID'),
            'subcategoryID' => $this->request->getPost('subcategoryID'),
            'sSort' => $this->request->getPost('sSort'),
            'sIMG' => $this->request->getPost('sIMG'),
            'sName' => $this->request->getPost('sName'),
            'sOri_Price' => $this->request->getPost('sOri_Price'),
            'sDiscount' => $this->request->getPost('sDiscount'),
            'sNarrate' => $this->request->getPost('sNarrate'),
            'sContent1' => $this->request->getPost('sContent1'),
            'sContent2' => $this->request->getPost('sContent2'),
            'sContent3' => $this->request->getPost('sContent3'),
        ];

        $model->save($data);

        

        return redirect()->to('BackendPage/Products');
    }
    
}
?>