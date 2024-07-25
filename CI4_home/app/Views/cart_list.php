<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('Ctr/CSS/All.css');?>">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

    <div class="all">
        <div class="cart_list">
            <div class="product_price" data-product = '500'>商品金額: 500</div>
            <div class="contnet_amount">
                <button class='calc_btn reduce_btn'>-</button>
                <input type="text" class='amount' value='1'>
                <button class='calc_btn add_btn'>+</button>
            </div>

            <!-- 商品金額小計 -->
            <div class="content_calc_price flex_box">
                <div class="PC_contnet_calc_price" >500元</div>
                <div class="mobile_contnet_calc_price" >
                   商品小計 500元
                </div>
            </div>
        </div>

        <div class="cart_list">
            <div class="product_price" data-product = '600'>商品金額: 600</div>
            
            <div class="contnet_amount">
                <button class='calc_btn reduce_btn'>-</button>
                <input type="text" class='amount' value='1'>
                <button class='calc_btn add_btn'>+</button>
            </div>

            <!-- 商品金額小計 -->
            <div class="content_calc_price flex_box">
                <div class="PC_contnet_calc_price" >600元</div>
                <div class="mobile_contnet_calc_price" >
                   商品小計 600元
                </div>
            </div>
        </div>
        
        <div class="flex_box total_price">
            <div class="total_price_txt">商品金額總計</div>
            <div class="total_price_num">1100元</div>
        </div>

        <div class="discount_calc">
            <span class="total_price_txt">商品金額總計</span>
            <span class="total_price_num">1100元</span>
            <br>
            <span class="freight_txt">運費</span>
            <span class="freight" data-freight='200'>-200元</span>
            <br>
            <span class="discount_txt">折扣碼優惠</span>
            <span class="discount" data-discount='60'>-60元</span>
        </div>

        <div class="order_price_block">
            <span>商品總金額</span>
            <span class='order_total_price'>840元</span>
        </div>
    </div>

    <script>
        $('.calc_btn').click(function(){
            let amount = parseInt($(this).siblings('.amount').val());
            ($(this).hasClass('add_btn')) ? amount+=1 : amount-=1;
            $(this).siblings('.amount').val(amount);

            // 商品金額小計
            let product_price = $(this).parents('.cart_list').find('.product_price').data('product');
            let PC_calc_price = $(this).parents('.cart_list').find('.PC_contnet_calc_price');
            let mobile_calc_price = $(this).parents('.cart_list').find('.mobile_contnet_calc_price');
            let calc_price = amount * product_price;
            PC_calc_price.text(calc_price + '元');
            mobile_calc_price.text('商品小計'+calc_price + '元');

            // 商品金額總計
            $('.total_price_num').text(calc_total_price()+'元');

            // 商品總金額
            $('.order_total_price').text(order_total_price(calc_total_price())+ '元');
        })

        $('.amount').change(function(){
            let amount = parseInt($(this).val());

            // 商品金額小計
            let product_price = $(this).parents('.cart_list').find('.product_price').data('product');
            let PC_calc_price = $(this).parents('.cart_list').find('.PC_contnet_calc_price');
            let mobile_calc_price = $(this).parents('.cart_list').find('.mobile_contnet_calc_price');
            let calc_price = amount * product_price;
            PC_calc_price.text(calc_price + '元');
            mobile_calc_price.text('商品小計'+calc_price + '元');

            // 商品金額總計
            $('.total_price_num').text(calc_total_price()+'元');

            // 商品總金額
            $('.order_total_price').text(order_total_price(calc_total_price())+ '元');
        })



        function calc_total_price(){
            let total_price = 0;
            $('.cart_list').each(function(index){
                let calc_price_text = $('.PC_contnet_calc_price').eq(index).text();
                let calc_price = parseInt(calc_price_text.match(/\d+/)[0]); 
                total_price += calc_price;
            })
            return total_price;
        }

        function order_total_price(total_price){
            let freight = parseInt($('.freight').data('freight'));
            let discount = parseInt($('.discount').data('discount'));
            total_price  -= freight;
            total_price  -= discount;
            return total_price;
        }
    </script>

    <!-- 地區選單 -->
     <div class='select_block'>
        <div class="city_select">
            <div class="city select"> <span>請選擇縣市</span> <i class="fa-solid fa-chevron-down"></i></div>
            <div class="city_menu select_menu">
            </div>
        </div>
        <div class="postal_block">
            <div class="postal">
                412
            </div>
        </div>
        <div class="area_select">
            <div class="area select"> <span>請選擇地區</span> <i class="fa-solid fa-chevron-down"></i></div>
            <div class="area_menu select_menu">
            </div>
        </div>
        
     </div>
     <script>
        $(document).ready(function(){
            let city_path = '<?php echo base_url('Ctr/city.json');?>';
            console.log('path:',city_path);
            $.getJSON(city_path , function(data) {
                // 這裡的 data 是從 city.json 中載入的資料
                // 你可以在這裡處理並顯示資料

                // 範例：顯示城市和區域資料
                $.each(data, function(city,area) {
                    $('.city_menu').append("<div class='citymenu_option'>" + city + "</div>");

                });
            }).fail(function() {
                // 處理載入失敗的情況
                $('.city_menu').append('<p>載入資料失敗。</p>');
            });


            $('.select').click(function(){
                $(this).siblings('.select_menu').slideToggle();
            })

            // 點擊城市
            $('.city_menu').on('click','.citymenu_option',function(){
                $('.city span').text($(this).text());
                $('.city_menu').slideUp();

                // 選擇縣市後生城地區
                let current_city = $(this).text();

                $.getJSON(city_path , function(data) {
                    $.each(data, function(city,area) {
                        if (current_city == city) {

                            $('.postal').text(area[0].match(/\d+/));
                            $('.area span').text(area[0].match(/\D+/));
                            let menu_option = '';
                            $.each(area,function(index,value){
                                let match = value.match(/^(\d+)(\D+)$/);
                                let postal = match[1];
                                let area = match[2];
                                menu_option += "<div class='areamenu_option' data-postal='" + postal + "'>" + area + "</div>";
                            })
                            $('.area_menu').html(menu_option);
                        }

                    });
                }).fail(function() {
                    console.log('載入失敗');
                });

            })
            //點擊地區
            $('.area_menu').on('click','.areamenu_option',function(){
                    $('.area_menu').slideUp();
                let select_postal = $(this).data('postal');
                $('.postal').text(select_postal);
                $('.area span').text($(this).text());
            });


        })



     </script>



</body>
</html>