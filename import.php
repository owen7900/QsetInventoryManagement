<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>QSET Inventory</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
include 'include/connectDB.php';
?>
<body>
<?php
include 'include/navbar.php'
?>
<h3>Insertion Result</h3>
<?php
$count = $_POST['count'];
$items_query_string = 'INSERT INTO items (part_number, quantity, location, owner, project_no, description) 
                        VALUES (:part_number, :quantity, :location, :owner, :project_no, :description)
                        ON DUPLICATE KEY UPDATE 
                            quantity=quantity+:new_quantity';
$part_source_query_string = 'INSERT INTO part_source (part_number, source, price_per_unit, number_purchased, purchase_order_number, purchase_date, owner, project_no)
    VALUES (:part_number, :source, :price_per_unit, :number_purchased, :purchase_order_number, DATE(:purchase_date), :owner, :project_no)';
for ($i = 0; $i < $count; $i++) {
    if (array_key_exists("part_no".$i, $_POST) && $_POST['part_no'.$i] != '') {
        try {
            $iquery = $connection->prepare($items_query_string);
            $pquery = $connection->prepare($part_source_query_string);
            $pquery->execute(array('part_number' => $_POST['part_no' . $i],
                'source' => $_POST['source'],
                'price_per_unit' => $_POST['price' . $i],
                'number_purchased' => $_POST['number_purchased' . $i],
                'purchase_order_number' => $_POST['po_number'],
                'purchase_date' => $_POST['date'],
                'owner' => $_POST['owner'],
                'project_no' => $_POST['project_no' . $i]));
            $iquery->execute(array('part_number' => $_POST['part_no' . $i],
                'quantity' => $_POST['number_purchased' . $i],
                'location' => $_POST['location' . $i],
                'owner' => $_POST['owner'],
                'project_no' => $_POST['project_no' . $i],
                'description' => $_POST['description' . $i],
                'new_quantity' => $_POST['number_purchased'. $i]));

            $transactionQueryString = 'INSERT INTO transactions (part_number, quantity, purchase_order_number, transaction_date, person)
                            VALUES (:part_number, :quantity, :purchase_order_number, CURDATE(), :person)';
            $transQuery = $connection->prepare($transactionQueryString);
            $transQuery->bindParam(":part_number", $_POST['part_number' . $i], PDO::PARAM_STR);
            $transQuery->bindParam(":quantity", $_POST['number_purchased'. $i], PDO::PARAM_INT);
            $transQuery->bindParam(":purchase_order_number", $_POST['po_number'], PDO::PARAM_STR);
            $transQuery->bindParam(":person", $_POST['person'], PDO::PARAM_STR);

            $transQuery->execute();

        } catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}


?>
</body>
</html>
