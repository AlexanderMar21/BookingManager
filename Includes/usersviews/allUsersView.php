<br>
<h1 class="alert alert-primary">All Users</h1>
<!-- Users Table -->
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">User ID</th>
        <th scope="col">Profile Pic</th>
        <th scope="col">Full Name</th>
        <th scope="col">Username</th>
        <th scope="col">User Type</th>

    </tr>
    </thead>
    <tbody id= "results">
    <?php
    foreach ($results as $row ){
        $type = ($row['user_type'] == 1)?"Administartor":"Simple User";
        $photo = "images/uploads/avatars/{$row['user_photo']}";
        echo "<tr>";
        echo "<td><a href='index.php?action=133&userId={$row['user_id']}'>".$row['user_id']."</a></td>";
        echo "<td><div class='profile-pics' style="."'background-image: url({$photo})'"." ></div></td>";
        echo "<td>{$row['user_name']} {$row['user_surname']}</td>";
        echo "<td>{$row['user_username']}</td>";
        echo "<td>{$type}</td>";
        echo "</tr>";
    };
    ?>
    </tbody>
</table>