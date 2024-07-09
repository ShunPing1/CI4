<div class="backend_container_right">
                    <div class="backend_r_top_block">
                        <div class="backend_search_block">
                            <form action="" method="get">
                                <input type="text" name="keyword" placeholder="搜尋關鍵字...">
                                <select name="subcategory_option" id="subcategory_option">
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
                            <p>項目數量：
                                <?php echo $subcategory_total;?>
                                <a href="../CRUD/add.php" class='add_product hrefBtn'>新增類別</a>
                            </p>
                        </div>
                    </div>
                    <table class="product_table main_table">
                        <tr class="t_title">
                            <th>項目排序</th>
                            <th>項目類別</th>
                            <th>項目名稱</th>
                            <th>編輯</th>
                        </tr>
                        
                        <!-- 資料內容 -->
                        <?php
                            if (count($subcategory) > 0) {
                                # code...
                                foreach ($subcategory as $item){
                                
                                    echo "<tr class='odd_list'>";
                                        echo "<td>".$item['subcategorySort']."</td>";
                                        echo "<td>".$item['categoryName']."</td>";
                                        echo "<td>".$item['subcategoryName']."</td>";
                                        echo "
                                        <td>
                                            <i class='fa-solid fa-file-pen'></i>
                                            <button type='submit' class='editBtn deleteBtn'><i class='fa-solid fa-trash'></i></button>
                                            <button type='submit' class='editBtn removeBtn'><i class='fa-solid fa-ban'></i></i></button>
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
                        $subcategory_links;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>