<?php
require_once 'dbcon.php';

if (!empty($_POST['ending_id'])) {
    $id = $_POST['ending_id'];

    $sql = "SELECT * FROM ending WHERE ending_id =$id";
    $result = pg_query($sql);

    $output .= '<option value="">-- select To --</option>';

    while ($row = pg_fetch_assoc($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['ending_place'] . '</option>';
       
    }

   
}
?>
