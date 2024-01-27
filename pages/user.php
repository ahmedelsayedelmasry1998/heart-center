<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
} elseif ($_SESSION['usertype'] != 'user') {
    header("location:out.php");
}
include "../master/sections/connect.php";
include "../master/sections/start.php";
include "../master/sections/links.php";
include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Dashboard</div>
    <!-- page content -->
    <div class="widgets">
        <div class="widget-1">
            <span>Patient</span>
            <?php
            $pat_count = $conn->query("SELECT COUNT(pat_id)
                FROM patients WHERE pat_active = 1")->fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $pat_count[0]; ?></span>
        </div>
        <div class="widget-2">
            <span>Treatment Doctors</span>
            <?php
            $treat_count = $conn->query("SELECT COUNT(treat_id)
                FROM treat_doctors WHERE treat_active = 1")->fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $treat_count[0]; ?></span>
        </div>
        <div class="widget-3">
            <span>Employees</span>
            <?php
            $emp_count = $conn->query("SELECT COUNT(emp_id)
                FROM employees WHERE emp_active = 1")->fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $emp_count[0]; ?></span>
        </div>
        <div class="widget-4">
            <span>Total Income</span>
            <?php
            $inv_total = $conn->query("SELECT SUM(invoice_total)
                FROM invoice")->fetchAll(PDO::FETCH_COLUMN);
            $invoice_total = ($inv_total[0] == null) ? 0 : $inv_total[0];
            ?>
            <span><?php echo $invoice_total . ' L.E'; ?></span>
        </div>
        <div class="widget-5">
            <span>Last Invoice Date</span>
            <?php
            $last_inoive_date = $conn->query("SELECT invoice_date
                FROM invoice ORDER BY invoice_id DESC LIMIT 1")->fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $last_inoive_date[0]; ?></span>
        </div>
        <div class="widget-6">
            <span>Examinations Count</span>
            <?php
            $exam_count = $conn->query("SELECT COUNT(exam_id)
                FROM invoice_details")->fetchAll(PDO::FETCH_COLUMN);
            ?>
            <span><?php echo $exam_count[0]; ?></span>
        </div>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->

<?php include "../master/sections/end.php"; ?>