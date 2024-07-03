<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../ctr/css/All.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="../../ctr/js/jquery.min.js"></script>
    <script src="../../ctr/js/function.js"></script>
</head>
<body>
    <div class="public_container txt_center">
        <div class="edit_title_block">
            <h1 class="edit_title">我的商品-更新資料</h1>
        </div>
        <div class="href_block pages_href_block">
            <p>
                <a href="/Herry/CI4.3-Herry/BackendPage" class='backend_system'>回主頁面</a>
            </p>
        </div>
        <form action="/Herry/CI4.3-Herry/UpdateProduct/update" method="post" name="formAdd" id="formAdd">
            <table class="product_table  pages_table">
                <tr class="t_title">
                    <th>欄位</th>
                    <th>資料</th>
                </tr>

                <tr>
                    <td>目前排序</td>
                    <td>
                        <input type="text" name="sSort" id="sSort" value="<?php echo $sSort;?>" class="required">
                    </td>
                </tr>
                <script>
                    $total_result = parseInt($('#total_sort').val());
                    console.log($total_result);
                    $('#sSort').change(function(){
                        if (isNaN($(this).val())) {
                            alert('請輸入數字');
                            $(this).val('');
                        }
                    });
                </script>

                <tr>
                    <td>商品類別</td>
                    <td>
                        <select name="categoryID" id="update_category_select">
                            <?php
                                foreach($subcategory as $item){
                                    if ($categoryID == $item['categoryID']) {
                                        echo "<option value='{$item['categoryID']}'>{$item['categoryName']}</option>";
                                    }
                                }
                           
                                foreach($subcategory as $item){
                                    if ($categoryID != $item['categoryID']) {
                                        echo "<option value='{$item['categoryID']}'>{$item['categoryName']}</option>";
                                    }
                                }
                            ?>

                        </select>
                    </td>
                </tr>
                <?php
                    foreach($subcategory as $item){
                        echo "<input type='hidden' class='subcategory_hidden_input' data-subcategoryId='{$item['subcategoryID']}' data-categoryId='{$item['categoryID']}' value='{$item['subcategoryName']}'>";
                    }
                ?>
                <script>
                    // 移除類別重複選項
                    repeat_option_remove($('#update_category_select option'));
                </script>

                <tr>
                    <td>商品項目</td>
                    <td>
                        <select name="subcategoryID" id="update_subcategory_select">
                            <?php
                                foreach($subcategory as $item){
                                    if ($subcategoryID == $item['subcategoryID']) {
                                        echo "<option value='{$item['subcategoryID']}'>{$item['subcategoryName']}</option>";
                                    }
                                }
                                foreach($subcategory as $item){
                                    if ($categoryID == $item['categoryID'] && $subcategoryID != $item['subcategoryID']) {
                                        echo "<option value='{$item['subcategoryID']}'>{$item['subcategoryName']}</option>";
                                    }
                                }


                            ?>

                        </select>
                    </td>
                </tr>
                <script>
                    let input = $('.subcategory_hidden_input');
                    let input_data01 = 'categoryid';
                    let input_data02 = 'subcategoryid';
                    let select = $('#update_subcategory_select');
                    $('#update_category_select').change(function(){
                        let categoryId = $(this).val();
                        create_option(categoryId,input,input_data01,input_data02,select);
                        console.log($('#update_subcategory_select').val());
                    })
                </script>
                

                <tr>
                    <td>圖片上傳</td>
                    <td class='imgUpload_block'>
                        <input type="file" id="file_change" class='hidden'>
                        <button type='button'>
                            <label for="file_change" class="file_Btn">
                                選擇檔案
                            </label>
                        </button>
                        <input type="text" name="sIMG" id="sIMG" value="<?php echo $sIMG;?>"  class="file_path required" readonly>
                    </td>
                </tr>
                <script>
                    $('#file_change').change(function(){
                        let path = $(this).val();
                        let newPath = path.split('\\').pop();

                        if ($('#file_change').val() !== '') {
                            $('.file_path').val(newPath);
                        }else{
                            console.log('null');
                        }
                    })
                </script>

                <tr>
                    <td>商品名稱</td>
                    <td>
                        <input type="text" name="sName" id="sName" value="<?php echo $sName;?>" class="required">
                    </td>
                </tr>

                <tr>
                    <td>商品原價</td>
                    <td>
                        <input type="text" name="sOri_Price" id="sOri_Price" value="<?php echo $sOri_Price;?>"  class="num_input required">
                    </td>
                </tr>

                <tr>
                    <td>網路價格</td>
                    <td>
                        <input type="text" name="sDiscount" id="sDiscount" value="<?php echo $sDiscount;?>" class="num_input required">
                    </td>
                </tr>

                <tr>
                    <td>商品敘述</td>
                    <td>
                        <textarea name="sNarrate" id="sNarrate" class="required"><?php echo $sNarrate;?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td valign="top">商品內容1</td>
                    <td>
                        <textarea name="sContent1" id="sContent1" placeholder="填入內容(選填)"><?php echo $sContent1;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td valign="top">商品內容2</td>
                    <td>
                        <textarea name="sContent2" id="sContent2" placeholder="填入內容(選填)"><?php echo $sContent2;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td valign="top">商品內容3</td>
                    <td>
                        <textarea name="sContent3" id="sContent3" placeholder="填入內容(選填)"><?php echo $sContent3;?></textarea>
                    </td>
                </tr>

                <tr>
                    <input class="hidden" name="sID" value="<?php echo $sID;?>">
                    <input class="hidden" name="action" value="update">
                    <td class="btn_block" colspan="2">
                        <button type="submit" name="Btn1" class="Btn">更新資料</button>
                        <button type="reset" name="Btn2" class="Btn">清除重填</button>
                    </td>
                </tr>
                <!-- 防呆 -->
                <script>
                    $('.num_input').change(function () {
                        let inputValue = $(this).val();
                        if (isNaN(inputValue) || inputValue < 0 || inputValue > 999999999) {
                            alert('請輸入正確數字');
                            $(this).val('');
                        } 
                    });

                    let showAlert = true;
                    $('#formAdd').submit(function(event){
                        $('.required').each(function(index,item){
                            console.log($('.required').eq(index).val() || $('.required').eq(index).html());
                            if (!!$('.required').eq(index).val()) {
                                $('.required').eq(index).removeClass('red');
                            }else{
                                $('.required').eq(index).addClass('red');
                                // 判斷是否已經alert過了
                                if (showAlert) {
                                    alert('請輸入資料');
                                    showAlert = false;
                                    event.preventDefault();
                                }
                            }
                        });
                        
                        showAlert = true;
                    });
                </script>

            </table>
        </form>

    </div>
</body>
</html>