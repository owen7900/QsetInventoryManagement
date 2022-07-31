<?php
include '../include/connectDB.php';
try{
$queryStr = 'DELETE FROM items WHERE part_number=:part_number AND project_no=:project_no AND owner=:owner';
$query = $connection->prepare($queryStr);
$query->bindParam(":part_number", $_POST["part_number"], PDO::PARAM_STR);
$query->bindParam(":project_no", $_POST['project_no'], PDO::PARAM_STR);
$query->bindParam(":owner", $_POST['owner'], PDO::PARAM_STR);
$query->execute();
} catch (PDOException $e)
{
    echo "BAD DELETE ";
    echo $e->getMessage();

}


try {
    $items_query_string = 'INSERT INTO items (part_number, quantity, location, owner, project_no, description) ' .
        'VALUES (:part_number, :quantity, :location, :owner, :project_no, :description)';
    $iquery = $connection->prepare($items_query_string);

    $iquery->bindParam(":part_number", $_POST['part_number'], PDO::PARAM_STR);

    $iquery->bindParam(":quantity", $_POST['quantity'], PDO::PARAM_INT);

    $iquery->bindParam(":location", $_POST['location'], PDO::PARAM_STR);

    $iquery->bindParam(":owner", $_POST['owner'], PDO::PARAM_STR);

    $iquery->bindParam(":project_no", $_POST['to_project']);

    $iquery->bindParam(":description", $_POST['description'], PDO::PARAM_STR);

    $iquery->execute();
} catch (PDOException $e)
{
    echo "BAD INSERT ";
    echo $e->getMessage();

}
?>