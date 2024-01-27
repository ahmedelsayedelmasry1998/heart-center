<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Treatment Doctors</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <div class="form-row">
                <span>Doctor name:</span>
                <input type="text" name="doctor" placeholder="doctor name">
            </div>

            <div class="form-row">
                <span>Phone:</span>
                <input type="tel" name="phone" id="" placeholder="phone">
            </div>

            
            <div class="form-row">
                <span>Gender:</span>
                <select name="gender">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-row">
                <span>Address:</span>
                <input type="text" name="address" placeholder="daddress">
            </div>

            <div class="form-row">
                <span>Sections:</span>
                <select name="section">
                    <option value="">Select</option>
                    <?php
                        $get_sections = $conn -> query("SELECT section_id, section_name
                        FROM sections WHERE section_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach( $get_sections as $key => $value ){
                            echo "<option value=\"$key\">$value</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-row">
                <input type="submit" value="Add Doctor">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $treat = $_POST['doctor'];
                $phone = $_POST['phone'];
                $gender = $_POST['gender'];
                $address = $_POST['address'];
                $section = $_POST['section'];
                $userID = $_SESSION['userid'];
                if( empty($treat) || empty($phone) || empty($gender) || empty($address) || empty($section)){
                    echo "<div class=\"error\">Enter data to save doctor.</div>";
                }
                else{
                    $stmt = $conn -> prepare("INSERT INTO treat_doctors (treat_name, treat_phone,
                    treat_gender, treat_address, section_id, user_userid) VALUES(?,?,?,?,?,?)");
                    $stmt -> execute([$treat, $phone, $gender, $address, $section, $userID]);
                    header("location:treat.php");
                }
            }
        ?>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

