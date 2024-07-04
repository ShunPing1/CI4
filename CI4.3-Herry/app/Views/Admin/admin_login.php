<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理員登入</title>
    <link rel="stylesheet" href="<?= base_url('ctr/css/All.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="<?= base_url('ctr/js/jquery.min.js')?>"></script>
</head>
<body> 
    <section class="public_container login_top_block">
        <div class="login_top">
            <img src="<?= base_url('ctr/img/標題文字1.png')?>" alt="">
            <p class="login_title">登入</p>
        </div>
    </section>
    <section class="login_main_block">
        <div class="public_container main">
            <div class="login_block">
                <div class="login">
                    <div class="login_title_block">
                        <div class="login_title">登入管理員系統</div>
                    </div>
                    <!-- 錯誤訊息 -->
                    <?php if (session()->getFlashdata('msg')) {?>
                        <div class="err_block">
                            <div class="error">
                                <div class="error_msg">
                                    <i class="fa-regular fa-circle-xmark"></i> 帳號或密碼錯誤 ! 請重新登入
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    <form action="<?= base_url('AdminLogin/Login')?>" name="form1" method="post">
                        <div class="submit_block">
                            <div class="public_submit_block username">
                                <input name="username" type="text" id="username" value="<?php 
                                    if (isset($_COOKIE['remUser'])&&($_COOKIE['remUser'])!="") {
                                        echo $_COOKIE['remUser'];
                                    }
                                ?>" class="public_input username_input" placeholder="使用者名稱：">
                            </div>
                            <div class="public_submit_block password">
                                <input name="password" type="password" id="password" value="<?php 
                                    if (isset($_COOKIE['remPass'])&&($_COOKIE['remPass'])!="") {
                                        echo $_COOKIE['remPass'];
                                    }
                                ?>"  class="public_input password_input" placeholder="密碼：">
                            </div>
                            <div class="public_submit_block remember">
                                <input name="rememberme" type="checkbox" id="rememberme" value="true" checked>
                                <label for="rememberme">
                                    記住我的帳號密碼
                                </label>
                            </div>
                            <div class="login_btn_block">
                                <button type="submit" class="public_Btn login_Btn">登入系統</button>
                            </div>
                        </div>
                    </form>
                    <div class="login_link_block">
                        <div class="fake_block">
                            
                        </div>
                        <div class="register_block">
                            <div class="register">
                                <a href="member_join.php">註冊管理元</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>