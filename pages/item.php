<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

include "../master/sections/connect.php";
include "../master/sections/start.php";
include "../master/sections/links.php";
include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Item</div>
    <div class="search">
        <div class="add-box">
            <a href="add_item.php">Add Item</a>
        </div>
    </div>

    <div class="gallery">
        <?php
        $userID = $_SESSION['userid'];
        $added_item = $conn->query("SELECT item_id FROM cart
            WHERE user_userid = $userID")->fetchAll(PDO::FETCH_COLUMN);
        $get_records = $conn->query("SELECT * FROM items");
        while ($row = $get_records->fetch()) :
        ?>
            <div>
                <img src="<?php echo $row["item_photo"]; ?>">
                <span class="i-id" style="display:none"><?php echo $row["item_id"]; ?></span>
                <div class="item-data">
                    <div class="item-name"><?php echo $row["item_name"]; ?></div>
                    <div class="price"><?php echo $row["item_price"] . " L.E"; ?></div>

                    <?php if (in_array($row["item_id"], $added_item)) : ?>
                        <div class="add-btn h-s">Add To Cart</div>
                        <div class="added">In Cart</div>

                    <?php else : ?>
                        <div class="add-btn">Add To Cart</div>
                        <div class="added h-s">In Cart</div>

                    <?php endif; ?>

                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include "../master/sections/footNav.php"; ?>
<!-- custome js  -->
<script src="../master/js/cart.js"></script>
<?php include "../master/sections/end.php"; ?>