<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit State</h1>
    <form action="/CI4/memberPage/update/<?= $states['os_ID'] ?>" method="post">
        <label for="sort">Name</label>
        <input type="text" name="os_sort" id="sort" value="<?= $states['os_sort'] ?>" required><br>
        <label for="name">Email</label>
        <input type="text" name="os_name" id="name" value="<?= $states['os_name'] ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>