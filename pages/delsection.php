<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}
include "../master/sections/connect.php";

$record_id = $_GET['section_id'];

$stmt = $conn -> prepare("UPDATE sections SET section_active = 0
WHERE section_id = $record_id");

$stmt -> execute([]);

header("location:sections.php");