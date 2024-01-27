<?php
    session_start();
    if( !isset($_SESSION['username']) ){
        header("location:../index.php");
    }
    include "../master/sections/connect.php";
    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $item = $_POST['item'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $upload_image = $_FILES['upload_image'];
        $userID = $_SESSION['userid'];
        // create distenation 
        $dis = dirname(__FILE__, 2 ) . "/" . "upload_files/" . $upload_image['name'];
        // image path save in db
        $image_path = ".." . "/" . "upload_files/" . $upload_image['name'];
        move_uploaded_file($upload_image['tmp_name'], $dis);
        $stmt = $conn -> prepare("INSERT INTO items(item_name, item_price, item_quantity,
        item_photo, user_userid) VALUES(?,?,?,?,?)");
        $stmt -> execute([$item, $price, $quantity, $image_path, $userID]);
        header("location:item.php");
    }
    include "../master/sections/start.php";
    include "../master/sections/links.php";
    include "../master/sections/mid.php";
?>

<div class="data">
    <div class="page-title">Sections</div>

    <div class="form-box">
        <form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <span>Item Name:</span>
                <input type="text" name="item" placeholder="item name" class="b">
                <div class="res h-s">Enter item name</div>
            </div>

            <div class="form-row">
                <span>Item Price:</span>
                <input type="number" name="price" placeholder="item prcie" class="b">
                <div class="res h-s">Enter item name</div>
            </div>

            <div class="form-row">
                <span>Item Quantity:</span>
                <input type="number" name="quantity" placeholder="item quantity" class="b">
                <div class="res h-s">Enter item name</div>
            </div>

            <div class="form-row">
                <span>Item Photo:</span>
                <input type="file" name="upload_image" class="b">
                <div class="res h-s">Enter item name</div>
                <div class="h-s" id="res2">This file isn't image</div>
            </div>

            <div class="form-row">
                <input type="submit" value="Add Item">
            </div>
        </form>
    </div>
</div>

<?php include "../master/sections/foot.php"; ?>

<!-- custome js  -->
<script src="../master/js/validate.js"></script>
<?php include "../master/sections/end.php"; ?>

