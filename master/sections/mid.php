</div>
<div class="page-data" id="data-box">
    <header>
        <div class="bars" id="bar">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="cart-box">
            <i class="fa-solid fa-cart-shopping"></i>
            <?php
                $u_id = $_SESSION['userid'];
                $cart_count = $conn -> query("SELECT COUNT(cart_id) FROM cart
                WHERE user_userid = $u_id") -> fetchAll(PDO::FETCH_COLUMN);
            ?>
            <div class="cart-content" id="cart-result"><?php echo $cart_count[0];?></div>
        </div>
        <div class="profile">
            <ul class="ul-main">
                <li id="li-show">
                    <?php echo $_SESSION['username']; ?> <i class="fas fa-chevron-down" id="icon-arrow"></i>
                    <ul class="ul-sub h-s" id="sub">
                        <li>
                            <a href="change_pass.php">Change Password</a>
                        </li>
                        <li>
                            <a href="out.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>