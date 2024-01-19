<?php
$servername='localhost';
$user='root';
$pass='';
$db_name='sms_db';
$con=mysqli_connect($servername,$user,$pass,$db_name);
if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}
?>