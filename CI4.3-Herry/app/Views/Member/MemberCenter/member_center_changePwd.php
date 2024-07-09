        <div class="backend_container_right updateData_container">
            <form action="<?= base_url('MemberCenter/UpdatePassword')?>" method="post" class="form_password_update">
                <div class="update_block">

                    <!-- 隱藏欄位：使用者資料 -->
                    <input type="hidden" name='current_user' value='<?php if(isset($_SESSION['member_username'])) echo $_SESSION['member_username'];?>'>


                    <div class="basic_info_block  txt_center">
                            <div class="basic_info_title">更改密碼</div>
                    </div>

                    <div class="submit_block">
                        <div class="public_submit_block password">
                            <div class="input_title">舊密碼：</div>
                            <input name="old_password" type="password"  class="public_input pwd_required old_password" data-input="舊密碼" title="輸入5~10位字元">
                        </div>
                        <div class="public_submit_block password">
                            <div class="input_title">新密碼：</div>
                            <input name="new_password" type="password"  class="public_input pwd_required new_password" data-input="新密碼" title="輸入5~10位字元">
                        </div>
                        <div class="public_submit_block password">
                            <div class="input_title">確認新密碼：</div>
                            <input name="new_pwdCheck" type="password"  class="public_input pwd_required m_passwordReCheck" data-input="確認新密碼">
                        </div>
                        <div class="public_btn_block join_btn_block  txt_center">
                            <input type="hidden" name="active" value="password_update">
                            <input type="hidden" name="">
                            <button type="submit" class="public_Btn update_Btn">更新密碼</button>
                            <button type="reset" class="public_Btn reset_Btn">重新填寫</button>
                            <br>
                            <br>
                            <span style="color: red;"><i class="fa-solid fa-triangle-exclamation"></i></span> 成功更新密碼後需重新登入
                        </div>
                        <!-- 錯誤訊息 -->
                        <?php if (session()->getFlashdata('error_msg')) {
                            $errorMsg = session()->getFlashdata('error_msg');
                            echo "
                                <div class='err_block'>
                                    <div class='error'>
                                        <div class='error_msg'>
                                            <i class='fa-regular fa-circle-xmark'></i>$errorMsg
                                        </div>
                                    </div>
                                </div>
                            ";
                        }?>
                    </div>


                </div>
            </form>
            <!-- <script>
                // 防呆
                $('.form_password_update').submit(function(event){
                    let success = true;
                    // required item not filled
                    $('.pwd_required').each(function(index,value){
                        if ($(this).val()==""){
                            alert('請輸入'+$(this).attr('data-input'));
                            success = false;
                        }
                    })
                    // password
                    if (($('.new_password').val()!="")) {
                        let passwd = $('.new_password').val();
                        let passwd_check = $('.m_passwordReCheck').val();
                        if (passwd.length<5 || passwd.length>12) {
                            alert('新密碼：請輸入5~10位字元');
                            success = false;
                        }else{
                            let isValid = !/[\s"']/g.test(passwd);
                            if (!isValid) {
                                alert('新密碼：禁止輸入空格、單引號以及雙引號');
                                success = false;

                            }else{
                                if (passwd !== passwd_check) {
                                    alert('密碼不一致!');
                                    success = false;
            
                                }
                            }
                        }
                    }
                    if (!success) {
                        event.preventDefault();
                    }
                })
            </script> -->
                    
        </div>
    </div>
</div>