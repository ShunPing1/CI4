
        <!-- banner -->
        <div class="banner_block">
            <div class="banner">
                <img src="<?= base_url('ctr/img/shop_img.PNG')?>" alt="">
            </div>
        </div>
        <div class="path_block">
            <div class="public_container path">
                <div class="links">
                    <div class="link"><a href="#">首頁</a></div>
                    <div class="link"><a href="#" class="path_active">購物車</a></div>
                </div>
            </div>
        </div>
        <div class="page_products_block">
            <div class="public_container">
                <section class="order_content_block">
                    <div class="order_content">
                        <form id="order_content_form">
                            <div class="order_content_table sc_order_content_block">
                                <!-- 1 -->
                                <div class="order_content_head">
                                    <!-- 2 -->
                                    <div class="order_content sc_order_head">
                                        <!-- 3 -->
                                        <div class="public_order_title">
                                            <input type="checkbox" name="all_choice" class="public_choice all_choice">
                                        </div>
                                        <!-- 3 -->
                                        <div class="sc_product_infor sc_PC_infor">
                                            <!-- 4 -->
                                            <div class="sc_PC_left">
                                                <div class="public_order_title sc_title_name">品名</div>
                                            </div>
                                            <!-- 4 -->
                                            <div class="sc_PC_right">
                                                <div class="public_order_title sc_title_format">規格</div>
                                                <div class="public_order_title sc_title_amount">數量</div>
                                            </div>
                                        </div>
                                        <!-- 3 -->
                                        <div class="sc_product_infor sc_mobile_infor">
                                            <div class="public_order_title sc_order_title">商品資訊</div>
                                        </div>
                                        <!-- 3 -->
                                        <div class="public_order_title sc_current_title">小計</div>
                                    </div>
                                </div>

                                <!-- 1 -->
                                <div class="order_content_body">
                                    <!-- php 產內容 -->
                                     
                                        <?php foreach($carts as $item){ ?>
                                            
                                            <div class="sc_order_body">
                                                <!-- 3 -->
                                                <div class="public_order_content sc_check_content">
                                                    <input type="hidden" class="cart_sID" value='<?php echo $item['sID']?>'>
                                                    <input type="checkbox" class="public_choice choice">
                                                </div>
                                                <!-- 3 -->
                                                <div class="sc_product_infor">
                                                    <!-- 4 -->
                                                    <div class="sc_product_all sc_product_left">
                                                        <div class="public_order_content product_name_block sc_name_block">
                                                            <div class="order_img_block">
                                                                <div class="order_img">
                                                                    <img src="<?= base_url("ctr/img/{$item['sc_IMG']}")?>" alt="product_pic" class="product_pic">
                                                                </div>
                                                            </div>
                                                            <div class="public_order_text sc_name"><?php echo $item['sc_name']?></div>
                                                        </div>
                                                    </div>
                                                    <!-- 4 -->
                                                    <div class="sc_product_all sc_product_right">
                                                        <div class="public_order_text sc_content_format"><?php echo $item['sc_format']?></div>

                                                        <div class="amount_block sc_amount_block">
                                                            <button type="button" class="public_calc_btn" name="minus_btn"><i
                                                                    class="fa-solid fa-minus"></i></button>
                                                            <input type="text" class="amount_num" value="<?php echo $item['sc_amount']?>">
                                                            <button type="button" class="public_calc_btn" name="plus_btn"><i
                                                                    class="fa-solid fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- 3 -->
                                                <div class="public_order_content current_calc_block sc_current_block">
                                                    <div class="public_order_text current_calc_result sc_discount" price="<?php echo $item['sc_discount']?>">$0</div>
                                                    <input type="hidden" class="sc_ID" value='<?php echo $item['sc_ID']?>'>
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </div>

                                            </div>
                                        <?php }?>

                                </div>

                                <script>
                                    $('document').ready(()=>{

                                        $('.current_calc_result').each(function(index){
                                            let price = parseInt($(this).attr('price'));
                                            let amount = parseInt($(this).parents('.sc_order_body').find('.amount_num').val());
                                            let current_price = price * amount;
                                            $(this).text('$'+current_price);
                                        })
    
                                        // 更改全選狀態
                                        $('.choice').change(function () {
                                            if ($('.choice:checked').length === $('.choice').length) {
                                                $('.all_choice').prop('checked', true);
                                            } else {
                                                $('.all_choice').prop('checked', false);
                                            }
                                        });
    
                                        
                                        // 數量增減
                                        $('.public_calc_btn').click(function () {
                                            // PC & mobile 雙向綁定
                                            let input = $(this).parents('.sc_amount_block').find('.amount_num');
                                            let num = parseInt(input.val());
                                            
                                            
                                            if ($(this).attr('name') == 'plus_btn') {
                                                num++;
                                                input.val(num); 
                                            } else {
                                                num--;
                                                if (num < 1) return;
                                                input.val(num);
                                                
                                            };
                                            // 小計金額
                                            currentResult(input);
                                            // 計算總計金額 
                                            showTotalPrice()
                                        });
    
                                        // .amount_num 防呆
                                        $('.amount_num').change(function () {
                                            let inputValue = $(this).val();
                                            if (!isNaN(inputValue) && !!inputValue && inputValue > 0) {
                                                currentResult($(this));
                                                
                                                
                                            } else {
                                                alert('請輸入正確數量');
                                                $(this).val(1);
                                                currentResult($(this));
                                                
                                            }
                                        });
    
                                        // 刪除購物車
                                        $('.fa-trash-can').click(function () {
                                            let cart_Id = $(this).prev('.sc_ID').val();
                                            $.ajax({
                                                type: 'post',
                                                url: 'ShoppingCart/delete',
                                                data: {
                                                    Delete_cart_Id: cart_Id
                                                },
                                                success: function(response){
                                                    console.log('回應：'+response);
                                                    window.location.reload();
                                                    
                                                },
                                                error: function(jqXHR, textStatus, errorThrown){
                                                    console.log('發送失敗:'+textStatus);
                                                }
                                            })
                                        });

                                        // 全選
                                        $('.all_choice').change(function () {
                                            let checked = $(this).prop('checked');
                                            if (checked) {
                                                $('.choice').prop('checked', true);
                                                
                                            } else {
                                                $('.choice').prop('checked', false);
                                            }
                                            $('.checked_amount').text(`共${$('.choice:checked').length}項商品`);
                                            showTotalPrice();
                                        })

                                        // 單選
                                        $('.choice').click(function(){
                                            $('.checked_amount').text(`共${$('.choice:checked').length}項商品`);
                                            showTotalPrice();
                                        })

                                        
                                        function showTotalPrice(){
                                            let recordSum = 0;
                                            $('.choice').each(function(){
                                                let checked = $(this).prop('checked');
                                                let price = parseInt($(this).parents('.sc_order_body').find('.sc_discount').text().replace('$',''));
                                                if (checked) {
                                                    recordSum += price;
                                                } 
                                            })

                                            totalResult(recordSum);
                                        }
                                        

                                        function totalResult(item) {
                                            let discount = parseInt($('.calc_discount').attr('discount'));
                                            let fare = parseInt($('.calc_fare').attr('fare'));
                                            if (item > 0) {
                                                $('.sum_result').text('$' + item);

                                                item -= discount;
                
                                                item -= fare;
                
                                                $('.calc_total_result').html('$' + item);
                                            }else{
                                                $('.sum_result').text('$' + item);
                                                $('.calc_total_result').html('$' + item);
                                            }
                                        }
    
                                        // Function-Area
                                        // 雙向綁定：待修-完成相依性 
                                        function bindValue(item) {
                                            let inputValue = item.val();
                                            let bindInput = item.parents('.public_order_content').find('.amount_num');
                                            bindInput.val(inputValue);
                                        }
    
    
                                        // 輸出小計
                                        function currentResult(input) {
                                            let value = input.val();
                                            let price = parseInt(input.parents('.sc_order_body').find('.current_calc_result').attr('price'));
                                            let calcResult = price * value;
                                            input.parents('.sc_order_body').find('.current_calc_result').html('$' + calcResult);
                                        }
                                    });
                                </script>

                            </div>
                        </form>
                        <div class="sc_price_calc_block">
                            <div class="sc_price_calc">
                                <div class="public_calc_content calc_left_content">
                                    <div>
                                        <span class='public_calc_text'>商品金額小計</span>
                                        <span class='public_calc_text sum_result'>$0</span>
                                    </div>
                                    <div>
                                        <span class='public_calc_text'>折扣</span>
                                        <span class="public_calc_text calc_discount" discount="0">$0</span>
                                    </div>
                                    <div>
                                        <span class='public_calc_text'>運費</span>
                                        <span class='public_calc_text calc_fare' fare="0">$0</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="calc_bottom_content">
                                    <div>
                                        <span class='public_calc_text total_price checked_amount'>共0項商品</span>
                                        <span class='public_calc_text total_price calc_total_result'>$0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="public_block guest_block">
                    <div class="public_main_title">訂購人資訊</div>
                    <form action="" id="guest">
                        <div class="public_information">
                            <div class="public_infor_content guest_name_block">
                                <div class="public_title">姓名</div>
                                <input type="text" id="guest_name" class='public_form_format'>
                            </div>
                            <div class="public_infor_content guest_phone_block">
                                <div class="public_title">電話</div>
                                <input type="text" id="guest_phone" class='public_form_format'>
                            </div>
                            <div class="public_infor_content guest_mail_block">
                                <div class="public_title ">Email</div>
                                <input type="email" id="guest_email" class='public_form_format'>
                            </div>
                        </div>
                        <div class="public_address_block">
                            <div class="public_title">地址</div>
                            <div class="public_address_top">
                                <select class="public_city guest_city public_form_format">
                                    <!-- JS 生內容 -->
                                </select>

                                <input type="text" id="guest_postal" class="postal_code public_form_format" value="406" readonly>
                                <select class="area_list guest_area public_form_format">
                                    <!-- JS 生內容 -->
                                </select>
                            </div>

                            <div class="public_address_bottom">
                                <div class="public_title">路/巷/弄/號/樓</div>
                                <input type="text" id="guest_full_address" class='public_form_format'>
                            </div>

                        </div>

                        <script>
                            $(document).ready(() => {
                                // 動態生成地區選單
                                let areaObj = [
                                    {
                                        city: '台中市',
                                        location: [
                                            {
                                                place: '北屯區',
                                                postal: '406'
                                            },
                                            {
                                                place: '西屯區',
                                                postal: '407'
                                            },
                                            {
                                                place: '南屯區',
                                                postal: '408'
                                            },
                                        ],
                                    },
                                    {
                                        city: '台北市',
                                        location: [
                                            {
                                                place: '大同區',
                                                postal: '103'
                                            },
                                            {
                                                place: '中山區',
                                                postal: '104'
                                            },
                                            {
                                                place: '松山區',
                                                postal: '105'
                                            },
                                        ],
                                    },
                                    {
                                        city: '高雄市',
                                        location: [
                                            {
                                                place: '前金區',
                                                postal: '801'
                                            },
                                            {
                                                place: '前鎮區',
                                                postal: '806'
                                            },
                                            {
                                                place: '左營區',
                                                postal: '813'
                                            },
                                        ],
                                    },
                                ];
                                let city = '';
                                let place = '';
                                // 生成預設的城市與地區選單
                                areaObj.forEach((item, index) => {
                                    city += `<option class="city_name" value="${item.city}">${item.city}</option>`;
                                    $('.public_city').html(city);

                                    item.location.forEach((locItem, locIndex) => {
                                        let cityChoice = $('.public_city').val();
                                        if (cityChoice === item.city) {
                                            place += `<option class="place_name" value="${locItem.place}">${locItem.place}</option>`;
                                        };
                                    });
                                    $('.area_list').html(place);
                                });

                                // 生成地區選項
                                $('.public_city').change(function () {
                                    let cityChoice = $(this).val();
                                    place = '';
                                    areaObj.forEach((item, index) => {
                                        item.location.forEach((locItem, locIndex) => {
                                            if (cityChoice === item.city) {
                                                place += `<option class="place_name" value="${locItem.place}">${locItem.place}</option>`;
                                                $('.area_list').html(place);
                                            };
                                        });
                                    });
                                });

                                // 點擊地區更新郵遞區號
                                $('.area_list').change(function () {
                                    let place = $(this);
                                    updatePostal(place);
                                });

                                // 點擊城市更新郵遞區號
                                $('.public_city').change(function () {
                                    let city = $(this).siblings('.area_list');
                                    updatePostal(city);
                                });

                                // 更改郵遞區號
                                function updatePostal(area) {
                                    areaObj.forEach((item, index) => {
                                        let placeChoice = area.val();
                                        item.location.forEach((locItem, locIndex) => {
                                            if (placeChoice == locItem.place) {
                                                area.siblings('.postal_code').val(locItem.postal);
                                            }
                                        });
                                    });
                                }

                            })
                        </script>

                    </form>
                </section>
                <section class="public_block payment_block">
                    <div class="public_main_title">付款寄送方式</div>
                    <form action="" id="payment">
                        <div class="public_title">寄送方式</div>
                        <div class="public_methods_block send_methods_block">

                            <label for="delivery" class="option_method send_method">
                                <input type="radio" name="send_method" id="delivery">
                                <span>宅配</span>
                            </label>
                            <label for="supermarket" class="option_method send_method">
                                <input type="radio" name="send_method" id="supermarket">
                                <span>超商</span>
                            </label>

                        </div>

                        <script>
                            // 寄送方式選取效果
                            $('.option_method').click(function () {
                                if ($(this).hasClass('send_method')) {
                                    $('.send_method').removeClass('method_checked');
                                    if ($(this).find('[type="radio"]').prop('checked')) {
                                        $(this).addClass('method_checked');
                                    };
                                } else {
                                    $('.pay_method').removeClass('method_checked');
                                    if ($(this).find('[type="radio"]').prop('checked')) {
                                        $(this).addClass('method_checked');
                                    };
                                }
                            });
                        </script>

                        <div class="send_information_block">
                            <div class="send_information">
                                <input type="checkbox" name="send_choice" id="same_infor">
                                <label for="same_infor">同會員資料</label>
                                <br>
                                <input type="checkbox" name="send_choice" id="other_infor">
                                <label for="other_infor">其他訂購人資料</label>
                            </div>
                        </div>

                        <script>
                            $(document).ready(() => {

                                // 同會員資料(複製功能)
                                $('#same_infor').change(function () {
                                    if ($(this).prop('checked')) {
                                        $('.payment_name').val($('.guest_name_block').find('#guest_name').val());
                                        $('.payment_phone').val($('.guest_phone_block').find('#guest_phone').val());
                                        $('.payment_mail').val($('.guest_mail_block').find('#guest_email').val());
                                        $('.payment_city').val($('.guest_city').val());
                                        $('#payment_postal').val($('#guest_postal').val());
                                        $('.payment_area').val($('.guest_area').val());
                                        $('#payment_full_address').val($('#guest_full_address').val());
                                        $('#other_infor').prop('checked', false);
                                    } else {
                                        $('#other_infor').prop('checked', true);
                                        $('.payment_name').val('');
                                        $('.payment_phone').val('');
                                        $('.payment_mail').val('');
                                        $('#payment_full_address').val('');
                                        $('#same_infor').prop('checked', false);
                                    };
                                });

                                // 其他訂購人資料(清空功能)
                                $('#other_infor').change(function () {
                                    if ($(this).prop('checked')) {
                                        $('.payment_name').val('');
                                        $('.payment_phone').val('');
                                        $('.payment_mail').val('');
                                        $('#payment_full_address').val('');
                                        $('#same_infor').prop('checked', false);
                                    } else {
                                        $('#same_infor').prop('checked', true);
                                        $('.payment_name').val($('.guest_name_block').find('#guest_name').val());
                                        $('.payment_phone').val($('.guest_phone_block').find('#guest_phone').val());
                                        $('.payment_mail').val($('.guest_mail_block').find('#guest_email').val());
                                        $('.payment_city').val($('.guest_city').val());
                                        $('#payment_postal').val($('#guest_postal').val());
                                        $('.payment_area').val($('.guest_area').val());
                                        $('#payment_full_address').val($('#guest_full_address').val());
                                        $('#other_infor').prop('checked', false);
                                    };
                                });
                            })
                        </script>


                        <div class="public_information">
                            <div class="public_infor_content  payment_name_block">
                                <div class="public_title">姓名</div>
                                <input type="text" id="payment_name" class="public_form_format payment_name">
                            </div>
                            <div class="public_infor_content payment_phone_block">
                                <div class="public_title">電話</div>
                                <input type="text" id="payment_phone" class="public_form_format payment_phone">
                            </div>
                            <div class="public_infor_content payment_mail_block">
                                <div class="public_title ">Email</div>
                                <input type="email" id="payment_email" class="public_form_format payment_mail">
                            </div>
                        </div>
                        <div class="public_address_block">
                            <div class="public_title">地址</div>
                            <div class="public_address_top">
                                <select class="public_city public_form_format payment_city">
                                    <!-- JS 生內容 -->
                                </select>
                                <input type="text" id="payment_postal" class="public_form_format postal_code" value="406" readonly>
                                <select class="public_form_format area_list payment_area">
                                    <!-- JS 生內容 -->
                                </select>
                            </div>
                            <div class="public_address_bottom">
                                <div class="public_title">路/巷/弄/號/樓</div>
                                <input type="text" id="payment_full_address" class='public_form_format'>
                            </div>

                        </div>

                        <div class="public_title">付款方式</div>
                        <div class="public_methods_block payment_methods_block">
                            <label for="creditCard" class="option_method pay_method">
                                <input type="radio" name="pay_method" id="creditCard">
                                <span>信用卡</span>
                            </label>
                            <label for="ATM" class="option_method pay_method">
                                <input type="radio" name="pay_method" id="ATM">
                                <span>虛擬ATM</span>
                            </label>
                            <label for="remit" class="option_method pay_method">
                                <input type="radio" name="pay_method" id="remit">
                                <span>匯款</span>
                            </label>
                            <label for="cash_on_delivery" class="option_method pay_method">
                                <input type="radio" name="pay_method" id="cash_on_delivery">
                                <span>貨到付款</span>
                            </label>
                        </div>
                        <script>
                            // 寄送方式選取效果
                            $('.option_method').click(function () {
                                if ($(this).hasClass('send_method')) {
                                    $('.send_method').removeClass('method_checked');
                                    if ($(this).find('[type="radio"]').prop('checked')) {
                                        $(this).addClass('method_checked');
                                    };
                                } else {
                                    $('.pay_method').removeClass('method_checked');
                                    if ($(this).find('[type="radio"]').prop('checked')) {
                                        $(this).addClass('method_checked');
                                    };
                                }
                            });
                        </script>
                    </form>
                </section>

                <section class="submit_btn_block">
                    <div class="submit_btns">
                        <a href="../shopping_list.php">
                            <button type="button" class="submit_btn continue_btn">繼續購物</button>
                        </a>
                        <button type="submit" class="submit_btn confirm_order_Btn">確認訂單</button>
                    </div>
                    <!-- 隱藏input用於ajax傳值 -->
                    <?php
                        // if (isset($username)) {
                        //     $sql_member_id = "SELECT m_ID FROM memberdata WHERE m_username = '$username'";
                        //     $result = $db_link->query($sql_member_id);
                        //     $row_result = $result->fetch_assoc();
                        //     $m_ID = $row_result['m_ID'];
                        //     $result->close();
                        //     echo "<input type='hidden' class='m_ID' value='$m_ID'>";
                        // }
                    ?>

                    <script>
                        
                        $('.confirm_order_Btn').click(function () {
                            let ajax_request = true;
                            // 尚未輸入防呆
                            if ($('.choice:checked').length === 0) {
                                alert('請勾選商品');
                                ajax_request = false;
                            }
                            // 文字輸入框
                            $('.public_block input').each(function (index, value) {

                                if (!!$(this).val()) {
                                    $('.public_block input').eq(index).removeClass('red');
                                } else {
                                    $('.public_block input').eq(index).addClass('red');
                                    ajax_request = false;
                                }
                            });
                            // radio按鈕
                            let sendRadio = $('input[name="send_method"]');
                            radioCheck(sendRadio);
                            let payRadio = $('input[name="pay_method"]');
                            radioCheck(payRadio);

                            $('.option_method').each(function(){
                                if ($(this).hasClass('red')) {
                                    ajax_request = false;
                                }
                            })

                            // 將更選後的購物車商品資訊存進陣列
                            let sID_arr = [];
                            let format_arr = [];
                            let amount_arr = [];
                            let price_arr = [];
                            $('.choice').each(function(index){
                                if ($('.choice').eq(index).prop('checked')) {
                                    sID_arr.push($('.choice').eq(index).prev('.cart_sID').val());
                                    console.log($('.choice').eq(index).parents('.sc_order_body').find('.sc_content_format').text());
                                    format_arr.push($('.choice').eq(index).parents('.sc_order_body').find('.sc_content_format').text());
                                    amount_arr.push($('.choice').eq(index).parents('.sc_order_body').find('.amount_num').val());
                                    price_arr.push($('.choice').eq(index).parents('.sc_order_body').find('.sc_discount').text().replace('$',''));
                                }
                            })


                            // 當資料填寫齊全才進行ajax請求
                            if (ajax_request) {
                                // 請求變數
                                   let get_mID = $('.m_ID').val();
                                   let get_totalPrice = $('.calc_total_result').text().replace('$','');
                                   let get_sendMethod = $('input[name="send_method"]:checked').next('span').text();
                                   let get_name = $('#payment_name').val();
                                   let get_phone = $('#payment_phone').val();
                                   let get_email = $('#payment_email').val();
                                   let get_postal = $('#payment_postal').val();
                                   let get_addr = $('.payment_city').val()+$('.payment_area').val()+$('#payment_full_address').val();
                                   let get_payMethod = $('input[name="pay_method"]:checked').next('span').text();
                                   let get_orderState;
                                   if (get_payMethod != '') {
                                        if ((get_payMethod === '信用卡')||(get_payMethod === '貨到付款')) {
                                            get_orderState = 1;
                                        }else{
                                            get_orderState = 2;
                                        }
                                    }
        
                                   $.ajax({
                                    type: 'post',
                                    url: '../ajax_request.php',
                                    data:{
                                        order_info: 'addorder_info',
                                        m_ID: get_mID,
                                        total_price: get_totalPrice,
                                        sendMethod: get_sendMethod,
                                        name: get_name,
                                        phone: get_phone,
                                        email: get_email,
                                        postal: get_postal,
                                        addr: get_addr,
                                        payMethod: get_payMethod,
                                        order_state: get_orderState,
                                        sID_arr: sID_arr,
                                        format_arr: format_arr,
                                        amount_arr: amount_arr,
                                        price_arr: price_arr
                                    },
                                    success: function(response){
                                        console.log('回應:'+response);
                                        alert('訂單送出成功!');
                                    },
                                    error: function(jqXHR, textStatus, errorThrown){
                                        console.log('發送失敗:'+textStatus);
                                    }
                                   })
                            }else{
                                alert('訂單送出失敗!');
                            }

                           
                           
                        });


                        // radio尚未填寫提示
                        function radioCheck(radio) {
                            let radioChecked = false;
                            radio.each(function (index, value) {
                                if (radio.eq(index).prop('checked')) {
                                    radioChecked = true;
                                };
                            });
                            if (radioChecked) {
                                radio.parent('label').removeClass('red');
                            } else {
                                radio.parent('label').addClass('red');
                            }
                        }
                    </script>
                </section>

            </div>


