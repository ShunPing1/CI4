
    <form action="" name="form_member_update" method="post" id="form_member_update">
        <div class="update_block">
            <div class="basic_info_block txt_center">
                    <div class="basic_info_title">編輯帳戶</div>
            </div>
            <div class="submit_block">
            <div class="public_submit_block">
                <div class="public_submit_block">
                    <div class="input_title">使用者名稱：</div>
                    <input name="m_username" type="text" id="m_username" class="public_input member_update_required" value="" data-input="使用者名稱" placeholder="使用者名稱：">
                </div>
                <div class="public_submit_block">
                    <div class="input_title">名字：</div>
                    <input name="m_name" type="text" id="m_name" class="public_input member_update_required" value="" data-input="名字" placeholder="名字：">
                </div>
                <div class="input_title">電子信箱：</div>
                    <input name="m_email" type="text" id="m_email"  class="public_input member_update_required" value="" data-input="電子郵件" placeholder="電子郵件：(選填)">
                </div>
    
                <div class="public_btn_block join_btn_block txt_center">
                    <input type="hidden" name="active" value="update">
                    <input type="hidden" name="m_ID" value="">
                    <button type="submit" class="public_Btn update_Btn">更新資料</button>
                    <button type="reset" class="public_Btn reset_Btn">重新填寫</button>
                </div>
            </div>
    
        </div>
    </form>
    <script>
        // 防呆
        $('#form_member_update').submit(function(event){
            let success = true;
            event.preventDefault();
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
            if (success) {
                alert('修改成功');
            }else{
                event.preventDefault();
            }
        })
    </script>
