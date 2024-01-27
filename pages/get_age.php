<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}

include "../master/sections/connect.php";
$patid = $_GET['q'];
$pat_age = $conn -> query("SELECT pat_age FROM patients
WHERE pat_id = $patid") -> fetchAll(PDO::FETCH_COLUMN);
echo $pat_age[0];