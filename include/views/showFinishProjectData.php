<?php

try {
    $queryStr = 'SELECT * from items where project_no =:project_no';
    $query = $connection->prepare($queryStr);
    $query->bindParam("project_no", $_GET['project_no'], PDO::PARAM_STR);
    $query->execute();
}
catch (PDOException $e)
{
    echo $e->getMessage();
}
?>
<!--<button type="button" class="btn" onclick="deleteAll()">Delete All Remaining</button>-->
<table class="table table-striped" id="table">
    <thead class="thead-light">

    <tr>
        <th>
            Part No
        </th>
        <th>
            Quantity
        </th>
        <th>
            Location
        </th>
        <th>
            Owner
        </th>
        <th>
            Project Number
        </th>
        <th>
            Description
        </th>
        <th>
            Delete Parts
        </th>
        <th>
            Move to General
        </th>
    </tr>
    </thead>

<?php
foreach ($query as $row)
{
    echo '<tr>
               <th scope="row">' . $row['part_number'] . '</th>
               <td>' . $row['quantity'] .'</td>
               <td>' . $row['location'] . '</td>
               <td>' . $row['owner'] . '</td>
               <td>' . $row['project_no'] . '</td>
               <td>' . $row['description'] . '</td>
               <td><button type="button" class="btn"  name="delete" onclick="deleteRow(this)">Delete</button></td>
               <td><button type="button" class="btn" onclick="moveRowToGeneral(this)">Move To General</button></td></tr>';
}
?>

    </tbody>
</table>
<script src="js/finish.js"></script>