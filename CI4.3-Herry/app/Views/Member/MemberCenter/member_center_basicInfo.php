        <div class="backend_container_right updateData_container">
            <form action="<?= base_url('MemberCenter/Update')?>" name="form_member_update" method="post" id="form_member_update">
                <div class="update_block">
                    <div class="basic_info_block txt_center">
                            <div class="basic_info_title">基本資料</div>
                    </div>
                    <div class="submit_block">
                    <div class="public_submit_block">

                        <!-- 隱藏欄位：使用者資料 -->
                         <input type="hidden" name='current_user' value='<?php if(isset($_SESSION['member_username'])) echo $_SESSION['member_username'];?>'>

                        <div class="input_title">電子信箱：</div>
                            <input name="m_email" type="text" id="m_email"  class="public_input member_update_required" value="<?php if(isset($email) && $email !== '') echo $email;?>" data-input="電子郵件" placeholder="電子郵件：">
                        </div>

                        <div class="public_submit_block">
                            <div class="input_title">名字：</div>
                            <input name="m_name" type="text" id="m_name" class="public_input member_update_required" value="<?php if(isset($name) && $name !== '') echo $name;?>" data-input="名字" placeholder="名字：">
                        </div>

                        <div class="public_submit_block">
                            <div class="input_title sex_result" data-sex='<?php if(isset($sex)) echo $sex;?>'>性別：</div>
                            <input name="m_sex" type="radio" value="男" id='sex_male' class='sex_option'>
                            <label for="sex_male">男</label>
                            <input name="m_sex" type="radio" value="女" id='sex_female' class='sex_option'>
                            <label for="sex_female">女</label>
                        </div>

                        <script>
                            console.log($('.sex_result').data('sex'));
                            let sex_result = $('.sex_result').data('sex');
                            $('.sex_option').each(function(){
                                if ($(this).val() == sex_result) {
                                    $(this).attr('checked',true);
                                }
                            })
                        </script>

                        <div class="public_submit_block">
                            <div class="input_title">生日：</div>
                            <input name="m_birthday" type="text" id="m_birthday" class="public_input " value="<?php if(isset($birthday) && $birthday !== '') echo $birthday;?>" data-input="生日" placeholder="生日：(選填)">
                        </div>

                        <div class="public_submit_block">
                            <div class="input_title">電話：</div>
                            <input name="m_phone" type="text" id="m_phone" class="public_input " value="<?php if(isset($phone) && $phone !== '') echo $phone;?>" data-input="電話" placeholder="電話：(選填)">
                        </div>

                        <div class="public_submit_block">
                            <div class="input_title">地址：</div>
                            <input name="m_address" type="text" id="m_address" class="public_input " value="<?php if(isset($address) && $address !== '') echo $address;?>" data-input="地址" placeholder="地址：(選填)">
                        </div>
            
                        <div class="public_btn_block join_btn_block txt_center">
                            <input type="hidden" name="active" value="update">
                            <input type="hidden" name="m_ID" value="">
                            <button type="submit" class="public_Btn update_Btn">更新資料</button>
                            <button type="reset" class="public_Btn reset_Btn">重新填寫</button>
                        </div>

                        <?php
                            if (session()->getFlashdata('update_msg')) {
                                $update_msg = session()->getFlashdata('update_msg');
                                if ($update_msg == 'success') {
                                    echo "
                                        <div class='success'>
                                            <div class='success_msg'>
                                                <i class='fa-regular fa-circle-check'></i> 更新成功 ! 
                                            </div>
                                        </div>
                                    ";
                                }else{
                                    echo "
                                        <div class='error'>
                                            <div class='error_msg'>
                                                <i class='fa-regular fa-circle-xmark'></i>更新失敗 !
                                            </div>
                                        </div>
                                    ";
                                    }
                            }
                        ?>
                    </div>
            
                </div>
            </form>

            <script>
                // 防呆
                $('#form_member_update').submit(function(event){
                    let success = true;
                    // required item not filled
                    $('.member_update_required').each(function(index,value){
                        if ($(this).val()==""){
                            alert('請輸入'+$(this).attr('data-input'));
                            success = false;
                        }
                    })
                    // email
                    if (($('#m_email').val()!="")) {
                        let email = $('#m_email').val();
                        let isVaild = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email);
                        if (!isVaild ) {
                            alert('電子郵件格式不正確');
                            success = false;
                            
                        }
                    }
                    if (!success) {
                        // alert('修改成功');
                        event.preventDefault();
                    }
                })
            </script>
        </div>
    </div>
</div>