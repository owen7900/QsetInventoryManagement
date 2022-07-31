<script>
    const project_nos = [<?php
        $partNoQuery = "select distinct project_no from inventory.items";
        $result = $connection->query($partNoQuery);
        while ($row = $result->fetch()){
            echo '"' . $row['project_no'] . '",';
        }
        ?>];
autocomplete(document.getElementById("project_no"), project_nos);

</script>
