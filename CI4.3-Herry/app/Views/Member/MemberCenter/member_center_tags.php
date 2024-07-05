
<div class="path_block">
    <div class="public_container path">
        <div class="links">
            <div class="link"><a href="#">首頁</a></div>
            <div class="link"><a href="#" class="path_active">會員中心</a></div>
        </div>
    </div>
</div>
<div class="public_container container_block">
    <div class="information_container">
        <div class="backend_container_left">
            <div class="all_catalog_block">
                <div class="catalog_block">
                    <div class="contalog_title">我的帳戶</div>
                    <a href="<?= base_url('MemberCenter')?>">
                        <div class="contalog_content  current_page_active">基本資料</div>
                    </a>
                    <a href="<?= base_url('MemberCenter/ChangePassword')?>">
                        <div class="contalog_content ">更改密碼</div>
                    </a>
                </div>
                <div class="catalog_block">
                    <div class="contalog_title">購物清單</div>
                    <a href="<?= base_url('MemberCenter/MyFavourite')?>">
                        <div class="contalog_content product_page_text">我的最愛</div>
                    </a>
                    <a href="<?= base_url('MemberCenter/MyOrder')?>">
                        <div class="contalog_content product_page_text">我的訂單</div>
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

