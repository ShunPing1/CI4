<?php
namespace App\Controllers;

use App\Models\DatabaseModel;

class Products extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('subcategory');
        $builder->select('*,category.categoryName');
        $builder->join('category', 'category.categoryID = subcategory.categoryID');
        $query = $builder->get();
        $products_result = $query->getResultArray();
        $data['products'] = $products_result;
        return view('Pages/products',$data);

    }
}
