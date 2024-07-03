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
    <div class="page_products_block">
        <div class="public_container page_products_all">
            <div class="page_products_left">
                <?php
                    require_once "category_menu.php";
                ?>
            </div>
            <div class="page_products_right">
                <div class="img_container ">
                    
                    <?php
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
                    ?>
                </div>
                <div class="page_block">
                    <?php echo $products_links;?>
                </div>


                <script>
                    // 依據資料表內紀錄的資料，判斷愛心狀態
                    let favouriteArr = [];
                    $('.favourite_product').each(function(index){
                        favouriteArr.push(parseInt($(this).val()));
                    })
                    $('.heart').each(function(index){
                        if (($('.favourite_product').val()!=='')) {
                            for (let i = 0; i < favouriteArr.length; i++) {
                                if($(this).data('id') == favouriteArr[i]){
                                    $(this).attr('src','ctr/img/heart-2.png');
                                }
                            }
                        }

                    })
                    
                    // 愛心切換
                    $('.heart').click(function () {
                        let logChecked = $('.loginCheck').data('login');
                        if (logChecked === 'login') {
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

                            // 取得請求所需資料
                            let getUserName = $('.memberRecord').data('user');
                            // 發送ajax請求
                            $.ajax({
                                type: 'post',
                                url: 'ajax_request.php',
                                data: {
                                    favourite: 'addfavourite',
                                    getUserName: getUserName,
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


        <a href="#" class="go_top">
            <img src="ctr/img/TOP.png" alt="">
        </a>
    </div>
</seaction>
