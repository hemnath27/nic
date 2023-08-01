<?php

require_once'dbcon.php';

if(isset($_GET['id'])){
$id=$_GET['id'];
$select="delete from transport where id=$id";
$result=pg_query($select);
}
?>