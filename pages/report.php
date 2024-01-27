<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

include "../master/sections/connect.php";
include "../master/sections/start.php";
include "../master/sections/links.php";
include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Reports</div>

</div>

<?php include "../master/sections/footNav.php"; ?>
<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>