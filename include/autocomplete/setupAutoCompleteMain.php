<script>
    const part_numbers = [<?php
        $partNoQuery = "select distinct part_number from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['part_number'] . '",';
        }
        ?>];
    console.log("TEST");
    autocomplete(document.getElementById("part_number"), part_numbers);
    const locations = [<?php
        $partNoQuery = "select distinct location from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['location'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("location"), locations);
    const owners = [<?php
        $partNoQuery = "select distinct owner from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['owner'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("owner"), owners);
    const project_nos = [<?php
        $partNoQuery = "select distinct project_no from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['project_no'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("project_no"), project_nos);
    const descriptions = [<?php
        $partNoQuery = "select distinct description from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['description'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("description"), descriptions);
</script>
