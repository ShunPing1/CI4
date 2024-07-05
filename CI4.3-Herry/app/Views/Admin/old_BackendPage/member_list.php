<div class="backend_r_top_block">
    <div class="backend_search_block">
        <form action="" method="get">
            <input type="text" name="keyword" placeholder="搜尋關鍵字...">
            <select name="member_option" id="member_option">
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
        <th>使用者名稱</th>
        <th>會員姓名</th>
        <th>電子郵件</th>
        <th>加入時間</th>
        <th>編輯</th>
    </tr>
    
    <!-- 資料內容 -->
    <?php
        if (count($members) > 0) {
            # code...
            foreach ($members as $item){
               
                echo "<tr class='odd_list'>";
                    echo "<td>".$item['m_username']."</td>";
                    echo "<td>".$item['m_name']."</td>";
                    echo "<td>".$item['m_email']."</td>";
                    echo "<td>".$item['m_jointime']."</td>";
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
<!-- 顯示分頁 -->
<?= 
    $admins_links;
 ?>