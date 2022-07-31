<?php
try {
    $connection = new PDO('mysql:host=localhost:3306;dbname=inventory', "qset", "space120");
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Error!: ". $e->getMessage(). " <br/>";

    die();
}
?>
