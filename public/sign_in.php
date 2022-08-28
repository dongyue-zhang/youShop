<?php session_start(); ?>
<?php 
require_once('database.php');
$page_title = 'Sign In';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $sql_getuser = "SELECT * FROM users WHERE email = '$user_email' AND password = '$user_password'";
    $db = db_connect();
    $result_set_user = mysqli_query($db, $sql_getuser);
    
    if ($result_set_user -> num_rows == 1) {
        $result = mysqli_fetch_assoc($result_set_user);
        $is_logined = 1;
        $_SESSION['username'] = $result['username'];
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['cart'] = [];
        $_SESSION['name'] = [];
        $_SESSION['img'] = [];
        $_SESSION['qty'] = [];
        $_SESSION['subtotal'] = [];
        $_SESSION['count'] = 0;
        header('Location: after_login.php');
    } else {
        $is_logined = 0;
    }
    mysqli_close($db);
}
?>

<?php include("header.php") ?>
    <div class='form'>
        <h2>Welcome to youShop! &#129395;</h2>
        <form action ="sign_in.php" method="post" >
            <div class="textfield sign_in_textfield">
                <label for="email">Email Address</label>
                <input type="text" name="email" id="email" placeholder="Email" />
            </div>
        
            <div class="textfield sign_in_textfield">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" />
            </div>
            <div class='error'>
            <?php
            if (isset($is_logined)) {
                if (!$is_logined) {
                    echo 'Wrong Email or password.';
                }
            }
            ?>
            </div>
            <div class='sign_clear_button'>
                <div><button type="submit">Sign In</button></div>
                <div><button type="reset" onclick="return resetError();">Clear</button></div>
            </div>
        </form>
        <div class='sign_up_button'>
            <a href="./sign_up.php">
                <button>Sign Up</button>
            </a>
        </div>
    </div>
</main>
<?php include('footer.php') ?>