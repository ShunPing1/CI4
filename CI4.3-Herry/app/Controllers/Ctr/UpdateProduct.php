<?php

namespace App\Controllers\Ctr;

use App\Controllers\BaseController;

class UpdateProduct extends BaseController
{
    public function index($sId)
    {
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
        $builder = $db->table('subcategory');
        $builder->select('subcategory.*, category.categoryName');
        $builder->join('category', 'subcategory.categoryID = category.categoryID');
        $query = $builder->get();
        $data['subcategory'] = $query->getResultArray();
       
        return view('EditPage/update_product',$data);
    }

    public function update()
    {
        if (isset($_POST)) {
            $sId = $_POST['sID'];
            $db = \Config\Database::connect();
            $builder = $db->table('products');
            $data = [
                'categoryID' => $_POST['categoryID'],
                'subcategoryID' => $_POST['subcategoryID'],
                'sSort' => $_POST['sSort'],
                'sIMG' => $_POST['sIMG'],
                'sName' => $_POST['sName'],
                'sOri_Price' => $_POST['sOri_Price'],
                'sDiscount' => $_POST['sDiscount'],
                'sNarrate' => $_POST['sNarrate'],
                'sContent1' => $_POST['sContent1'],
                'sContent2' => $_POST['sContent2'],
                'sContent3' => $_POST['sContent3'],
            ];
            $builder->where('sID', $sId);
            $builder->update($data);
            return redirect()->to('BackendPage');
        }
    }
    
}
?>