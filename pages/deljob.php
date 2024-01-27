<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$record_id = $_GET['job_id'];

$stmt = $conn -> prepare("UPDATE jobs SET job_active = 0
WHERE job_id = $record_id");

$stmt -> execute([]);

header("location:job.php");