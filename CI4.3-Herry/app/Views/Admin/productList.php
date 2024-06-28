<div class="backend_r_top_block">
    <div class="backend_search_block">
        <form action="" method="get">
            <input type="text" name="keyword" placeholder="搜尋關鍵字...">
            <select name="category_option" id="category_option">
                <?php
                    // 接MODEL資料
                ?>
            </select>
            <button type="submit" class="searchBtn">搜尋 <i class="fa-solid fa-magnifying-glass search_text"></i></button>
            <a href='Backend_system.php'>
                <button type="button" class="searchBtn search_text">清除搜尋</button>
            </a>
        </form>
    </div>
    <div class="href_block">
        <p>商品數量：
            <?php   // 接MODEL資料 ?>
            <a href="../CRUD/add.php" class='add_product hrefBtn'>新增商品</a>
        </p>
    </div>
</div>
<table class="product_table main_table">
    <tr class="t_title">
        <th>選取</th>
        <th>商品排序</th>
        <th>商品圖片</th>
        <th>商品名稱</th>
        <th>商品項目</th>
        <th>商品原價</th>
        <th>網路價格</th>
        <th>編輯</th>
    </tr>
    
    <!-- 資料內容 -->
    <?php
        if (count($products) > 0) {
            # code...
            foreach ($products as $product){
               
                echo "<tr class='t_content'>";
                    echo "<td><input type='checkbox' class='checkBox'></td>";
                    echo "<td><input type='text' class='required list_input sSort' name='sSort[]' value='".$product["sSort"]."'></td>";
                    echo "<td>
                            <input type='hidden' class='sIMG' name='sIMG[]' value='".$product["sIMG"]."'>
                            <input type='hidden' class='update_img hidden'>
                            <img src='ctr/img/".$product["sIMG"]."' class='product_img' alt='商品圖片'>
                        </td>";
                    echo "<td><input type='text' name='sName[]' value='".$product["sName"]."' class='required list_input sName'></td>";
                    echo "<td><input type='text' name='sName[]' value='".$product["subcategoryName"]."' class='required list_input sName'></td>";
                    echo "<td><input type='text' name='sOri_Price[]' value='".$product["sOri_Price"]."' class='required list_input sOri_Price'></td>";
                    echo "<td><input type='text' name='sDiscount[]' value='".$product["sDiscount"]."' class='required list_input sDiscount'></td>";
                    echo "
                        <td class='edit_block'>
                            <input type='hidden' class='current_sID' name='sID' value='".$product["sID"]."'>
                            <input type='hidden' class='sID_hidden' name='sID[]' value='".$product["sID"]."'>
                            <a href='#".$product["sID"]."'><button type='button' class='editBtn updateBtn'><i class='fa-solid fa-file-pen'></i></button></a>
                            <button type='click' class='editBtn deleteBtn'><i class='fa-solid fa-trash'></i></button>
                        </td>";
                echo "</tr>";
            }
        }else{
            echo "<tr class='t_content'>";
                echo "<td colspan='7' class='pages_td'>查無結果</td>";
            echo "</tr>";
        }
    ?>
</table>
<div class="pagination">
    <?php echo $pager_links;?>
</div>