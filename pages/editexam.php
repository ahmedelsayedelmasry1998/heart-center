<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $examID = $_POST['exam-id'];
        $exam = $_POST['exam'];
        $price = $_POST['price'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("UPDATE examinations SET exam_name = ?, exam_price = ?,
        user_userid = ? WHERE exam_id = $examID");
        $stmt -> execute([$exam, $price,$userID]);
        header("location:exam.php");

    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Examinations</div>
    <?php
        $exam_id = $_GET['exam_id'];
        $exam_info = $conn -> query("SELECT * FROM examinations
        WHERE exam_id = $exam_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <input type="hidden" name="exam-id" value="<?php echo $exam_info[0]['exam_id']; ?>">
            <div class="form-row">
                <span>Examination:</span>
                <input type="text" name="exam" value="<?php echo $exam_info[0]['exam_name']; ?>">
            </div>
            <div class="form-row">
                <span>Price:</span>
                <input type="number" name="price" value="<?php echo $exam_info[0]['exam_price']; ?>">
            </div>
            <div class="form-row">
                <input type="submit" value="Edit Examination">
            </div>
        </form>

        <?php

        ?>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

