<?php
include '../include/connectDB.php';
try {
    $queryStr = 'DELETE FROM items WHERE part_number=:part_number AND project_no=:project_no AND owner=:owner AND location=:location';
    $query = $connection->prepare($queryStr);
    $query->bindParam(":part_number", $_POST['part_number'], PDO::PARAM_STR);
    $query->bindParam(":project_no", $_POST['project_no'], PDO::PARAM_STR);
    $query->bindParam(":owner", $_POST['owner'], PDO::PARAM_STR);
    $query->bindParam(":location", $_POST['location'], PDO::PARAM_STR);
    $query->execute();
} catch(PDOException $e)
{
    echo $e->getMessage();
}
?>