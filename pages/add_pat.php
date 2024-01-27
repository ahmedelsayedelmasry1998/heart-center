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
    <div class="page-title">Patients</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <div class="form-row">
                <span>Patient name:</span>
                <input type="text" name="pat" placeholder="patient name">
            </div>

            <div class="form-row">
                <span>Phone:</span>
                <input type="tel" name="phone" id="" placeholder="phone">
            </div>

            <div class="form-row">
                <span>Age:</span>
                <input type="number" name="age" placeholder="age">
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
                <span>Sections:</span>
                <select name="treat">
                    <option value="">Select</option>
                    <?php
                        $get_treat = $conn -> query("SELECT treat_id, treat_name
                        FROM treat_doctors WHERE treat_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach( $get_treat as $key => $value ){
                            echo "<option value=\"$key\">$value</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-row">
                <input type="submit" value="Add Patient">
            </div>
        </form>

        <?php
            if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                $pat = $_POST['pat'];
                $phone = $_POST['phone'];
                $gender = $_POST['gender'];
                $age = $_POST['age'];
                $treat = $_POST['treat'];
                $userID = $_SESSION['userid'];
                if( empty($pat) || empty($phone) || empty($gender) || empty($age) || empty($treat)){
                    echo "<div class=\"error\">Enter data to save patient.</div>";
                }
                else{
                    $stmt = $conn -> prepare("INSERT INTO patients (pat_name, pat_phone,
                    pat_age, pat_gender, treat_id, user_userid) VALUES(?,?,?,?,?,?)");
                    $stmt -> execute([$pat, $phone, $age, $gender, $treat, $userID]);
                    header("location:pat.php");
                }
            }
        ?>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

