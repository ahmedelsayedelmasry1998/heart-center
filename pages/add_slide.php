<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $slide = $_POST['slide'];
        $upload_image = $_FILES['uploadimage'];
        // create distenation 
        $dis = dirname(__FILE__, 2 ) . "/" . "upload_files/" . "slider/". $upload_image['name'];
        // image path save in db
        $image_path = ".." . "/" . "upload_files/". "slider/" . $upload_image['name'];
        move_uploaded_file($upload_image['tmp_name'], $dis);
        $stmt = $conn -> prepare("INSERT INTO slider(slide_name, slide_path)
        VALUES(?,?)");
        $stmt -> execute([$slide, $image_path]);
        header("location:slider.php");
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Slider</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <span>Slide Title:</span>
                <input type="text" name="slide" placeholder="Slide Title">
            </div>

            <div class="form-row">
                <span>Slide Image:</span>
                <input type="file" name="uploadimage">
            </div>

            <div class="form-row">
                <input type="submit" value="Add Slide">
            </div>
        </form>


    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

