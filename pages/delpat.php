<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$record_id = $_GET['pat_id'];

$stmt = $conn -> prepare("UPDATE patients SET pat_active = 0
WHERE pat_id = $record_id");

$stmt -> execute([]);

header("location:pat.php");