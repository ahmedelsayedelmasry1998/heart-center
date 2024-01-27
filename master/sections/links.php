<nav>
    <?php if ($_SESSION['usertype'] == 'admin') : ?>
        <a href="admin.php" class="act">Dashboard</a>
    <?php else : ?>
        <a href="user.php" class="act">Dashboard</a>
    <?php endif; ?>
    <a href="sections.php">Sections</a>
    <a href="treat.php">Treatment Doctors</a>
    <a href="pat.php">Patients</a>

    <?php if ($_SESSION['usertype'] == 'admin') : ?>
        <a href="job.php">Jobs</a>
        <a href="dept.php">Departments</a>
        <a href="emp.php">Employees</a>
    <?php endif; ?>

    <a href="exam.php">Examinations</a>
    <a href="invoice.php">Invoice</a>
    <a href="item.php">Items</a>
    <a href="report.php">Reports</a>
    <a href="slider.php">Slider</a>

</nav>