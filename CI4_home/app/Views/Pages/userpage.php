<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_SESSION['username'])) {
            echo $_SESSION['username'] . " 您好";
        } else {
            echo "尚未登入";
        }
    ?>
    <a href="<?= base_url('Login/logout')?>">
        <button>登出</button>
    </a>
</body>
</html>