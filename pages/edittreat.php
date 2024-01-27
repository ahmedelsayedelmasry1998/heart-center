<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $treatID = $_POST['treat-id'];
        $treat = $_POST['doctor'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $section = $_POST['section'];
        $userID = $_SESSION['userid'];
        $stmt = $conn -> prepare("UPDATE treat_doctors SET treat_name = ?, treat_phone = ?,
        treat_gender = ?, treat_address = ?, section_id = ?, user_userid = ?
        WHERE treat_id = $treatID");
        $stmt -> execute([$treat, $phone, $gender, $address, $section, $userID]);
        header("location:treat.php");
    
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Treatment Doctors</div>

    <?php
        $treat_id = $_GET['treat_id'];

        $treat_info = $conn -> query("SELECT * FROM treat_doctors 
        WHERE treat_id = $treat_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">

            <input type="hidden" name="treat-id" value="<?php echo $treat_info[0]['treat_id'] ;?>">
            <div class="form-row">
                <span>Doctor name:</span>
                <input type="text" name="doctor" value="<?php echo $treat_info[0]['treat_name'] ;?>">
            </div>

            <div class="form-row">
                <span>Phone:</span>
                <input type="tel" name="phone" id="" value="<?php echo $treat_info[0]['treat_phone'] ;?>">
            </div>

            
            <div class="form-row">
                <span>Gender:</span>
                <select name="gender">
                    <option value="male" <?php if($treat_info[0]['treat_gender'] == 'male'){echo "selected=\"selected\"";}?>>Male</option>
                    <option value="female" <?php if($treat_info[0]['treat_gender'] == 'female'){echo "selected=\"selected\"";}?>>Female</option>
                </select>
            </div>

            <div class="form-row">
                <span>Address:</span>
                <input type="text" name="address" value="<?php echo $treat_info[0]['treat_address'] ;?>">
            </div>

            <div class="form-row">
                <span>Sections:</span>
                <select name="section">
                    <option value="">Select</option>
                    <?php
                        $get_sections = $conn -> query("SELECT section_id, section_name
                        FROM sections WHERE section_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach( $get_sections as $key => $value ){
                            if( $key == $treat_info[0]['section_id'] ){
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
                <input type="submit" value="Edit Doctor">
            </div>
        </form>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

