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
include 'include/connectDB.php'
?>
<body>
<?php
include 'include/navbar.php'
?>
<h3>Search Parts</h3>
<table class="table table-striped">
    <thead class="thead-light">
    <tr>
        <form action="consume.php" method="get" class="" role="form" autocomplete="off">
            <th>
                <div class="autocomplete" style="width:300px">
                    <input id="part_number" type="text" name="part_number" placeholder="Part No">
                </div>
            </th>
            <th>
                Quantity
            </th>
            <th>
                <div class="autocomplete" style="width:150px">
                    <input id="location" type="text" name="location" placeholder="Location">
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
            <th>
                <div class="autocomplete" style="width:300px">
                    <input id="description" type="text" name="description" placeholder="Description">
                </div>
            </th>
            <th>
                Submit Changes
            </th>
            <input type="submit" value="Search">
        </form>
    </tr>
    <button class="btn" onclick="submitAll()">Submit All</button>
    <input type="text" id="person" placeholder="Your Name" style="width: 200px;">
    </thead>
    <script src="js/autocomplete.js"></script>
    <?php
    include 'include/autocomplete/setupAutoCompleteMain.php';
    include 'include/views/showConsumablePartData.php';
    ?>
    <script src="js/usedParts.js"></script>
</body>
</html>

