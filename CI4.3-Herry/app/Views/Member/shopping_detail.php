
            <!-- banner -->
            <div class="banner_block">
                <div class="banner">
                    <img src="../../ctr/img/shop_img.PNG" alt="">
                </div>
            </div>
            <div class="public_container">
                <div class="path_block">
                    <div class="public_container path">
                        <div class="links">
                            <div class="link"><a href="#">首頁</a></div>
                            <div class="link"><a href="#">購物商城</a></div>
                            <div class="link"><a href="#">上衣</a></div>
                        </div>
                    </div>
                </div>

                <!-- 隱藏欄位 member username -->
                <input type="hidden" class='memberUser' value='<?php if (isset($_SESSION['member_username'])) echo $_SESSION['member_username'];?>'>
                <!-- favourite -->
                <div class="hidden">
                    <?php
                        if (isset($_SESSION['member_username'])) {
                            if (isset($favourite)) {
                                foreach($favourite as $item){
                                    echo "<input class='favourite_input' value='{$item['sID']}'>";
                                }
                            }
                        }
                    ?>
                </div>

                <div class="page_products_all">
                    <div class="page_products_left">
                        <div class="select select_PC">
                            <?php foreach($category as $c_item){ ?>
                                <div class="type_block type_PC_block">
                                    <input type='hidden' name='<?php echo $c_item['categoryID'];?>'>
                                    <div class='option major_option shorts_type'><?php echo $c_item['categoryName'];?><i class='fa-solid fa-angle-right'></i></div>
                                    <div class='public_selects_block'>
                                        <?php
                                            foreach($subcategory as $s_item){
                                                if ($c_item['categoryID'] == $s_item['categoryID']) {
                                                    echo "<a href='#'><p class='option option_item'>".$s_item['subcategoryName']."</p></a>";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- 手機板選單 -->
                        <div class="select select_phone">
                            <p class="option option_all">
                                總選單<i class="fa-solid fa-angle-right"></i>
                            </p>
                            <!-- 選單內容 -->
                            <div class="phone_option_block">
                                <?php foreach($category as $c_item){ ?>
                                    <div class="type_block type_PC_block">
                                        <input type='hidden' name='<?php echo $c_item['categoryID'];?>'>
                                        <div class='option major_option shorts_type'><?php echo $c_item['categoryName'];?><i class='fa-solid fa-angle-right'></i></div>
                                        <div class='public_selects_block'>
                                            <?php
                                                foreach($subcategory as $s_item){
                                                    if ($c_item['categoryID'] == $s_item['categoryID']) {
                                                        echo "<a href='#'><p class='option option_item'>".$s_item['subcategoryName']."</p></a>";
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <script>
                            // 手風琴選單
                            $('.public_selects_block').hide();
                            $('.major_option').click(function () {
                                $(this).next('.public_selects_block').slideToggle('slow');
                                $('.major_option').not($(this)).next('.public_selects_block').slideUp('slow');
                                $('.major_option').not($(this)).find('i').removeClass('fa-chevron-down').addClass('fa-angle-right');
                                changeIcon($(this));
                            });

                            // 選單選取
                            $('.option_item').click(function () {
                                $('.option_item').removeClass('option_active');
                                $(this).addClass('option_active');
                            });

                            // 手機板總選單
                            $('.phone_option_block').hide();
                            $('.option_all').click(function () {
                                $('.phone_option_block').slideToggle('slow');
                                changeIcon($(this));
                            });

                            // 更換選單icon
                            function changeIcon(menu){
                                if (menu.find('i').hasClass('fa-chevron-down')) {
                                    menu.find('i').removeClass('fa-chevron-down').addClass('fa-angle-right');
                                } else {
                                    menu.find('i').removeClass('fa-angle-right').addClass('fa-chevron-down');
                                };
                            }
                        </script> 
                    </div>
                    <div class="page_products_right">
                        <div class="page_products_content_block">
                            <div class="page_products_content page_products_img">
                                <div class="coat_img_block">
                                    <img src="../../ctr/img/<?php echo $sIMG;?>" alt="" class="main_coat_img">
                                    <div class="coat_img"></div>
                                </div>
                                <!-- swiper -->
                                <div class="coat_swiper_block">
                                    <div class="hide_scroll">
                                        <div class="coat_swiper_scroll">
                                            <div class="coat_swiper">
                                                <div class="coat_swiper_item">
                                                    <img src="../../ctr/img/_CR836_color_3.jpeg" alt="" class="coat_swiper_img">
                                                </div>

                                                <div class="coat_swiper_item">
                                                    <img src="../../ctr/img/_CR836_color_4.jpeg" alt="" class="coat_swiper_img">
                                                </div>

                                                <div class="coat_swiper_item">
                                                    <img src="../../ctr/img/_CR836_color_2.jpeg" alt="" class="coat_swiper_img">
                                                </div>

                                                <div class="coat_swiper_item">
                                                    <img src="../../ctr/img/_CR836_color_3.jpeg" alt="" class="coat_swiper_img">
                                                </div>

                                                <div class="coat_swiper_item">
                                                    <img src="../../ctr/img/_CR836_color_4.jpeg" alt="" class="coat_swiper_img">
                                                </div>

                                                <div class="coat_swiper_item">
                                                    <img src="../../ctr/img/_CR836_color_2.jpeg" alt="" class="coat_swiper_img">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        // 點擊小圖換大圖圖片
                                        $('.coat_swiper_img').click(function () {
                                            $('.main_coat_img').attr('src', $(this).attr('src'))

                                        });

                                        // 動態調整.hide_scroll高度
                                        $('.hide_scroll').height($('.coat_swiper_item').height());
                                        $(window).resize(function () {
                                            $('.hide_scroll').height($('.coat_swiper_item').height());
                                        });
                                    </script>

                                    <div class="coat_switch coat_switch_left switch_hide"><i class="fa-solid fa-caret-left"></i></div>
                                    <div class="coat_switch coat_switch_right"><i class="fa-solid fa-caret-right"></i></div>

                                    <script>
                                        // 輪播
                                        let scrollBar = 0;
                                        $('.coat_switch').click(function () {
                                            let swiperWidth = $('.coat_swiper_item').width() + 8;
                                            if ($(this).hasClass('coat_switch_right')) {
                                                scrollBar++;
                                                $('.coat_swiper_scroll').scrollLeft(scrollBar * swiperWidth);
                                                if (scrollBar > 3) scrollBar = 3;
                                                // console.log('prev:', scrollBar);
                                            } else {
                                                scrollBar--;
                                                $('.coat_swiper_scroll').scrollLeft(scrollBar * swiperWidth);
                                                if (scrollBar < 0) scrollBar = 0;
                                                // console.log('next:' + scrollBar);

                                            };

                                            if (scrollBar <= 0) {
                                                // console.log('在最前方');
                                                $('.coat_switch_left').addClass('switch_hide');
                                            }else if(scrollBar >= 3){
                                                // console.log('在最後方');
                                                $('.coat_switch_right').addClass('switch_hide');
                                            }else{
                                                $('.coat_switch_left').removeClass('switch_hide');
                                                $('.coat_switch_right').removeClass('switch_hide');
                                            }
                                        });

                                        // 動態調整scrollBar位置
                                        $(window).resize(function(){
                                            let swiperWidth = $('.coat_swiper_item').width() + 8;
                                            $('.coat_swiper_scroll').scrollLeft(scrollBar * swiperWidth);
                                        })
                                    </script>

                                </div>
                            </div>
                            <div class="page_products_content page_price_information">
                                <div class="price_title_block">
                                    <div class="price_name"><?php echo $sName;?></div>
                                    <div class="favorite">
                                        <input class='productId' type="hidden" value='<?php echo $sID?>'>
                                        <img class='heart' src="../../ctr/img/heart-1.png" alt="">
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function(){
                                        // 愛心切換
                                        $('.favourite_input').each(function(index){
                                                let favoriteId = $('.favourite_input').eq(index).val();
                                                if ($('.productId').val() === favoriteId) {
                                                    $('.heart').attr('src',"../../ctr/img/heart-2.png");
                                                }
                                        })
                                        $('.heart').click(function () {
                                            let logChecked = $('.loginCheck').data('login');
                                            if (logChecked === 'login') {
                                                let nowState;
                                                let imgSrc = $(this).attr('src');
                                                if (imgSrc === '../../ctr/img/heart-1.png') {
                                                    nowState = 'true';
                                                    $(this).attr('src', '../../ctr/img/heart-2.png');
                                                } else {
                                                    nowState = 'false';
                                                    $(this).attr('src', '../../ctr/img/heart-1.png');
                                                }

                                                
                                                
                                                // 取得請求所需資料
                                                let getID = $('.productId').val();
                                                let getUserName = $('.memberUser').val();
                                                console.log(nowState);
                                                // 發送ajax請求
                                                $.ajax({
                                                    type: 'post',
                                                    url: '/Herry/CI4.3-Herry/MemberCenter/FavouriteState',
                                                    data: {
                                                        favourite: 'favourite_switch',
                                                        memberRecord: getUserName,
                                                        getProductsID: getID,
                                                        favouriteState: nowState,
                                                    },
                                                    success: function(response){
                                                        console.log('回應:'+response);
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown){
                                                        console.log('發送失敗:'+textStatus);
                                                    }
                                                })
                                            }else{
                                                alert('請先登入!');
                                            }
                                        });

                                        function switchHeart(imgSrc){

                                        }

                                    })
                                </script>

                                <div class="page_products_padding_right">
                                    <div class="product_narrate_block">
                                        <div class="narrate_title">商品敘述：</div>
                                        <div class="narrate_text">
                                            <?php echo $sNarrate;?>
                                        </div>
                                    </div>
                                    <div class="product_format_block">
                                        <div class="format_title">商品規格：</div>
                                        <div class="format_block">
                                            <div class="format_control">
                                                <div class="format_container format_tags">
                                                    <div class="format_item" formatID="formatA">規格A</div>
                                                    <div class="format_item" formatID="formatB">規格B</div>
                                                    <div class="format_item" formatID="formatC">規格C</div>
                                                    <div class="format_item" formatID="formatD">規格D</div>
                                                </div>
                                                <hr>
                                                <div class="format_container format_options">
                                                    <!-- JS 生成內容 -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        let formatArr = [
                                            {
                                                formatName: 'formatA',
                                                formatItems: ['規格A-1'],
                                            },
                                            {
                                                formatName: 'formatB',
                                                formatItems: ['規格B-1', '規格B-2', '規格B-3'],
                                            },
                                            {
                                                formatName: 'formatC',
                                                formatItems: ['規格C-1', '規格C-2'],
                                            },
                                            {
                                                formatName: 'formatD',
                                                formatItems: ['規格D-1', '規格D-2', '規格D-3', '規格D-4'],
                                            },
                                        ];

                                        // 點擊標籤生成子內容
                                        let subItems = '';
                                        $('.format_item').click(function () {
                                            subItems = '';
                                            let formatID = $(this).attr('formatID');
                                            formatArr.forEach((item, index) => {
                                                if (formatID === item.formatName) {
                                                    item.formatItems.forEach((ItemsValue) => {
                                                        subItems += `<div class="format_item format_subItem">${ItemsValue}</div>`;
                                                    })
                                                };
                                                $('.format_tags .format_item').removeClass('format_active');
                                                $(this).addClass('format_active');
                                                $('.format_options').html(subItems);
                                            });
                                        });

                                        // 使用事件委派綁定動態生成的元素
                                        $('.format_options').on('click', '.format_subItem', function () {
                                            $('.format_options .format_item').removeClass('format_active');
                                            $(this).addClass('format_active');
                                        });
                                    </script>

                                    <div class="price_calc_block">
                                        <div class="calc_content amount">
                                            <button type="button" class="calc_btn minus_btn"><i
                                                    class="fa-solid fa-minus"></i></button>
                                            <input type="text" name="" id="amount_input" class="amount_num" value="1">
                                            <button type="button" class="calc_btn plus_btn"><i
                                                    class="fa-solid fa-plus"></i></button>
                                        </div>
                                        <div class="calc_content sale">
                                            <p class="calc_item sd_OriPrice">售價$<?php echo $sOri_Price;?></p>
                                            <p class="calc_item discount_text">優惠價$<?php echo $sDiscount;?></p>
                                        </div>
                                    </div>

                                    <script>
                                        // 商品增減
                                        $('.calc_btn').click(function () {
                                            let input = $(this).siblings('#amount_input');
                                            let num = parseInt(input.val());
                                            if (num < 1) return;

                                            if ($(this).hasClass('plus_btn')) {
                                                num++;
                                                input.val(num);
                                            } else {
                                                num--;
                                                if (num < 1) return;
                                                input.val(num);
                                            };
                                        });

                                        // input 防呆
                                        $('#amount_input').change(function () {
                                            let inputVal = $(this).val();
                                            if (isNaN(inputVal) || inputVal < 0 || !!inputVal == false) {
                                                $(this).val(1);
                                                alert('請輸入正確數量');
                                            };
                                        });
                                    </script>

                                    <div class="pay_block">
                                        <div class="pay_btn to_pay">
                                                <a href="#">
                                                    <img src="../../ctr/img/去購物-icon.png" alt="">
                                                    &ensp;去結帳
                                                </a>
                                            </div>
                                        <div class="pay_btn add_cart">
                                            <img src="../../ctr/img/加入購物車-icon.png" alt="">
                                            &ensp;加入購物車
                                        </div>
                                        <script>
                                            $('document').ready(function(){
                                                
                                                $('.add_cart').click(function(event){
                                                    let img_path = $('.main_coat_img').attr('src');
                                                    let sc_img = img_path.replace(/^.*[\\\/]/, '');
                                                    let sc_name = $('.price_name').text();
                                                    let sc_format;
                                                    if ($('.format_subItem').length > 0) {
                                                        console.log('exist');
                                                        $('.format_subItem').each(function(index){
                                                            if ($(this).hasClass('format_active')) {
                                                                sc_format = $(this).text();
                                                            }
                                                        }) 
                                                    }else{
                                                        console.log('not exist');
                                                    }

                                                    if ($('.memberRecord').length > 0) {
                                                        let sc_price = saveNum($('.discount_text').text());
                                                        let sc_amount = $('.amount_num').val();
                                                        let m_username = $('.m_username').text();
                                                        let productId = $('.productId').val();
                                                        // 判斷是否有選取賞品規格
                                                        if (!!sc_format) {
                                                            // 傳購物車資訊給後端
                                                            $.ajax({
                                                                type: 'post',
                                                                url: 'ajax_request.php',
                                                                data: {
                                                                    sc_img: sc_img,
                                                                    sc_name: sc_name,
                                                                    sc_format: sc_format,
                                                                    sc_price: sc_price,
                                                                    sc_amount: sc_amount,
                                                                    m_username: m_username,
                                                                    addCart_productId: productId,
                                                                },
                                                                success: function(response){
                                                                    console.log('回應:'+response);
                                                                    alert('已新增商品至購物車!');
                                                                    window.location.reload();
                                                                },
                                                                error: function(jqXHR, textStatus, errorThrown){
                                                                    console.log('發送失敗:'+textStatus);
                                                                }
                                                            })
                                                        }else{
                                                            alert('請選擇商品規格');
                                                        }
                                                    }else{
                                                        alert('請先登入!');
                                                    }
                                                    
                                                })
                                            })
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="page_products_text_block">
                            <?php
                                $contentArr = array($sContent1,$sContent2,$sContent3);
                                foreach ($contentArr as $val){
                                    if ($val != NULL) {
                                        echo "<div class='pages_text_content'>";
                                        echo "<div class='text_content_title notNull'>商品資訊</div>";
                                        echo "<div class='text_content_text'>$val</div>";
                                        echo "</div>";
                                    }else{
                                        echo "<div class='pages_text_content'>";
                                        echo "</div>";
                                    }

                                }
                            
                            ?>
                        </div>


                        <div class="link_btn_block">
                            <a href="/Herry/CI4.3-Herry/ShoppingStore">
                                <div class="link_btn">回列表 ></div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>




