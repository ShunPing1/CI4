<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
    <link rel="stylesheet" href="<?= base_url('ctr/css/All.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="<?= base_url('ctr/js/jquery.min.js')?>"></script>

</head>
<body>

    <section class="public_container login_top_block">
        <div class="login_top">
            <img src="<?= base_url('ctr/img/標題文字1.png')?>" alt="">
            <p class="join_title">註冊</p>
        </div>
    </section>
    <section class="login_main_block join_main">
        <div class="public_container main">
            <div class="join_block">
                <div class="join">
                    <div class="join_title_block">
                        <div class="join_title">驗證資訊</div>
                    </div>
                    <!-- 註冊成功訊息 -->
                    <?php if (session()->getFlashdata('msg') && session()->getFlashdata('msg') == 'success') {?>
                        <div class="success_block">
                            <a href="<?= base_url('MemberLogin')?>">
                                <div class="success">
                                    <div class="success_msg">
                                        <i class="fa-regular fa-circle-check"></i> 註冊成功 ! 點此登入
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }?>
                    <!-- 錯誤訊息 -->
                    <?php if (session()->getFlashdata('msg') && session()->getFlashdata('msg') == 'error') {?>
                        <div class="err_block">
                            <div class="error">
                                <div class="error_msg">
                                    <i class="fa-regular fa-circle-xmark"></i>使用者名稱已註冊 !
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    <!-- <div class="hint_block">
                        <span style="color: #f00;">*</span>表示必填欄位
                    </div> -->
                    <form action="MemberJoin/Join" name="formJoin" method="post" id="formJoin">
                        <div class="submit_block  verify_block">
                            <div class="public_submit_block username">
                                <input name="m_username" type="text" id="m_username" class="public_input required" data-input="使用者名稱" placeholder="使用者名稱：" title="輸入5~12位英文字母、數字或「_」字元。">
                            </div>
                            <div class="public_submit_block password">
                                <input name="m_password" type="password" id="m_password"  class="public_input required" data-input="密碼" placeholder="密碼：" title="輸入5~10位字元">
                            </div>
                            <div class="public_submit_block password">
                                <input name="m_passwordReCheck" type="password" id="m_passwordReCheck"  class="public_input required" data-input="確認密碼" placeholder="確認密碼：">
                            </div>
                            <div class="public_submit_block password">
                                <input name="m_email" type="text" id="m_email"  class="public_input required" data-input="電子郵件" placeholder="電子郵件：">
                            </div>
                        </div>
                        <div class="user_title_block">
                                <div class="user_title">基本資料</div>
                        </div>
                        <div class="submit_block">
                            <div class="public_submit_block">
                                <input name="m_name" type="text" id="m_name" class="public_input required" data-input="名字" placeholder="名字：">
                            </div>
                            <div class="public_submit_block">
                                性別：
                                <input name="m_sex" type="radio" id="male" value="男" checked>
                                <label for="male">男生</label>
                                <input name="m_sex" type="radio" id="female" value="女">
                                <label for="female">女生</label>
                            </div>
                            <div class="public_submit_block">
                                <input name="m_birthday" type="text" id="m_birthday"  class="public_input" placeholder="生日：(選填)" title="西元格式:(YYYY-MM-DD)">
                            </div>
                            <div class="public_submit_block password">
                                <input name="m_phone" type="text" id="m_phone"  class="public_input" placeholder="電話：(選填)">
                            </div>
                            <div class="public_submit_block password">
                                <input name="m_address" type="text" id="m_address" class="public_input" placeholder="地址：(選填)">
                            </div>

                            <div class="public_btn_block join_btn_block">
                                <input type="hidden" name="active" value="join">
                                <button type="submit" class="public_Btn join_Btn">點擊註冊</button>
                                <button type="reset" class="public_Btn reset_Btn">重新填寫</button>
                            </div>
                            <div class="public_btn_block">
                                <button type="button" class="public_Btn back_Btn" onClick="window.history.back()">回上一頁</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    
    <script>
        // 防呆
        $('#formJoin').submit(function(event){
            // required item not filled
            $('.required').each(function(index,value){
                if ($(this).val()==""){
                    alert('請輸入'+$(this).attr('data-input'));
                    event.preventDefault();
                }
            })
            // username
            if ($('#m_username').val()!="") {
                let inputValue = $('#m_username').val();
                if (inputValue.length<5 || inputValue.length>12){
                    alert('帳號請輸入5~12個字元!');
                    event.preventDefault();
                }else{
                    if (!(/^[A-Za-z0-9_]*$/.test(inputValue))) {
                        alert('使用者名稱：請輸入大小寫英文字母、數字或是「_」符號');
                        event.preventDefault();
                    }
                }
            }
            // password
            if (($('#m_password').val()!="")) {
                let passwd = $('#m_password').val();
                let passwd_check = $('#m_passwordReCheck').val();
                if (passwd.length<5 || passwd.length>12) {
                    alert('密碼：請輸入5~10位字元');
                    event.preventDefault();
                }else{
                    let isValid = !/[\s"']/g.test(passwd);
                    if (!isValid) {
                        alert('密碼：禁止輸入空格、單引號以及雙引號');
                        event.preventDefault();
                    }else{
                        if (passwd !== passwd_check) {
                            alert('密碼不一致!')
                            event.preventDefault();
                        }
                    }
                }
            }
            // email
            if (($('#m_email').val()!="")) {
                let email = $('#m_email').val();
                let isVaild = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email);
                if (!isVaild ) {
                    alert('電子郵件格式不正確');
                    event.preventDefault();
                }else{
                    console.log('email格式正確');
                }
            }
        })
    </script>
</body>
</html>
