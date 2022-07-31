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
<!--<script src="js/extern/bootstrap.min.js"></script>
--><h3>Add a BOM</h3>


<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputFile">
        <label class="custom-file-label" for="inputFile" id="fileLabel">Choose a CSV file</label>
    </div>
</div>
<button onclick="insertFirstRow()" class="btn">Or Add Manually</button>
<script src="js/autocomplete.js"></script>
<?php
include 'include/autocomplete/setupAutoCompleteAdd.php';
?>
<form action="import.php" method="post" class="" role="form" autocomplete="off" id="input_form">
    <div>
        <input type="text" name="po_number" id="po_number" placeholder="PO number" style="width:300px">
        <input type="text" name="source" id="source" placeholder="Source" style="width:300px">
        <input type="date" name="date" id="date" style="width:300px">
        <div class="autocomplete">
        <input type="text" name="owner" id="owner" placeholder="Purchaser" style="width:300px">
        </div>
        <input type="hidden" name="count" id="count">
    </div>
    <table class="table table-striped" id="output_table">
        <thead class="thead-light">
        <tr>
            <th>Part Number</th>
            <th>Price Per Unit</th>
            <th>Number Purchased</th>
            <th>Location<input type="text" id="location_text" onkeyup="autofillLocation(this)" placeholder="Autofill" style="width:100px"></th>
            <th>Project Number<input type="text" onkeyup="autofillProjectNumber(this)" id="project_text" placeholder="Autofill" style="width:100px"></th>
            <th>Description</th>
            <th>Delete Row</th>
        </tr>
        </thead>
    </table>
    <button type="button" class="btn" onclick="submitOrError()" >Submit</button>

</form>
<script src="js/bomUpload.js"></script>

</body>
</html>
