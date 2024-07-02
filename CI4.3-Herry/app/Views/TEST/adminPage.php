<div class="public_ctn container1" data-table='管理員'>
    <form action="SearchAdmin" method='get'>
        搜尋關鍵字：
        <input type="text" name='keyword'>
        <button>送出</button>
    </form>
    <table>
        <tr>
            <th>username</th>
            <th>name</th>
            <th>level</th>
        </tr>
        <?php
            foreach($admins as $admin){
                echo "<tr>";
                    echo "<td>".$admin['a_username']."</td>";
                    echo "<td>".$admin['a_name']."</td>";
                    echo "<td>".$admin['a_level']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>