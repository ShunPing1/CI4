<div class="public_ctn container2" data-table='會員'>
    <form action="TEST/SearchMember" method='get'>
        搜尋關鍵字：
        <input type="text" name='keyword'>
        <button>送出</button>
    </form>
    <table>
        <tr>
            <th>username</th>
            <th>name</th>
            <th>ID</th>
        </tr>
        <?php
            foreach($members as $member){
                echo "<tr>";
                    echo "<td>".$member['m_username']."</td>";
                    echo "<td>".$member['m_name']."</td>";
                    echo "<td>".$member['m_ID']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>