<?php
require_once'dbcon.php';
 //print_r($_POST); die;
$id=$_POST['id'];
$name=$_POST['name'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$starting=$_POST['starting'];
$ending=$_POST['ending'];

$update="update transport set name='$name',dob='$dob', gender='$gender',phone= $phone,email='$email',starting='$starting',ending='$ending' where id=$id";
$result=pg_query($update);
if($result){
echo"Updated successfully";
}
else{
echo"Something wrong";
}
?>