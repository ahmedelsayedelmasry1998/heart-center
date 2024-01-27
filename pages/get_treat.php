<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}

include "../master/sections/connect.php";
$patid = $_GET['q'];
$pat_treat = $conn -> query("SELECT pat_id, treat_name FROM patients INNER JOIN treat_doctors USING(treat_id)
WHERE pat_id = $patid") -> fetchAll(PDO::FETCH_KEY_PAIR);
echo $pat_treat[$patid];