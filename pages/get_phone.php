<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}

include "../master/sections/connect.php";
$patid = $_GET['q'];
$pat_mob = $conn -> query("SELECT pat_phone FROM patients
WHERE pat_id = $patid") -> fetchAll(PDO::FETCH_COLUMN);
echo $pat_mob[0];