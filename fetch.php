<?php

require_once 'dbcon.php';

$select = 'select * from transport';
$result = pg_query($select);

$data = array();

while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
exit();
?> 