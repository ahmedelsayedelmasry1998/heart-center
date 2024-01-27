<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$record_id = $_GET['exam_id'];

$stmt = $conn -> prepare("UPDATE examinations SET exam_active = 0
WHERE exam_id = $record_id");

$stmt -> execute([]);

header("location:exam.php");