<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] != 'admin'){
        header("location:out.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $empID = $_POST['emp-id'];
        $emp = $_POST['emp'];
        $job = $_POST['job'];
        $dept = $_POST['dept'];
        $salary = $_POST['salary'];
        $hire_date = $_POST['hd'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $nid = $_POST['nid'];
        $userID = $_SESSION['userid'];
        $stmt1 = $conn -> prepare("UPDATE employees SET emp_name = ?, job_id = ?, dept_id = ?,
        salary = ?, hire_date = ?, emp_age = ?, emp_gender = ?, national_id = ?, user_userid = ?
        WHERE emp_id = $empID");
        $stmt1 -> execute([$emp, $job, $dept, $salary, $hire_date, $age, $gender, $nid, $userID]);
        $stmt2 = $conn -> prepare("UPDATE contacts SET emp_phone = ?, emp_email = ?, 
        emp_address = ? WHERE con_id = $empID");
        $stmt2 -> execute([$phone, $email, $address]);
        header("location:emp.php");
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Employees</div>

    <?php
        $emp_id = $_GET['emp_id'];

        $emp_info = $conn -> query("SELECT * FROM employees
        WHERE emp_id = $emp_id") -> fetchAll(PDO::FETCH_ASSOC) ;

        $con_info = $conn -> query("SELECT * FROM contacts 
        WHERE con_id = $emp_id") -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
            <input type="hidden" name="emp-id" value="<?php echo $emp_info[0]['emp_id'] ;?>">
            <div class="form-row">
                <span>Employee name:</span>
                <input type="text" name="emp" value="<?php echo $emp_info[0]['emp_name'] ;?>">
            </div>

            <div class="form-row">
                <span>Job Title:</span>
                <select name="job" id="">
                    <option value="">Select</option>
                    <?php
                        $get_jobs = $conn -> query("SELECT job_id, job_title
                        FROM jobs WHERE job_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach( $get_jobs as $key => $value ){
                            if( $key == $emp_info[0]['job_id'] ){
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
                <span>Department:</span>
                <select name="dept" id="">
                    <option value="">Select</option>
                    <?php
                        $get_dept = $conn -> query("SELECT dept_id, dept_name
                        FROM departments WHERE dept_active = 1") -> fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach( $get_dept as $key => $value ){
                            if( $key == $emp_info[0]['dept_id'] ){
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
                <span>Salary:</span>
                <input type="number" name="salary" value="<?php echo $emp_info[0]['salary'] ;?>">
            </div>
                            
            <div class="form-row">
                <span>Hire Date:</span>
                <input type="date" name="hd" value="<?php echo $emp_info[0]['hire_date'] ;?>">
            </div>

            <div class="form-row">
                <span>Phone:</span>
                <input type="tel" name="phone" value="<?php echo $con_info[0]['emp_phone'] ;?>">
            </div>

            <div class="form-row">
                <span>Email:</span>
                <input type="email" name="email" value="<?php echo $con_info[0]['emp_email'] ;?>">
            </div>

            <div class="form-row">
                <span>Address:</span>
                <input type="text" name="address" value="<?php echo $con_info[0]['emp_address'] ;?>">
            </div>

            <div class="form-row">
                <span>Age:</span>
                <input type="number" name="age" value="<?php echo $emp_info[0]['emp_age'] ;?>">
            </div>

            <div class="form-row">
                <span>Gender:</span>
                <select name="gender" id="">
                <option value="male" <?php if($emp_info[0]['emp_gender'] == 'male'){echo "selected=\"selected\"";}?>>Male</option>
                <option value="female" <?php if($emp_info[0]['emp_gender'] == 'female'){echo "selected=\"selected\"";}?>>Female</option>
                </select>
            </div>

            <div class="form-row">
                <span>National ID:</span>
                <input type="text" name="nid" value="<?php echo $emp_info[0]['national_id'] ;?>">
            </div>

            <div class="form-row">
                <input type="submit" value="Add Employee">
            </div>
        </form>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

