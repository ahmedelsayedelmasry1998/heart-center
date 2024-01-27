<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$record_id = $_GET['treat_id'];

$stmt = $conn -> prepare("UPDATE treat_doctors SET treat_active = 0
WHERE treat_id = $record_id");

$stmt -> execute([]);

header("location:treat.php");