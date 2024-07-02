<?php
    namespace App\Models;

    use CodeIgniter\Model;
    
    class ProductModel extends Model
    {
        protected $table = 'products';
        protected $primaryKey = 'sID';
        protected $allowedFields = ['categoryID','subcategoryID','sSort','sIMG','sName','sOri_Price','sDiscount','sNarrate','sContent1','sContent2','sContent3'];
    
        
    }