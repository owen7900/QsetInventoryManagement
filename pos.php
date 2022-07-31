<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>QSET Inventory</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
include 'include/connectDB.php'
?>
<body>
<?php
include 'include/navbar.php'
?>
<h3>Search POs</h3>
<table class="table table-striped">
    <thead class="thead-light">

    <tr>
        <form action="pos.php" method="get" class="" role="form" autocomplete="off">
            <th>
                <div class="autocomplete" style="width:300px">
                    <input id="purchase_order_number" type="text" name="purchase_order_number" placeholder="PO Number">
                </div>
            </th>
            <th>
                <div style="width:150px">
                    <input id="purchase_date" type="date" name="purchase_date">
                </div>
            </th>
            <th>
                <div style="width:150px">
                    Cost Per Unit
                </div>
            </th>
            <th>
                <div class="autocomplete" style="width:150px">
                    <input id="part_number" type="text" name="part_number" placeholder="Part No">
                </div>
            </th>
            <th>
                <div class="autocomplete" style="width:450px">
                    <input id="description" type="text" name="description" placeholder="Description">
                </div>
            </th>
            <th>
                <div class="autocomplete" style="width:150px">
                    <input id="source" type="text" name="source" placeholder="Source">
                </div>
            </th>
            <th>
                <div class="autocomplete" style="width:150px">
                    <input id="owner" type="text" name="owner" placeholder="Owner">
                </div>
            </th>
            <th>
                <div class="autocomplete" style="width:150px">
                    <input id="project_no" type="text" name="project_no" placeholder="Project Number">
                </div>
            </th>
            <input type="submit">
        </form>
    </tr>
    </thead>
    <script src="js/autocomplete.js"></script>
    <?php
    include 'include/autocomplete/setupAutoCompletePOS.php';
    include 'include/views/showPOData.php';
    ?>

</body>
</html>
