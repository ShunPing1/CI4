<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>產品頁籤</title>
    <link rel="stylesheet" href="../CSS/All.css">
    <script src="JS/jquery3.js"></script>
    <style>
        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <div class="search_block">
        <form action="Products" method='get'>
            <input type="text" placeholder='請輸入內容：' name='search'>
            <button type='submit'>搜</button>
        </form>
    </div>
    商品總數：<?php echo $products_total?>
   <table>
        <tr>
            <th>排序</th>
            <th>商品名稱</th>
            <th>商品原價</th>
            <th>網路價</th>
        </tr>
        <?php
            foreach($products as $product){
                echo '<tr>';
                    echo "<td>{$product['sSort']}</td>";
                    echo "<td>{$product['sName']}</td>";
                    echo "<td>{$product['sOri_Price']}</td>";
                    echo "<td>{$product['sDiscount']}</td>";
                echo '</tr>';
            }
        ?>
   </table>
   <div class="pagination_block">
            <?= $products_links;?>
   </div>

</body>
</html>