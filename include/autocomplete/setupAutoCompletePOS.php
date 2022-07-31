<script>
    const purchase_order_number = [<?php
        $partNoQuery = "select distinct purchase_order_number from inventory.part_source";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['purchase_order_number'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("purchase_order_number"), purchase_order_number);
    const part_numbers = [<?php
        $partNoQuery = "select distinct part_number from inventory.part_source";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['part_number'] . '",';
        }
        ?>];
    console.log("TEST");
    autocomplete(document.getElementById("part_number"), part_numbers);
    const sources = [<?php
        $partNoQuery = "select distinct source from inventory.part_source";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['source'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("source"), sources);
    const owners = [<?php
        $partNoQuery = "select distinct owner from inventory.part_source";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['owner'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("owner"), owners);
    const project_no = [<?php
        $partNoQuery = "select distinct project_no from inventory.part_source";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['project_no'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("project_no"), project_no);
    const descriptions = [<?php
        $partNoQuery = "select distinct description from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['description'] . '",';
        }
        ?>];
    autocomplete(document.getElementById("description"), descriptions);
</script>
