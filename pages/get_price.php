<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}

include "../master/sections/connect.php";
$examid = $_GET['q'];
$exam_price = $conn -> query("SELECT exam_price FROM examinations
WHERE exam_id = $examid") -> fetchAll(PDO::FETCH_COLUMN);
echo $exam_price[0];