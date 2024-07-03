<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ctr/css/All.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="ctr/js/jquery.min.js"></script>
    <script src="ctr/js/function.js"></script>
</head>
<body>
    <div class="public_container txt_center">
        <div class="edit_title_block">
            <h1  class="edit_title">我的商品-新增資料</h1>
        </div>
        <div class="href_block pages_href_block">
            <p>
                <a href="BackendPage" class='edit_link'>回主頁面</a>
            </p>
        </div>
        <div><span class='hint'>*</span>為必填欄位</div>
        <form action="AddProduct/Insert" method="post" name="formAdd" id="formAdd">
            <input type="hidden" name='insert' value='insert'>
            <table class="product_table pages_table">
                <tr class="t_title">
                    <th>欄位</th>
                    <th>資料</th>
                </tr>

                <tr>
                    <td>商品排序</td>
                    <td>
                        <input type="text" name="sSort" id="sSort" placeholder="(選填)">
                    </td>
                </tr>


                <tr>
                    <td>商品類別<span class='hint'>*</span></td>
                    <td>
                        <select name="categoryID" id="category_option">
                            <?php
                                foreach($subcategory as $item){
                                    echo "<option value='{$item['categoryID']}'>{$item['categoryName']}</option>";
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
                
                <tr>
                    <td>商品項目<span class='hint'>*</span></td>
                    <td>
                        <select name="subcategoryID" id="subcategory_option">

                            
                        </select>
                    </td>
                </tr>
                <script>
                    repeat_option_remove($('#category_option option'));
                    create_option($('#category_option').val(),$('.subcategory_hidden_input'),'categoryid','subcategoryid',$('#subcategory_option'));
                    

                    $('#category_option').change(function(){
                        let categoryId = $(this).val();
                        create_option(categoryId,$('.subcategory_hidden_input'),'categoryid','subcategoryid',$('#subcategory_option'));
                        
                    })


                </script>


                <tr>
                    <td>圖片上傳<span class='hint'>*</span></td>
                    <td class='imgUpload_block'>
                        <input type="file" id="sIMG" name='sIMG' class="required">
                    </td>
                </tr>
                <script>
                    $('#sIMG').change(function(){
                        let ori_path = $(this).val();
                        let new_path = ori_path.replace(/^.*[\\\/]/, ''); 
                        $(this).val(new_path);
                    })
                </script>

                <tr>
                    <td>商品名稱<span class='hint'>*</span></td>
                    <td>
                        <input type="text" name="sName" id="sName" class="required">
                    </td>
                </tr>

                <tr>
                    <td>商品原價<span class='hint'>*</span></td>
                    <td>
                        <input type="text" name="sOri_Price" id="sOri_Price" class="num_input required">
                    </td>
                </tr>

                <tr>
                    <td>網路價格<span class='hint'>*</span></td>
                    <td>
                        <input type="text" name="sDiscount" id="sDiscount" class="num_input required">
                    </td>
                </tr>

                <tr>
                    <td valign="top">商品敘述<span class='hint'>*</span></td>
                    <td>
                        <textarea name="sNarrate" id="sNarrate" class="required"></textarea>
                    </td>
                </tr>

                <tr>
                    <td valign="top">商品內容1</td>
                    <td>
                        <textarea name="sContent1" id="sContent1" placeholder="填入內容(選填)"></textarea>
                    </td>
                </tr>

                <tr>
                    <td valign="top">商品內容2</td>
                    <td>
                        <textarea name="sContent2" id="sContent2" placeholder="填入內容(選填)"></textarea>
                    </td>
                </tr>

                <tr>
                    <td valign="top">商品內容3</td>
                    <td>
                        <textarea name="sContent3" id="sContent3" placeholder="填入內容(選填)"></textarea>
                    </td>
                </tr>
                
                <tr>
                    <input class="hidden" name="action" value="add">
                    <td class="btn_block" colspan="2">
                        <button type="submit" name="Btn1" class="Btn addBtn">新增資料</button>
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