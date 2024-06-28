<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../ctr/css/All.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="../ctr/js/jquery.min.js"></script>
</head>
<body>
    <section id="header">
        <div class="top_nav_block">
            <div class="login_block">
                
                <?php if(!TRUE){?>
                    <input type="hidden" class="loginCheck" data-login="login">
                    <input type="hidden" class="memberRecord" data-user="<?php 'echo $_SESSION[loginMember]';?>">
                    <a href="#" class="nav_icon_block">
                        <span class="top_nav_text"  data-login="true">
                            <?php echo '使用者'; ?>
                        </span>
                        <span>您好!</span>
                    </a>
                    <div class="member_select_block">
                        <div class="member_select">
                            <a href="pages/member_center.php">
                                <div class="member_option">
                                    <nobr>會員中心</nobr>
                                </div>
                            </a>
                            <a href="?logout=true">
                                <div class="member_option">
                                    <nobr>登出</nobr>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- 選單效果 -->
                    <script>
                        $('.top_nav_text').mouseenter(function(){
                            $('.member_select_block').addClass('select_hover');
                        })
                        $('.member_select_block').mouseleave(function(){
                            $(this).removeClass('select_hover');
                        })
                    </script>
                    <div class="hidden">
                        <?php
                            // $username = $_SESSION['loginMember'];
                            // $sql_favourite = "SELECT * FROM favourite WHERE m_username = '$username'";
                            // $favourite_result = $db_link->query($sql_favourite);
                            // while($row_result = $favourite_result->fetch_assoc()){
                            //     echo "<input class='favourite_product' type='text' value='".$row_result['sID']."'>";
                            // }
                            // $favourite_result->close();

                        ?>
                    </div>
                <?php }else{?>
                    <!-- 使用隱藏input判斷登陸狀態 -->
                    <input type="hidden" class="loginCheck" data-login="unlogin">
                    <a href="pages/member_login.php" >
                        <img src="../ctr/img/會員登入-icon.png" alt="會員登入">
                        <span class="top_nav_text">會員登入</span>
                    </a>
                    <span>/</span>
                    <a href="pages/member_join.php" >
                        <span class="top_nav_text">註冊</span>
                    </a>
                    
                <?php }?>

                
            </div>
            <div class="shopping_cart_block">
                <?php if (TRUE) {?>
                    <a href="pages/shopping_cart.php" class="nav_icon_block">
                        <div class="cart_block">
                            <img src="../ctr/img/購物商城-icon.png" alt="購物商城">
                            <?php 
                                // $sql_cart_amount = "SELECT * FROM shopping_cart WHERE m_username = '$username'";
                                // $cart_amount_result = $db_link->query($sql_cart_amount);
                                // $cart_amount = $cart_amount_result->num_rows;
                                // $cart_amount_result->close();
                                if (TRUE) {
                                    echo "<div class='cart_amount'>3</div>";
                                }
                            ?>
                        </div>
                        <span class="top_nav_text">購物車</span>
                    </a>
                <?php }else{?>
                    <a href="pages/member_login.php" class="nav_icon_block">
                        <div class="cart_block">
                            <img src="../ctr/img/購物商城-icon.png" alt="購物商城">
                        </div>
                        <span class="top_nav_text">購物車</span>
                    </a>
                <?php }?>

            </div>
            <div class="search_block">
                <input type="text" name="" id="search" placeholder="搜尋">
                <button type="submit" class="search_submit">
                    <img src="../ctr/img/放大鏡-icon.png" alt="放大鏡">
                </button>
            </div>
        </div>
    </section>
    <section id="web_top_blank"></section>
    <section class="bottom_nav_block">
            <div class="public_container bottom_nav">
                <div class="nav_all_block">
                    <div class="nav_left_block">
                        <img src="../ctr/img/標題文字1.png" alt="">
                    </div>

                    <div class="nav_right_block">
                        <div class="nav_right_content">
                            <div class="ham-menu">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                            <div class="links nav_links">
                                <div class="link nav_link"><a href="#">關於我們</a></div>
                                <div class="link nav_link"><a href="#">最新消息</a></div>
                                <div class="link nav_link"><a href="#">購物商城</a></div>
                                <div class="link nav_link"><a href="#">知識文章</a></div>
                                <div class="link nav_link"><a href="#">聯絡我們</a></div>
                                <div class="link nav_link"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>