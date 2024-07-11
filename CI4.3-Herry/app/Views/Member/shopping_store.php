<section class="main" id="main_shopping_link">
    <div class="banner_block">
        <div class="banner">
            <img src="ctr/img/shop_img.PNG" alt="">
        </div>
    </div>
    <div class="path_block">
        <div class="public_container path">
            <div class="links">
                <div class="link"><a href="#">首頁</a></div>
                <div class="link"><a href="#" class="path_active">購物商城</a></div>
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

    <div class="page_products_block">
        <div class="public_container page_products_all">
            <div class="page_products_left">
            <div class="select select_PC">
                <div class="type_block type_PC_block">
                    <a href="<?= base_url("ShoppingStore");?>">
                        <div class='option major_option all_product_tag'>所有商品</div>
                    </a>
                    </div>
                    <?php foreach($category as $c_item){ ?>
                        <div class="type_block type_PC_block">
                            <input type='hidden' name='<?php echo $c_item['categoryID'];?>'>
                            <div class='option major_option shorts_type'><?php echo $c_item['categoryName'];?><i class='fa-solid fa-angle-right'></i></div>
                            <div class='public_selects_block'>
                                <?php
                                    foreach($subcategory as $s_item){
                                        if ($c_item['categoryID'] == $s_item['categoryID']) {
                                            echo "<a href='".base_url("ShoppingStore?subcategoryID_search={$s_item['subcategoryID']}")."'><p class='option option_item'>".$s_item['subcategoryName']."</p></a>";
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
                        <div class="type_block type_PC_block">
                            <a href="<?= base_url("ShoppingStore");?>">
                                <div class='option major_option all_product_tag'>所有商品</div>
                            </a>
                        </div>
                        <?php foreach($category as $c_item){ ?>
                            <div class="type_block type_PC_block">
                                <input type='hidden' name='<?php echo $c_item['categoryID'];?>'>
                                <div class='option major_option shorts_type'><?php echo $c_item['categoryName'];?><i class='fa-solid fa-angle-right'></i></div>
                                <div class='public_selects_block'>
                                    <?php
                                        foreach($subcategory as $s_item){
                                            if ($c_item['categoryID'] == $s_item['categoryID']) {
                                                echo "<a href='".base_url("ShoppingStore?subcategoryID_search={$s_item['subcategoryID']}")."'><p class='option option_item'>".$s_item['subcategoryName']."</p></a>";
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
                <div class="img_container ">
                    
                    <?php
                        if (count($products) > 0 ) {
                            # code...
                            foreach($products as $item){
                                echo "<div class='img_content'>";
                                    echo "<div class='img_block'>";
                                        echo "<img src='ctr/img/heart-1.png' alt='favourite img' class='heart' data-id='".$item["sID"]."'>";
                                        echo "<a href='ShoppingDetail/index/".$item["sID"]."'>";
                                            echo "<img class='dynamic_img' src='ctr/img/".$item["sIMG"]."' alt='product img'>";
                                            echo "<div class='mask'>";
                                                echo "<div class='mask_more'>more</div>";
                                            echo "</div>";
                                        echo "</a>";
                                    echo "</div>";
                                    echo "<div class='img_pd img_title'>".$item["sName"]."</div>";
                                    echo "<div class='img_pd ori_price'>原價：$".$item["sOri_Price"]."</div>";
                                    echo "<div class='img_pd discount'>網路價：$".$item["sDiscount"]."</div>";
                                echo "</div>";
                            }
                        }else{
                            echo "<div class='non_product'>無相關商品</div>";
                        }
                    ?>
                </div>
                <div class="pagination_block txt_center">
                    <?php echo $products_links;?>
                </div>


                <script>
                    // 依據資料表內紀錄的資料，判斷愛心狀態
                    let favouriteArr = [];
                    $('.favourite_input').each(function(index){
                        favouriteArr.push(parseInt($(this).val()));
                    })
                    $('.heart').each(function(index){
                        if (favouriteArr.length > 0) {
                            for (let i = 0; i < favouriteArr.length; i++) {
                                if($(this).data('id') == favouriteArr[i]){
                                    $(this).attr('src','ctr/img/heart-2.png');
                                }
                            }
                        }

                    })
                    
                    // 愛心切換
                    $('.heart').click(function () {
                        let logChecked = $('.memberUser').val();
                        if (logChecked !== '') {
                            let getID = $(this).data('id');
                            let nowState;
                            let imgSrc = $(this).attr('src');
                            if (imgSrc === 'ctr/img/heart-1.png') {
                                nowState = 'true';
                                $(this).attr('src', 'ctr/img/heart-2.png');
                            } else {
                                nowState = 'false';
                                $(this).attr('src', 'ctr/img/heart-1.png');
                            }
                            console.log(nowState);

                            // 取得請求所需資料
                            let memberRecord = $('.memberUser').val();
                            // 發送ajax請求
                            $.ajax({
                                type: 'post',
                                url: 'MemberCenter/FavouriteState',
                                data: {
                                    favourite: 'favourite_switch',
                                    memberRecord: memberRecord,
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
                </script>
            
            </div>
        </div>  
    </div>
</seaction>
