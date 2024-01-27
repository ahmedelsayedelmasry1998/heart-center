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

    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search" autocomplete="off">
        </div>
        <div class="add-box">
            <a href="add_pat.php">Add Patient</a>
        </div>
    </div>

    <div class="tab">
        <table>
            <tr>
                <th>Patient</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Treatment Doctor</th>
                <th>Added By</th>
                <?php if($_SESSION['usertype'] == 'admin'):?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif;?>
            </tr>

            <?php
                $get_records = $conn -> query("SELECT pat_id, pat_name, pat_phone, pat_age,
                pat_gender, treat_name, user_username
                FROM (( patients
                        INNER JOIN treat_doctors USING(treat_id))
                        INNER JOIN heart_users ON patients.user_userid = heart_users.user_userid)
                WHERE pat_active = 1");
                while($row = $get_records -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['pat_name'];?></td>
                    <td><?php echo $row['pat_phone'];?></td>
                    <td><?php echo $row['pat_age'];?></td>
                    <td><?php echo $row['pat_gender'];?></td>
                    <td><?php echo $row['treat_name'];?></td>
                    <td><?php echo $row['user_username'];?></td>
                    <?php if($_SESSION['usertype'] == 'admin'):?>
                        <td class="e">
                            <form action="editpat.php" method="GET">
                                <input type="hidden" name="pat_id" value="<?php echo $row['pat_id'];?>">
                                <button><i class="fas fa-edit"></i></button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="delpat.php" method="GET">
                                <input type="hidden" name="pat_id" value="<?php echo $row['pat_id'];?>">
                                <button><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    <?php endif;?>
                </tr>
            <?php endwhile;?>
        </table>
    </div>

</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>

