<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $patID = $_POST['pat-id'];
        $pat = $_POST['pat'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $treat = $_POST['treat'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("UPDATE patients SET pat_name = ?, pat_phone = ?,
        pat_age = ?, pat_gender = ?, treat_id = ?, user_userid = ? WHERE pat_id = $patID");
        $stmt -> execute([$pat, $phone, $age, $gender, $treat, $userID]);
        header("location:pat.php");

    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Patients</div>

    <?php
        $pat_id = $_GET['pat_id'];
        $pat_info = $conn -> query("SELECT * FROM patients
        WHERE pat_id = $pat_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">

            <input type="hidden" name="pat-id" value="<?php echo $pat_info[0]['pat_id'] ;?>">
            <div class="form-row">
                <span>Patient name:</span>
                <input type="text" name="pat" value="<?php echo $pat_info[0]['pat_name'] ;?>">
            </div>

            <div class="form-row">
                <span>Phone:</span>
                <input type="tel" name="phone" id="" value="<?php echo $pat_info[0]['pat_phone'] ;?>">
            </div>

            <div class="form-row">
                <span>Age:</span>
                <input type="number" name="age" value="<?php echo $pat_info[0]['pat_age'] ;?>">
            </div>

            <div class="form-row">
                <span>Gender:</span>
                <select name="gender">
                <option value="male" <?php if($pat_info[0]['pat_gender'] == 'male'){echo "selected=\"selected\"";}?>>Male</option>
                <option value="female" <?php if($pat_info[0]['pat_gender'] == 'female'){echo "selected=\"selected\"";}?>>Female</option>
                </select>
            </div>

            <div class="form-row">
                <span>Sections:</span>
                <select name="treat">
                    <option value="">Select</option>
                    <?php
                        $get_treat = $conn -> query("SELECT treat_id, treat_name
                        FROM treat_doctors WHERE treat_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach( $get_treat as $key => $value ){
                            if( $key == $pat_info[0]['treat_id'] ){
                                echo "<option value=\"$key\" selected=\"selected\">$value</option>";
                            }
                            else{
                                echo "<option value=\"$key\">$value</option>";
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-row">
                <input type="submit" value="Edit Patient">
            </div>
        </form>

        <?php

        ?>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

