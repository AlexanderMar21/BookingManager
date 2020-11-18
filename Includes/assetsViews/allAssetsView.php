<br>
<!-- View All Assets    -->
<h1 class="alert alert-primary">All Assets</h1>

<table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Asset ID</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Total Rooms</th>
            <th scope="col">Doubles Beds</th>
            <th scope="col">Single Beds</th>
            <th scope="col">Sofa Bed</th>
            <th scope="col">Total Guests</th>
            <th scope="col">Address</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($results as $row ){
            echo "<tr>";
            echo "<td><a href='index.php?action=104&assetId={$row['asset_id']}' >".$row['asset_id']."</a></td>";
            echo "<td>".$row['asset_name']."</td>";
            echo "<td>".$row['asset_type']."</td>";
            echo "<td>".$row['asset_rooms']."</td>";
            echo "<td>".$row['asset_double_beds']."</td>";
            echo "<td>".$row['asset_single_beds']."</td>";
            echo "<td>".(($row['asset_sofa_bed']==0)?"NO":"YES")."</td>";
            echo "<td>".$row['asset_persons']."</td>";
            echo "<td>".$row['asset_address']."</td>";

            echo "</tr>";
        };
            ?>
        </tbody>
        </table>