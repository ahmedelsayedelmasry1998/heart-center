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
        $stmt1 = $conn -> prepare("INSERT INTO employees(emp_name, job_id, dept_id,
        salary, hire_date, emp_age, emp_gender, national_id, user_userid)
        VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt1 -> execute([$emp, $job, $dept, $salary, $hire_date, $age, $gender, $nid, $userID]);
        $stmt2 = $conn -> prepare("INSERT INTO contacts(emp_phone, emp_email, emp_address)
        VALUES(?,?,?)");
        $stmt2 -> execute([$phone, $email, $address]);
        header("location:emp.php");
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Employees</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">

            <div class="form-row">
                <span>Employee name:</span>
                <input type="text" name="emp" placeholder="employee name">
            </div>

            <div class="form-row">
                <span>Job Title:</span>
                <select name="job" id="">
                    <option value="">Select</option>
                    <?php
                        $job_table -> dataSelect();
                    ?>
                </select>
            </div>
            
            <div class="form-row">
                <span>Department:</span>
                <select name="dept" id="">
                    <option value="">Select</option>
                    <?php
                        $dept_table -> dataSelect();
                    ?>
                </select>
            </div>

            <div class="form-row">
                <span>Salary:</span>
                <input type="number" name="salary" placeholder="salary">
            </div>
                            
            <div class="form-row">
                <span>Hire Date:</span>
                <input type="date" name="hd" >
            </div>

            <div class="form-row">
                <span>Phone:</span>
                <input type="tel" name="phone" placeholder="phone">
            </div>

            <div class="form-row">
                <span>Email:</span>
                <input type="email" name="email" placeholder="email">
            </div>

            <div class="form-row">
                <span>Address:</span>
                <input type="text" name="address" placeholder="address">
            </div>

            <div class="form-row">
                <span>Age:</span>
                <input type="number" name="age" placeholder="age">
            </div>

            <div class="form-row">
                <span>Gender:</span>
                <select name="gender" id="">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-row">
                <span>National ID:</span>
                <input type="text" name="nid" placeholder="national ID">
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

