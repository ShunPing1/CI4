<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="<?= base_url('JS/jquery3.js')?>"></script>
</head>
<body>
<h1>Login Page</h1>
    <form action="<?= base_url('Login/receive')?>" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value = '<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username'];?>'  required><br>
        <label for="password">Password</label>
        <input type="text" name="password" id="password" required><br>
        <input type="checkbox" name='remember' id='remember' value='false'>記住我的資訊
        <script>
            $('#remember').change(function(){
                $(this).prop('checked')?$(this).val('true'):$(this).val('false');
                console.log($(this).val());
            })
        </script>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>