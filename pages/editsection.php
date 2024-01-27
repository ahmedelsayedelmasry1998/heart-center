<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $sectionID = $_POST['section-id'];
        $section = $_POST['section'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("UPDATE sections SET section_name = ?, user_userid = ?
        WHERE section_id = $sectionID");
        $stmt -> execute([$section, $userID]);
        header("location:sections.php");
        
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Sections</div>

    <?php
        $section_id = $_GET['section_id'];
        $section_info = $conn -> query("SELECT * FROM sections
        WHERE section_id = $section_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <input type="hidden" name="section-id" value="<?php echo $section_info[0]['section_id'] ;?>">
            <div class="form-row">
                <span>Section name:</span>
                <input type="text" name="section" value="<?php echo $section_info[0]['section_name'] ;?>">
            </div>
            <div class="form-row">
                <input type="submit" value="Edit Section">
            </div>
        </form>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

