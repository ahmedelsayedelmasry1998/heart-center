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

    <div class="search">
        <div class="search-box">
            <input type="search" id="search" placeholder="search" autocomplete="off">
        </div>
        <div class="add-box">
            <a href="add_treat.php">Add Doctor</a>
        </div>
    </div>

    <div class="tab">
        <table>
            <tr>
                <th>Treatment Doctor</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Section</th>
                <th>Added By</th>
                <?php if($_SESSION['usertype'] == 'admin'):?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif;?>
            </tr>

            <?php
                $get_records = $conn -> query("SELECT treat_id, treat_name, treat_phone, 
                treat_gender, treat_address, section_name, user_username
                FROM (( treat_doctors
                        INNER JOIN sections USING(section_id))
                        INNER JOIN heart_users ON treat_doctors.user_userid = heart_users.user_userid)
                WHERE treat_active = 1");
                while($row = $get_records -> fetch()):
            ?>
                <tr>
                    <td><?php echo $row['treat_name'];?></td>
                    <td><?php echo $row['treat_phone'];?></td>
                    <td><?php echo $row['treat_gender'];?></td>
                    <td><?php echo $row['treat_address'];?></td>
                    <td><?php echo $row['section_name'];?></td>
                    <td><?php echo $row['user_username'];?></td>
                    <?php if($_SESSION['usertype'] == 'admin'):?>
                        <td class="e">
                            <form action="edittreat.php" method="GET">
                                <input type="hidden" name="treat_id" value="<?php echo $row['treat_id'];?>">
                                <button><i class="fas fa-edit"></i></button>
                            </form>
                        </td>
                        <td class="trash">
                            <form action="deltreat.php" method="GET">
                                <input type="hidden" name="treat_id" value="<?php echo $row['treat_id'];?>">
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

