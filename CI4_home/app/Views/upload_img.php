<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上傳圖片</title>
</head>
<body>
    <h2>上傳圖片</h2>
    <?php if(session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>
    <form action="<?= base_url('Load_page/save_img');?>" method='post'  enctype="multipart/form-data">
        <input type="file" name='file' id='file'>
        <br>
        <br>
        <button type='submit'>送出</button>
    </form>
</body>
</html>