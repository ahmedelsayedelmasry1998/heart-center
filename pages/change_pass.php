<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    $user_id = $_SESSION['userid'];
    $get_user_pass = $conn -> query("SELECT user_password FROM heart_users
    WHERE user_userid = $user_id") -> fetchAll(PDO::FETCH_COLUMN);
    $json_data = json_encode($get_user_pass);
    file_put_contents("user_pass.json", $json_data);
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>
<div class="data">
    <div class="page-title">Dashboard</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <div class="form-row">
                <span>Current Password:</span>
                <input type="password" id="old-pass" placeholder="current password">
            </div>

            <div class="form-row h-s a">
                <span>New Password:</span>
                <input type="password" name="pass" id="inp-pass1" placeholder="current password">
            </div>

            <div class="form-row h-s a">
                <span>Retype Password:</span>
                <input type="password" id="inp-pass2" placeholder="current password">
            </div>
            <div class="form-row">
                <div id="result"></div>
            </div>
            <div class="form-row h-s" id="btn-run">
                <input type="submit" value="Change Password">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $pass = $_POST['pass'];
                $stmt = $conn -> prepare("UPDATE heart_users SET user_password = ?
                WHERE user_userid = $user_id");
                $stmt -> execute([$pass]);
                header("location:out.php");   
            }
        ?>
    </div>

</div>


<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->
<script src="../master/js/change_pass.js"></script>

<?php include "../master/sections/end.php"; ?>

