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
<h3>Select A Project</h3>

<form action="finish.php" method="get">

    <div class="autocomplete" style="width:300px">
        <input type="text" placeholder="Project No" id="project_no" name="project_no">
    </div>
    <input type="submit" value="Select Project">
    <input type="text" id="person" placeholder="Your Name" style="width: 200px" />
</form>
<script src="js/autocomplete.js"></script>

<?php
 include "include/views/showFinishProjectData.php";

?>


<?php
include "include/autocomplete/setupAutoCompleteFinish.php";

?>
</body>
</html>