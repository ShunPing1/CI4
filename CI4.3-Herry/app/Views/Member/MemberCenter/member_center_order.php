        <div class="backend_container_right member_center_container">
            <div class=" member_order_scroll">
                <?php if (isset($order_amount) && $order_amount > 0) {?>

                    <div class="member_order_block">
                        <?php foreach($orders as $order){?>
                            <div class="member_order">
                                <div class="order_top_block">
                                    <div class="order_top">
                                        <div class="order_top_text order_num">訂單編號：<?php echo $order['order_info']['oi_ID'];?></div>
                                        <div class="order_top_text order_state"><?php echo $order['order_info']['order_state'];?></div>
                                    </div>
                                </div>
                                <hr class='public_bottom_hr'>
                                <div class="order_bottom_block">
                                    <div class="order_bottom">
                                        <div class="order_bottom_left_block">
                                            <div class="order_bottom_left">
                                                <div class="public_order_text send_method">寄送方式：<?php echo $order['order_info']['send_method'];?></div>
                                                <div class="public_order_text pay_method">付款方式：<?php echo $order['order_info']['pay_method'];?></div>
                                                <div class="public_order_text order_phone">手機：<?php echo $order['order_info']['buyer_phone'];?></div>
                                                <div class="public_order_text order_addr">地址：<?php echo $order['order_info']['buyer_addr'];?></div>
                                            </div>
                                        </div>
                                        <div class="order_bottom_right_block">
                                            <div class="order_bottom_right">
                                                <div class="order_taotal_price">總金額:<?php echo $order['order_info']['total_price'];?></div>
                                                <button type='button' class="order_moreBtn">more</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php foreach($order['order_details'] as $detail){?>
                                    
                                    <div class="order_detail_block hidden">
                                        <div class="order_detail">
                                            <div class="order_detail_left_block">
                                                <div class="order_detail_left">
                                                    <div class="order_img_block">
                                                        <div class="order_img">
                                                            <img src="<?= base_url("ctr/img/{$detail['sIMG']}")?>" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="order_info_block">
                                                        <div class="order_info">
                                                            <div class="public_detail_text order_product_name">商品名稱：<?php echo $detail['sName'];?></div>
                                                            <div class="public_detail_text order_product_format">商品規格：<?php echo $detail['od_format'];?></div>
                                                            <div class="public_detail_text order_product_amount">商品數量：<?php echo $detail['od_quantity'];?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order_detail_right_block">
                                                <div class="order_detail_right">
                                                    <div class="public_detail_text order_price">$<?php echo $detail['od_price'];?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php };?>
                            </div>
                        <?php } ?>
                        
                        <script>
                            $('.order_moreBtn').click(function(){
                                $(this).parents('.member_order').find('.order_detail_block').toggleClass('hidden');
                            })
                        </script>
                        
                    </div>
                <?php }else{?>
                    <div class="basic_info_block  txt_center">
                            <div class="basic_info_title">尚無訂單</div>
                    </div>
                <?php }?>

            </div>
                    
        </div>
    </div>
</div>