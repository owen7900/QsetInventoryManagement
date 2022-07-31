<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>QSET Inventory</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
include '../include/connectDB.php';
?>
<body>
<?php
include '../include/navbar.php'
?>
<h3>Update Result</h3>
<?php
$queryString = 'UPDATE items ' .
    'SET quantity=:quantity' .
    ', location=:location' .
    ', description=:description ' .
    'WHERE part_number=:part_number ' .
    'AND project_no=:project_no ' .
    'AND owner=:owner';
$deleteQuery = 'DELETE FROM items ' .
    ' WHERE part_number=:part_number ' .
    ' AND project_no=:project_no' .
    ' AND owner=:owner' .
    ' AND location=:location';
try {
    $query = $connection->prepare($queryString);
    $query->bindParam(":quantity", $_POST['quantity'], PDO::PARAM_INT);
    $query->bindParam(":location", $_POST['location_mod'], PDO::PARAM_STR);
    $query->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
    $query->bindParam(":part_number", $_POST['part_number'], PDO::PARAM_STR);
    $query->bindParam(":project_no", $_POST['project_no'], PDO::PARAM_STR);
    $query->bindParam(":owner", $_POST['owner_mod'], PDO::PARAM_STR);

    $quantityStr = "SELECT quantity FROM items WHERE part_number=:part_number AND project_no=:project_no AND owner=:owner AND location=:location";
    $oldQuantity = $connection->prepare($quantityStr);
    $oldQuantity->bindParam(":part_number", $_POST['part_number'], PDO::PARAM_STR);
    $oldQuantity->bindParam(":project_no", $_POST['project_no'], PDO::PARAM_STR);
    $oldQuantity->bindParam(":owner", $_POST['owner_mod'], PDO::PARAM_STR);
    $oldQuantity->bindParam(":location", $_POST['location']);
    $oldQuantity->execute();

    $delete = $connection->prepare($deleteQuery);
    $delete->bindParam(":part_number", $_POST['part_number'], PDO::PARAM_STR);
    $delete->bindParam(":project_no", $_POST['project_no'], PDO::PARAM_STR);
    $delete->bindParam(":owner", $_POST['owner_mod'], PDO::PARAM_STR);
    $delete->bindParam(":location", $_POST['location']);

    $quantity = 0;
    foreach ($oldQuantity as $row) {
        $quantity = $row['quantity'];
    }

    $quantity =  $_POST['quantity'] - $quantity;

//    if(0 == $_POST['quantity'])
//    {
//        $delete->execute();
//    }
//    else
//    {
        $query->execute();
//    }




    $transactionQueryString = 'INSERT INTO transactions (part_number, quantity, transaction_date, person)
                            VALUES (:part_number, :quantity, CURDATE(), :person)';
    $transQuery = $connection->prepare($transactionQueryString);
    $transQuery->bindParam(":part_number", $_POST['part_number'], PDO::PARAM_STR);
    $transQuery->bindParam(":quantity", $quantity, PDO::PARAM_INT);
    $transQuery->bindParam(":person", $_POST['person'], PDO::PARAM_STR);

    $transQuery->execute();


} catch (PDOException $e) {
    echo $e->getMessage();
    var_dump($connection->errorInfo());
    var_dump($_POST);
}
?>

</body>
