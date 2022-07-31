<tbody class="">
<?php
$qstring = 'SELECT part_number, quantity , location,  owner,  project_no,  description FROM ' .
    'inventory.items WHERE LOWER(part_number) LIKE LOWER(:part_number) ' .
    'AND LOWER(location) LIKE LOWER(:location) AND LOWER(owner) LIKE LOWER(:owner) AND LOWER(project_no) LIKE LOWER(:project_no) AND LOWER(description) LIKE LOWER(:description)' .
    'AND quantity > 0 ORDER BY part_number DESC';
try {
    $query = $connection->prepare($qstring, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
} catch (PDOException $e) {
    echo $e->getMessage();
}
if (array_key_exists('part_number', $_GET) && $_GET['part_number'] != '') {
    $part_number = $_GET['part_number'];
} else {
    $part_number = '%';
}
if (array_key_exists('location', $_GET) && $_GET['location'] != '') {
    $location = $_GET['location'];
} else {
    $location = '%';
}
if (array_key_exists('owner', $_GET) && $_GET['owner'] != '') {
    $owner = $_GET['owner'];
} else {
    $owner = '%';
}
if (array_key_exists('description', $_GET) && $_GET['description'] != '') {
    $description = $_GET['description'];
} else {
    $description = '%';
}
if (array_key_exists('project_no', $_GET) && $_GET['project_no'] != '') {
    $project_no = $_GET['project_no'];
} else {
    $project_no = '%';
}
try {
    $query->execute(array('part_number' => $part_number,
        'location' => $location,
        'owner' => $owner,
        'project_no' => $project_no,
        'description' => $description));

} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . " <br/>";

    die();
}
$i =0;
foreach ($query as $row) {
    echo '<form method="post" action="actions/consumePart.php" role="form" class="" ><tr>' .
                '<th scope="row">' .
                '<input readonly="true" type="text" name="part_number" value="' . $row['part_number'] . '">' .
                '</th><td>' .
                '<input type="number" name="quantity" value="' . $row['quantity'] . '">' .
                '</td><td><div class="autocomplete">' .
                '<input type="text" name="location_mod" value="' . $row['location'] . '">'.
                '</div></td><td>'.
                '<input type="text" readonly="true" name="owner_mod" value="' . $row['owner'] . '">'.
                '</td><td>' .
                '<input type="text" name="project_no" readonly="true" value="' . $row['project_no'] . '">'.
                '</td><td>' .
                '<input type="text" name="description" value="'. $row['description'] . '"> '.
                '</td><td>'.
                '<button type="button" class="btn" onclick="SubForm(this)" id="submit_mod'.$i.'" name="submit_mod">Update Row</button>'.
                '</td></tr></form>';
    $i++;
}
?>
</tbody>
</table>
