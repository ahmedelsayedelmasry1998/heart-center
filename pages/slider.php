<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

include "../master/sections/connect.php";
$get_pat_records = $conn->query("SELECT pat_id, pat_name, pat_phone, pat_age, treat_name
    FROM patients INNER JOIN treat_doctors USING(treat_id) WHERE pat_active = 1
    ORDER BY pat_id")->fetchAll(PDO::FETCH_ASSOC);
$json_data = json_encode($get_pat_records);
file_put_contents("pat.json", $json_data);
include "../master/sections/start.php";
include "../master/sections/links.php";
include "../master/sections/mid.php";
?>
<div class="data">
    <div class="page-title">Slider</div>

    <div class="search">
        <div class="add-box">
            <a href="add_slide.php">Add Slide</a>
        </div>
    </div>


    <div class="slider">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <?php
                $get_records = $conn->query("SELECT * FROM slider");
                while ($row = $get_records->fetch()) :
                ?>
                    <?php if ($row['slide_id'] == 1) : ?>
                        <div class="carousel-item active">
                            <img src="<?php echo $row['slide_path']; ?>" class="d-block w-100">
                        </div>
                    <?php else : ?>
                        <div class="carousel-item">
                            <img src="<?php echo $row['slide_path']; ?>" class="d-block w-100">
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<?php include "../master/sections/footNav.php"; ?>
<!-- custome js  -->
<script src="../master/js/bootstrap.min.js"></script>
<?php include "../master/sections/end.php"; ?>