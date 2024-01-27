<?php
    session_start();
    include "./master/sections/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Heart Center</title>
        <script src="https://kit.fontawesome.com/d61941c423.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./master/css/normalize.css">
        <link rel="stylesheet" href="./master/css/log.css">
    </head>
    <body>
        <div class="log">
            <header>Heart Center</header>
            <div class="logbody">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <input type="text" name="username" placeholder="username">
                    <input type="password" name="pass" placeholder="password">
                    <div>
                        <input type="submit" value="Login">
                    </div>
                </form>

                <?php
                    if( $_SERVER['REQUEST_METHOD'] == 'POST'){
                        $user = $_POST['username'];
                        $pass = $_POST['pass'];
                        if( empty($user) || empty($pass) ){
                            echo "<div class=\"error\">Enter username and npassword to signing </div>";
                        }
                        else{
                            $user_info = $conn -> query("SELECT * FROM heart_users
                            WHERE user_username = '$user' 
                            AND user_password = '$pass'") -> fetchAll(PDO::FETCH_ASSOC);
                            if( count($user_info) > 0){
                                if( $user_info[0]['user_usertype'] == 1){
                                    $_SESSION['username'] = $user_info[0]['user_username'];
                                    $_SESSION['userid'] = $user_info[0]['user_userid'];
                                    $_SESSION['usertype'] = "admin";
                                    header("location:pages/admin.php");
                                }
                                else{
                                    $_SESSION['username'] = $user_info[0]['user_username'];
                                    $_SESSION['userid'] = $user_info[0]['user_userid'];
                                    $_SESSION['usertype'] = "user";
                                    header("location:pages/user.php");
                                }
                            }
                            else{
                                echo "<div class=\"error\">Invalid username or password</div>";
                            }
                        }
                    }
                ?>
            </div>
            <footer>Created BY YAT</footer>
        </div>
    </body>
</html>