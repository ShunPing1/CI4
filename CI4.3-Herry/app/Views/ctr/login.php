<!DOCTYPE html>
<html lang="zh-TW">
<head>

<meta charset="utf-8" lang="zh-TW" />
<meta http-equiv="Content-Language" content="zh-tw" />
<meta name="distribution" content="Taiwan">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="robots" content="none">

<title><?php echo $_SERVER['GS_ENVIRONMENT']['headTitle']; ?></title>

<base href="<?php echo base_url(); ?>">
<link rel="stylesheet" href="ctr/css/gs.css" />

<script src="ctr/js/jquery.min.js" type="text/javascript"></script>
<script src="ctr/js/js.js"></script>

</head>
<body id="welcome_page_body">


<form action="<?php echo base_url(); ?>ctr/login/check_login" method="post" autocomplete="OFF">
<div id="backstage_login_form_wrap">
    
    <img src="ctr/imgs/logo.png">
    
    <div class="backstage_login_form_row" style="color: red; font-weight: bold; font-size: red; font-size:22px;">
        WELCOME<br>
        <?php echo $_SERVER['GS_ENVIRONMENT']['menuTitle']; ?><br>
        本系統限用Google Chrome瀏覽器
    </div>
    
    <div class="backstage_login_form_row">
        <input type="text" name="ID" class="backstage_login_form_row_text_input" value="帳號" onFocus="javascript:if( $(this).val() == '帳號' ) $(this).val('');" required>
    </div>
    
    <div class="backstage_login_form_row">
        <input type="text" name="Password" class="backstage_login_form_row_text_input" value="密碼" onFocus="javascript:if( $(this).val() == '密碼' ) $(this).val('');" required>
    </div>
    
    <div class="backstage_login_form_row">
        <input type="text" name="Check" class="backstage_login_form_row_text_input" value="檢號" onFocus="javascript:if( $(this).val() == '檢號' ) $(this).val('');" required>
    </div>
    
    <div class="backstage_login_form_row" style="padding:20px 0 0 0;">
        <input type="submit" value="登 入" class="welcome_page_login_button">
    </div>
    
    <script>
		$('input').focus(function(e) {
            $(this).animate({ width:'310px'}, 800 );
        });
    </script>
    
</div> <!-- backstage_login_form_wrap -->
</form>

</body>
</html>