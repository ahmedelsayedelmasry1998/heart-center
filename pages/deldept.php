<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$record_id = $_GET['dept_id'];

$stmt = $conn -> prepare("UPDATE departments SET dept_active = 0
WHERE dept_id = $record_id");

$stmt -> execute([]);

header("location:dept.php");