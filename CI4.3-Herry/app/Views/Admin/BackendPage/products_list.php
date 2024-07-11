                <div class="backend_container_right">
                    <div class="backend_r_top_block">
                        <div class="backend_search_block">
                            <form action="<?= base_url('BackendPage/Products');?>" method="get">
                                <input type="text" name="keyword" placeholder="搜尋關鍵字...">
                                <select name="subcategory_type" id="subcategory_option">
                                    <option value="all">所有項目</option>
                                    <?php
                                        if (isset($subcategoryNames)) {
                                            foreach($subcategoryNames as $item){
                                                echo "<option value='{$item['subcategoryID']}'>{$item['subcategoryName']}</option>";
                                            }
                                        }
                                    ?>
                                </select>

                                <button type="submit" class="searchBtn">搜尋 <i class="fa-solid fa-magnifying-glass search_text"></i></button>
                                <a href='<?= base_url('BackendPage/Products');?>'>
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
                            if (isset($products) && count($products) > 0) {
                                # code...
                                foreach ($products as $product){?>
                                
                                    <tr class='t_content'>
                                        <input type="hidden" class='sID' value='<?php echo $product["sID"];?>'>
                                        <td><input type='checkbox' class='product_choice'></td>
                                        <td><input type='text' class='required list_input sSort' name='sSort' value='<?php echo $product["sSort"];?>'></td>
                                        <td>
                                            <input type='file' class='img_file hidden' value='<?php echo $product["sIMG"];?>'>
                                            <input type='next' class='sIMG hidden' name='sIMG' value='<?php echo $product["sIMG"];?>'>
                                            <img src='<?= base_url('ctr/img/'.$product["sIMG"])?><?php $product["sIMG"];?>' class='product_img' alt='商品圖片'>
                                        </td>
                                        <td><input type='text' name='sName[]' value='<?php echo $product["sName"];?>' class='required list_input sName'></td>
                                        <!-- <td><input type='text' name='sName[]' value='<?php //echo $product["subcategoryName"];?>' class='required list_input sName'></td> -->
                                        <td><?php echo $product["subcategoryName"];?></td>
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
                    <script>
                        // 點擊圖片觸發input file點擊事件
                        $('.product_img').click(function(){
                            $(this).siblings('.img_file').trigger('click');
                        })
                        $('.img_file').change(function(){
                            let new_path = $(this).val().replace(/^.*[\\\/]/, ''); 
                            $(this).next('.sIMG').val(new_path);
                        })

                    </script>
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
                        // 批次修改
                        $('.product_all_update').click(function(){
                            let sID_arr = [];
                            let sort_arr = [];
                            let img_arr = [];
                            let name_arr = [];
                            let ori_price_arr = [];
                            let discount_arr = [];
                            $('.product_choice').each(function(){
                                if ($(this).prop('checked')) {
                                    sID_arr.push($(this).parents('.t_content').find('.sID').val());
                                    sort_arr.push($(this).parents('.t_content').find('.sSort').val());
                                    img_arr.push($(this).parents('.t_content').find('.sIMG').val());
                                    name_arr.push($(this).parents('.t_content').find('.sName').val());
                                    ori_price_arr.push($(this).parents('.t_content').find('.sOri_Price').val());
                                    discount_arr.push($(this).parents('.t_content').find('.sDiscount').val());
                                }
                            })
                            if (sID_arr.length > 0) {
                                $.ajax({
                                    type: 'post',
                                    url: '/Herry/CI4.3-Herry/BackendPage/BatchUpdateProducts',
                                    data:{
                                        sID_arr: sID_arr,
                                        sort_arr: sort_arr,
                                        img_arr: img_arr,
                                        name_arr: name_arr,
                                        ori_price_arr: ori_price_arr,
                                        discount_arr: discount_arr,
                                    },
                                    success: function(response){
                                        console.log('回應：'+response);
                                        window.location.reload();
                                        
                                    },
                                    error: function(jqXHR, textStatus, errorThrown){
                                        console.log('發送失敗:'+textStatus);
                                    }
                                })
                            }else{
                                alert('尚未勾選修改項目!');
                            }
                            
                        })  
                    </script>
                    <div class="pagination_block txt_center">
                        <?php echo $products_links;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>