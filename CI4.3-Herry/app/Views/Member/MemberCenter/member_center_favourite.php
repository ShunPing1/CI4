        <div class="backend_container_right member_center_container">

            <!-- 隱藏欄位 member username -->
            <input type="hidden" class='memberUser' value='<?php if (isset($_SESSION['member_username'])) echo $_SESSION['member_username'];?>'>


            <?php if(isset($favourite_total) && $favourite_total > 0) {?>
                <div class="favourite_block  txt_center">
                    <div class="favourite_img_container ">
                        <?php
                            foreach($favourite as $item){
                                echo "<div class='favourite_img_content'>";
                                    echo "<div class='img_block favourite_img_block'>";
                                        echo "<img src='../ctr/img/heart-2.png' alt='favourite img' class='heart' data-id='".$item["sID"]."'>";
                                        echo "<a href='/Herry/CI4.3-Herry/ShoppingDetail/index/".$item["sID"]."'>";
                                            echo "<img class='dynamic_img' src='../ctr/img/".$item["sIMG"]."' alt='product img'>";
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
                </div>
                <script>
                    $('.heart').click(function(){
                        let nowState = 'false';
                        let getID = $(this).data('id');
                        let memberRecord = $('.memberUser').val();
                        if (confirm('確定要刪除嗎?')) {
                            $.ajax({
                                type: 'post',
                                url: '/Herry/CI4.3-Herry/MemberCenter/FavouriteState',
                                data: {
                                    favourite: 'favourite_switch',
                                    memberRecord: memberRecord,
                                    getProductsID: getID,
                                    favouriteState: nowState,
                                },
                                success: function(response){
                                    console.log('回應:'+response);
                                    window.location.reload();
                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                    console.log('發送失敗:'+textStatus);
                                }
                            })
                        }
                    })
                </script>
            <?php }else{?>
                <div class="basic_info_block  txt_center">
                        <div class="basic_info_title">查無資料</div>
                </div>
            <?php };?>
            <div class="pagination_block txt_center">
                <?php
                    if (isset($favourite_links)) {
                        echo $favourite_links;
                    }
                ?>
            </div>
        </div>
    </div>
</div>