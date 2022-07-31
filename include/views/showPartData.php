    <tbody class="">
<?php
$qstring = 'SELECT part_number, SUM(quantity) as quantity, GROUP_CONCAT(DiSTINCT location) as location, GROUP_CONCAT(DISTINCT owner) as owner, GROUP_CONCAT(DISTINCT project_no) as project_no, GROUP_CONCAT(DISTINCT description) as description FROM '.
    'inventory.items WHERE LOWER(part_number) LIKE LOWER(:part_number) ' .
    'AND LOWER(location) LIKE LOWER(:location) AND LOWER(owner) LIKE LOWER(:owner) AND LOWER(project_no) LIKE LOWER(:project_no) AND LOWER(description) LIKE LOWER(:description)' .
    'AND quantity > 0 GROUP BY part_number ORDER BY part_number DESC';
try {
    $query = $connection->prepare($qstring, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
}catch (PDOException $e){
    echo $e->getMessage();
}
if(array_key_exists('part_number', $_GET) && $_GET['part_number'] != '') {
    $part_number = '%' . $_GET['part_number'] .'%';
}else{
    $part_number = '%';
}
if (array_key_exists('location', $_GET)&& $_GET['location'] != ''){
    $location = '%' . $_GET['location'].'%';
}else{
    $location = '%';
}
if (array_key_exists('owner', $_GET)&& $_GET['owner'] != ''){
    $owner = '%' . $_GET['owner'].'%';
}else{
    $owner = '%';
}
if (array_key_exists('description', $_GET)&& $_GET['description'] != ''){
    $description =  '%' . $_GET['description'].'%';
}else{
    $description = '%';
}
if (array_key_exists('project_no', $_GET)&& $_GET['project_no'] != '') {
    $project_no = '%' . $_GET['project_no'].'%';
}
else{
    $project_no = '%';
}
try {
    $query->execute(array('part_number' => $part_number,
        'location' => $location,
        'owner' => $owner,
        'project_no' => $project_no,
        'description' => $description));

} catch (PDOException $e) {
    echo "Error!: ". $e->getMessage(). " <br/>";

    die();
}

foreach ($query as $row)
{
    echo '<tr><th scope="row">' . $row['part_number'] . '</th><td>' . $row['description'] . '</td><td>' . $row['quantity'] .'</td><td>' . $row['location'] . '</td><td>' . $row['owner'] . '</td><td>' . $row['project_no'] . '</td></tr>';
}
?>
    </tbody>
</table>
