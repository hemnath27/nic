<?php

session_start();

require 'dbcon.php';

$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$starting = $_POST['starting'];
$ending = $_POST['ending'];

$insert = "insert into transport(name,dob,gender,phone,email,starting,ending)
values('$name','$dob','$gender',$phone,'$email','$starting','$ending')";

$result=pg_query($insert);
if ($result){
    echo'your form submit successfully';
}

else{
    echo 'your form not submit';
}

pg_close($db);
exit();

?>