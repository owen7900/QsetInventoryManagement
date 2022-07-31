<tbody class="">
<?php
$qstring = 'SELECT part_source.part_number as part_number, part_source.source as source, part_source.price_per_unit as price_per_unit, part_source.purchase_order_number as purchase_order_number, ' .
    'part_source.purchase_date, part_source.owner as owner, part_source.project_no as project_no, items.description as description FROM inventory.part_source ' .
    'INNER JOIN items ON items.part_number=part_source.part_number WHERE LOWER(part_source.part_number) LIKE LOWER(:part_number) ' .
    'AND LOWER(part_source.source) LIKE LOWER(:source) AND LOWER(part_source.purchase_order_number) LIKE LOWER(:purchase_order_number) AND LOWER(part_source.project_no) LIKE LOWER(:project_no)'
    . ' AND LOWER(part_source.owner) LIKE LOWER(:owner) AND LOWER(items.description) LIKE LOWER (:description)';

$haveDate = false;

if(array_key_exists('part_number', $_GET) && $_GET['part_number'] != '') {
    $part_number = "%" . $_GET['part_number'] . "%";
}else{
    $part_number = '%';
}

if(array_key_exists('description', $_GET) && $_GET['description'] != '') {
    $description = "%" .$_GET['description'] . "%";
}else{
    $description = '%';
}
if (array_key_exists('purchase_order_number', $_GET)&& $_GET['purchase_order_number'] != ''){
    $purchase_order_number = "%" .$_GET['purchase_order_number'] . "%";
}else{
    $purchase_order_number = '%';
}
if (array_key_exists('source', $_GET)&& $_GET['source'] != ''){
    $source = "%" .$_GET['source'] . "%";
}else{
    $source = '%';
}
if (array_key_exists('purchase_date', $_GET)&& $_GET['purchase_date'] != '') {
    $purchase_date = $_GET['purchase_date'];
    $qstring = $qstring . ' AND purchase_date = DATE(:purchase_date)';
    $haveDate = true;
}
else{
    $purchase_date = '%';
}
if (array_key_exists('owner', $_GET)&& $_GET['owner'] != ''){
    $owner = "%" .$_GET['owner'] . "%";
}else{
    $owner = '%';
}
if (array_key_exists('project_no', $_GET)&& $_GET['project_no'] != '') {
    $project_no = "%" . $_GET['project_no'] . "%";
}
else{
    $project_no = '%';
}

try {
    $query = $connection->prepare($qstring, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
}catch (PDOException $e){
    echo 'QUERY ERROR' . $e->getMessage();
}

try {
    if($haveDate) {
        $query->execute(array('part_number' => $part_number,
            'purchase_order_number' => $purchase_order_number,
            'owner' => $owner,
            'project_no' => $project_no,
            'source' => $source,
            'purchase_date' => $purchase_date,
            'description' => $description));
    }
    else{
        $query->execute(array('part_number' => $part_number,
            'purchase_order_number' => $purchase_order_number,
            'owner' => $owner,
            'project_no' => $project_no,
            'source' => $source,
            'description' => $description));
    }

} catch (PDOException $e) {
    echo "Error!: ". $e->getMessage(). " <br/>";

    die();
}

foreach ($query as $row)
{
    echo '<tr><th scope="row">' . $row['purchase_order_number'] . '</th><td>' . $row['purchase_date'] . '</td><td>' . $row['price_per_unit'] . '</td><td>' . $row['part_number'] . '</td><td>' . $row['description'] . '</td><td>' . $row['source'] . '</td><td>' . $row['owner'] . '</td><td>' . $row['project_no'] . '</td></tr>';
}
?>
</tbody>
</table>
