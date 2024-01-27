<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$record_id = $_GET['emp_id'];

$stmt = $conn -> prepare("UPDATE employees SET emp_active = 0
WHERE emp_id = $record_id");

$stmt -> execute([]);

header("location:emp.php");