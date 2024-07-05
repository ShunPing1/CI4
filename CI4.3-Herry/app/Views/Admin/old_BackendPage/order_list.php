<div class="backend_r_top_block">
    <div class="backend_search_block">
        <form action="" method="get">
            <input type="text" name="keyword" placeholder="搜尋關鍵字...">
            <select name="order_option" id="order_option">
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
        </p>
    </div>
</div>
<table class="product_table main_table">
    <tr class="t_title">
        <th>選取</th>
        <th>訂單狀態</th>
        <th>訂單編號</th>
        <th>使用者名稱</th>
        <th>總金額</th>
        <th>下單日期</th>
        <th>編輯</th>
    </tr>
    
    <!-- 資料內容 -->
    <?php
        if (count($order_info) > 0) {
            # code...
            foreach ($order_info as $item){
               
                echo "<tr class='odd_list'>";
                    echo "<td><input type='checkbox' class='order_choice'></td>";
                    echo "<td>".$item['order_state']."</td>";
                    echo "<td>".$item['oi_ID']."</td>";
                    echo "<td>".$item['m_username']."</td>";
                    echo "<td>".$item['total_price']."</td>";
                    echo "<td>".$item['buy_time']."</td>";
                    echo "
                        <td>
                            <i class='fa-solid fa-file-pen'></i>
                            <button type='submit' class='editBtn deleteBtn'><i class='fa-solid fa-trash'></i></button>
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
<div class="all_edit_block">
    <div class="all_edit">
        <input type='checkbox' id='order_all_check'>
        <label for="order_all_check">全選</label>
        <select name="order_state" id="">
            <option value="">待付款</option>
            <option value="">待出貨</option>
            <option value="">待收貨</option>
            <option value="">已完成</option>
            <option value="">退貨/款</option>
            <option value="">失敗</option>
        </select>
        <button type='button' class='order_all_update'>批次修改</button>
    </div>
</div>
<script>
        $('#order_all_check').change(function(){
        if ($(this).prop('checked')) {
            $('.order_choice').prop('checked',true);
        }else{
            $('.order_choice').prop('checked',false);
        }
        })
        // 更改全選狀態
        $('.order_choice').change(function(){
            if ($('.order_choice:checked').length === $('.order_choice').length) {
                $('#order_all_check').prop('checked',true);
            }else{
                $('#order_all_check').prop('checked',false);
            }
        })
</script>
<!-- 顯示分頁 -->
<?= 
    $admins_links;
 ?>