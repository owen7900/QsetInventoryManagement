<script>
    const locations = [<?php
        $partNoQuery = "select distinct location from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['location'] . '",';
        }
        ?>];
    const project_nos = [<?php
        $partNoQuery = "select distinct project_no from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['project_no'] . '",';
        }
        ?>];
    const owners = [<?php
        $partNoQuery = "select distinct owner from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['owner'] . '",';
        }
        ?>];

</script>
