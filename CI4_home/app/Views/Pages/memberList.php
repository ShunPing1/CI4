<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/All.css">
</head>
<body>
    <table>
        <tr>
            <th>狀態排序</th>
            <th>狀態名稱</th>
            <th>編輯</th>
        </tr>
        <?php foreach($states as $state){ ?>
            <tr>
                <td><?php echo $state['os_sort'] ?></td>
                <td><?php echo $state['os_name'] ?></td>
                <td>
                    <button type='button'>
                        <a href="memberPage/edit/<?= $state['os_ID'] ?>">改</a>
                    </button>
                    <button type='button'>
                        <a href="memberPage/delete/<?= $state['os_ID'] ?>">刪</a>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="creat_block">
        <div class="creat">
        <h1>Create State</h1>
            <form action="states/create" method="post">
                <label for="sort">os_sort</label>
                <input type="number" name="sort" id="sort" required><br>
                <label for="name">os_Name</label>
                <input type="text" name="name" id="name" required><br>
                <button type="submit">Create</button>
            </form>
        </div>
    </div>



</body>
</html>