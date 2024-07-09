                <div class="backend_container_right">
                    <div class="backend_r_top_block">
                        <div class="backend_search_block">
                            <form action="SearchProducts" method="get">
                                <input type="text" name="keyword" placeholder="搜尋關鍵字...">
                                <select name="products_option" id="products_option">
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
                                <?php  echo $products_total; ?>
                                <a href="<?= base_url('AddProduct')?>" class='add_product hrefBtn'>新增商品</a>
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
                                foreach ($products as $product){?>
                                
                                    <tr class='t_content'>
                                        <td><input type='checkbox' class='product_choice'></td>
                                        <td><input type='text' class='required list_input sSort' name='sSort[]' value='<?php echo $product["sSort"];?>'></td>
                                        <td>
                                                <input type='hidden' class='sIMG' name='sIMG[]' value='<?php echo $product["sIMG"];?>'>
                                                <input type='hidden' class='update_img hidden'>
                                                <img src='<?= base_url('ctr/img/'.$product["sIMG"])?><?php $product["sIMG"];?>' class='product_img' alt='商品圖片'>
                                            </td>
                                        <td><input type='text' name='sName[]' value='<?php echo $product["sName"];?>' class='required list_input sName'></td>
                                        <td><input type='text' name='sName[]' value='<?php echo $product["subcategoryName"];?>' class='required list_input sName'></td>
                                        <td><input type='text' name='sOri_Price[]' value='<?php echo $product["sOri_Price"];?>' class='required list_input sOri_Price'></td>
                                        <td><input type='text' name='sDiscount[]' value='<?php echo $product["sDiscount"];?>' class='required list_input sDiscount'></td>
                                        
                                            <td class='edit_block'>
                                                <a href='<?= base_url('UpdateProduct/index/'.$product["sID"])?>'><button type='button' class='editBtn updateBtn'><i class='fa-solid fa-file-pen'></i></button></a>
                                                <a href='<?= base_url('BackendPage/deleteProduct/'.$product["sID"])?>'><button type='click' class='editBtn deleteBtn'><i class='fa-solid fa-trash'></i></button></a>
                                            </td>
                                    </tr>
                        <?php    }
                            }else{
                                echo "<tr class='t_content'>";
                                    echo "<td colspan='7' class='pages_td'>查無結果</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                    <div class="all_edit_block">
                        <div class="all_edit">
                            <input type='checkbox' id='product_all_check'>
                            <label for="product_all_check">全選</label>
                            <button type='button' class='product_all_update'>批次修改</button>
                        </div>
                    </div>
                    <script>
                            $('#product_all_check').change(function(){
                            if ($(this).prop('checked')) {
                                $('.product_choice').prop('checked',true);
                            }else{
                                $('.product_choice').prop('checked',false);
                            }
                            })
                            // 更改全選狀態
                            $('.product_choice').change(function(){
                                if ($('.product_choice:checked').length === $('.product_choice').length) {
                                    $('#product_all_check').prop('checked',true);
                                }else{
                                    $('#product_all_check').prop('checked',false);
                                }
                            })
                    </script>
                    <div class="pagination">
                        <?php echo $products_links;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>