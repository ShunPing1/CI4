<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理系統</title>
    <link rel="stylesheet" href="<?= base_url('ctr/css/All.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="<?= base_url('ctr/js/jquery.min.js')?>"></script>

</head>
<body>
    <div class="public_container backend_all_container">
        <div class="backend_title_block">
            <h1 class="backend_title">管理系統</h1>
            <div>
                <a href="<?= base_url('AdminLogin/Logout')?>">
                    <div class="backend_title logout">登出</div>
                </a>
            </div>
        </div>

        <div class="container_block">
            <div class="information_container">
                <div class="backend_container_left">
                    <div class="all_catalog_block">
                        <div class="catalog_block">
                            <div class="contalog_title">帳戶管理</div>
                            <a href="<?= base_url('BackendPage')?>">
                                <div class="contalog_content update_pwd_text current_page_active">編輯帳戶</div>
                            </a>
                            <a href="<?= base_url('BackendPage/ChangePassword')?>">
                                <div class="contalog_content update_pwd_text">更改密碼</div>
                            </a>
                        </div>
                        <div class="catalog_block">
                            <div class="contalog_title">商品管理</div>
                            <a href="<?= base_url('BackendPage/Products')?>">
                                <div class="contalog_content product_padmin_tagage_text">編輯商品</div>
                            </a>
                        </div>
                        <div class="catalog_block">
                            <div class="contalog_title">商品類別管理</div>
                            <a href="<?= base_url('BackendPage/Category')?>">
                                <div class="contalog_content contalog_page_text">商品類別</div>
                            </a>
                            <a href="<?= base_url('BackendPage/Subcategory')?>">
                                <div class="contalog_content contalog_page_text">類別項目</div>
                            </a>
                        </div>
                        <div class="catalog_block">
                            <div class="contalog_title">會員管理</div>
                            <a href="<?= base_url('BackendPage/Admin')?>">
                                <div class="contalog_content contalog_page_text">管理員名單</div>
                            </a>
                            <a href="<?= base_url('BackendPage/Member')?>">
                                <div class="contalog_content contalog_page_text">會員名單</div>
                            </a>
                        </div>
                        <div class="catalog_block">
                            <div class="contalog_title">訂單管理</div>
                            <a href="<?= base_url('BackendPage/Order')?>">
                                <div class="contalog_content contalog_page_text">會員訂單</div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- 切換頁面JS -->
                <script>
                    $(document).ready(function() {
                        // 檢查並初始化 currentPage
                        let currentPage = sessionStorage.getItem('currentPage');
                        if (!currentPage) {
                            currentPage = 'page0';
                            sessionStorage.setItem('currentPage', currentPage);
                        }

                        // 根據 currentPage 初始化頁面狀態
                        $('.contalog_content').each(function(index) {
                            if ('page' + index === currentPage) {
                                $('.contalog_content').eq(index).addClass('current_page_active');
                            } else {
                                $('.contalog_content').eq(index).removeClass('current_page_active');
                            }
                        });

                        // 切換頁面時更新 sessionStorage 和頁面狀態
                        $('.contalog_content').click(function() {
                            let currentItem = $(this);
                            $('.contalog_content').removeClass('current_page_active'); 
                            $(this).addClass('current_page_active');

                            $('.contalog_content').each(function(index){
                                console.log(currentItem);
                                if (currentItem.text() == $('.contalog_content').eq(index).text()) {
                                    sessionStorage.setItem('currentPage', 'page' + index);
                                }
                            })
                        });
                    });

                </script>

