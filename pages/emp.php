<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    elseif( $_SESSION['usertype'] != 'admin'){
        header("location:out.php");
    }
    include "../master/sections/connect.php";
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Employees</div>
    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search" autocomplete="off">
        </div>
        <div class="add-box">
            <a href="add_emp.php">Add Employees</a>
        </div>
    </div>

    <div class="tab">
        <table>
            <tr>
                <th>Employee</th>
                <th>Job Title</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Hire Date</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>National ID</th>
                <th>Added By</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php 
                $get_records = $conn -> query("SELECT emp_id, emp_name, job_title, dept_name, salary,
                hire_date, emp_phone, emp_email, emp_address, emp_age, emp_gender, national_id,
                user_username
                FROM (((( employees
                    INNER JOIN jobs USING(job_id))
                    INNER JOIN departments USING(dept_id))
                    CROSS JOIN contacts ON employees.emp_id = contacts.con_id)
                    INNER JOIN heart_users ON employees.user_userid = heart_users.user_userid)
                WHERE emp_active = 1");
                while($row = $get_records -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['emp_name'] ;?></td>
                    <td><?php echo $row['job_title'] ;?></td>
                    <td><?php echo $row['dept_name'] ;?></td>
                    <td><?php echo $row['salary'] ;?></td>
                    <td><?php echo $row['hire_date'] ;?></td>
                    <td><?php echo $row['emp_phone'] ;?></td>
                    <td><?php echo $row['emp_email'] ;?></td>
                    <td><?php echo $row['emp_age'] ;?></td>
                    <td><?php echo $row['emp_gender'] ;?></td>
                    <td><?php echo $row['emp_address'] ;?></td>
                    <td><?php echo $row['national_id'] ;?></td>
                    <td><?php echo $row['user_username'] ;?></td>
                    <td class="e">
                        <form action="editemp.php" method="GET">
                            <input type="hidden" name="emp_id" value="<?php echo $row['emp_id'];?>">
                            <button><i class="fas fa-edit"></i></button>
                        </form>
                    </td>
                    <td class="trash">
                        <form action="delemp.php" method="GET">
                            <input type="hidden" name="emp_id" value="<?php echo $row['emp_id'];?>">
                            <button><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endwhile;?>
        </table>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

