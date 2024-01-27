<?php
session_start();
if( !isset($_SESSION['username']) ){
    header("location:../index.php");
}

include "../master/sections/connect.php";

$userid = $_SESSION['userid'];
$item_id = $_GET['q'];

$stmt = $conn -> prepare("INSERT INTO cart(user_userid, item_id) VALUES(?,?)");
$stmt -> execute([$userid, $item_id]);

$cart_count = $conn -> query("SELECT COUNT(cart_id) FROM cart
WHERE user_userid = $userid") -> fetchAll(PDO::FETCH_COLUMN);

echo $cart_count[0];