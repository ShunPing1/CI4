<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單詳細內容</title>
    <link rel="stylesheet" href="<?= base_url('ctr/css/All.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="<?= base_url('ctr/js/jquery.min.js')?>"></script>
</head>
<body>
<div class="public_container txt_center">
        <div class="edit_title_block">
            <h1 class="edit_title">訂單資訊-使用者訂單</h1>
        </div>
        <div class="href_block pages_href_block">
            <p>
                <a href="<?= base_url('BackendPage/Order')?>" class='backend_system'>回主頁面</a>
            </p>
        </div>
        <div class="all_detail_block">
            <div class="all_detail">
                <div class="order_detail_title_block">
                    <h2 class="order_detail_title">訂單商品</h2>
                </div>
                <div class="order_products_block">
                    <div class="order_products">
                        <form action="" method="post" name="formAdd" id="formAdd">
                            <table class="product_table  pages_table order_detail_table">
                                <tr class="t_title">
                                    <th>商品圖片</th>
                                    <th>商品名稱</th>
                                    <th>商品規格</th>
                                    <th>商品數量</th>
                                    <th>商品單價</th>
                                </tr>
                                <?php

                                    foreach($order_detail as $item){
                                        echo "<tr>";
                                            echo "<td><img src='".base_url("ctr/img/{$item['sIMG']}")."' class='order_detail_img' alt='訂單商品'></td>";
                                            echo "<td>".$item['sName']."</td>";
                                            echo "<td>".$item['od_format']."</td>";
                                            echo "<td>".$item['od_quantity']."</td>";
                                            echo "<td>".$item['od_price']."</td>";
                                        echo "</tr>";
                                    }
                                    
                                ?>

                            </table>
                        </form>
                    </div>
                </div>
                <div class="order_detail_title_block">
                    <h2 class="order_detail_title">訂單資訊</h2>
                </div>
                <div class="order_products_block">
                    <div class="order_products">
                        <form action="" method="post" name="formAdd" id="formAdd">
                            <table class="product_table  pages_table order_detail_table">
                                <tr class="t_title">
                                    <th>訂單狀態</th>
                                    <th>訂單編號</th>
                                    <th>總金額</th>
                                    <th>寄送方式</th>
                                    <th>訂購人資訊</th>
                                    <th>付款方式</th>
                                </tr>

                                <?php
                                    
                                    foreach($order_info as $item){
                                        echo "<tr>";
                                            echo "<td>".$item['order_state']."</td>";
                                            echo "<td>".$item['oi_ID']."</td>";
                                            echo "<td>".$item['total_price']."</td>";
                                            echo "<td>".$item['send_method']."</td>";
                                            echo "<td>
                                                    <div class='buyer_info_block'>
                                                        <div class='buyer_info'>
                                                            <div class='order_name'>姓名：".$item['buyer_name']."</div>
                                                            <div class='order_phone'>電話：".$item['buyer_phone']."</div>
                                                            <div class='order_email'>email：".$item['buyer_email']."</div>
                                                            <div class='order_addr'>地址：".$item['buyer_addr']."</div>
                                                            <div class='order_buytime'>訂購時間：".$item['buy_time']."</div>
                                                        </div>
                                                    </div>
                                                </td>";
                                            echo "<td>".$item['pay_method']."</td>";
                                        echo "</tr>";
                                    }

                                ?>

                            </table>
                        </form>
                    </div>
                </div>
                <div class="update_order_state_block">
                    <div class="update_order_state">
                        <form action="<?= base_url('BackendPage/UpdateOrderState')?>" method='post'>
                            <input type="hidden" name='oi_ID' value='<?php echo $oi_ID;?>'>
                            <select name="order_state" id="">
                                <option value="待付款">待付款</option>
                                <option value="待出貨">待出貨</option>
                                <option value="待收貨">待收貨</option>
                                <option value="已完成">已完成</option>
                                <option value="退貨/款">退貨/款</option>
                                <option value="失敗">失敗</option>
                            </select>
                            <button type='submit' class='order_all_update'>修改狀態</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
</html>