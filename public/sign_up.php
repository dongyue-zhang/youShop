<?php 
require_once('database.php');
$page_title = 'Sign Up';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $new_phonenumber = $_POST['phonenumber'];
    if ($_POST['street'] == '') {
        $new_street = "NULL";
    } else {
        $new_street = $_POST['street'];
    }
    if ($_POST['city'] == '') {
        $new_city = "NULL";
    } else {
        $new_city = $_POST['city'];
    }
    if ($_POST['province'] == '') {
        $new_province = "NULL";
    } else {
        $new_province = $_POST['province'];
    }

    $new_city = $_POST['city'];
    $new_province  = $_POST['province'];
    $new_postalcode = $_POST['postalcode'];
    $db = db_connect();
    $sql_accounts = "SELECT email FROM users;";
    $result_set_accounts = mysqli_query($db, $sql_accounts);
    $is_existed = 0;
    while($account = mysqli_fetch_assoc($result_set_accounts)) {
        if ($account['email'] == $new_email) {
            $is_existed = 1;
        }
    }
    if ($is_existed == 0) {
        $sql_create_new_account = "INSERT INTO users (username, email, password, phonenumber, street, city, province, postalcode)VALUES ('$new_username', '$new_email', '$new_password', '$new_phonenumber', '$new_street', '$new_city', '$new_province', '$new_postalcode')";
    
        $result_set = mysqli_query($db, $sql_create_new_account);
        if ($result_set) {
            $is_signed_up = 1;
            header('Location: ./after_sign_up.php');
        } else {
            $is_signed_up = 0;
        }
    }
}

include("header.php"); 
?>

<div class="form">
    <form action="sign_up.php" method="post" onsubmit="return validate(event);">
        <h2 style='text-align: center'>Finally you're here!</h2>
        <fieldset>
            <legend>Account</legend>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label class="required" for="email" >Email Address:</label>
                    <input class="margin-right" type="text" name="email" id="email" placeholder="myname@email.com">
                </div>
                <div class="error"></div>
            </div>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label class="required" for="username" >User Name:</label>
                    <input class="margin-right" type="text" name="username" id="username" placeholder="username">
                </div>
                <div class="error"></div>
            </div>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label for="password" class="required">Password:</label>
                    <input class="margin-right" type="password" name="password" id="password" placeholder="Password" >
                </div>
                <div class="error"></div>
            </div>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label class="required" for="password2" >Re-type Password:</label>
                    <input class="margin-right" type="password" id="password2" placeholder="Password" >
                </div>
                <div class="error"></div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Shipping information</legend>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label class="required" for="phonenumber" >Phone Number:</label>
                    <input class="margin-right" type="tel" id="phonenumber" name="phonenumber" placeholder="123-456-7890">
                </div>
                <div class="error"></div>
            </div>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label for="street">Street:&nbsp;&nbsp;</label>
                    <input class="margin-right" type="text" id="street" name="street" placeholder="123 Street" >
                </div>
                <div class="error"></div>
            </div>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label for="city">City:&nbsp;&nbsp;</label>
                    <input class="margin-right" type="text" id="city" name="city" placeholder="City">
                </div>
                <div class="error"></div>
            </div>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label for="province">Province:&nbsp;&nbsp;</label>
                    <input class="margin-right" type="text" id="province" name="province" placeholder="Province">
                </div>
                <div class="error"></div>
            </div>
            <div class="textfield">
                <div class="flex-row text-align-right textfield_label_input">
                    <label for="postalcode" class="required">Postal Code:</label>
                    <input class="margin-right" type="text" id="postalcode" name='postalcode' placeholder="A1B2C3">
                </div>
                <div class="error"></div>
            </div>
        </fieldset>
        <div class="error">
        <?php
        if (isset($is_existed)) {
            if ($is_existed == 1) {
                $err_msg = "Account already exists. Please sign in.";
                } else if ($is_signed_up == 0){
                $err_msg = "Failed to sign up. Please try again.";
                }
                echo $err_msg;
                echo '<script type="text/javascript">', "window.scrollTo(0,document.body.scrollHeight);", '</script>';
        }?>
        </div>
        <div class='sign_clear_button'>
            <div><button type="submit">Sign Up</button></div>
            <div><button type="reset" onclick="return resetError();">Clear</button></div>
        </div>
    </form>
    <div class='sign_up_button'>
        <a href="sign_in.php"><button>Sign In</button></a>
    </div>
</div>
</main>
<script src='sign_up.js'></script>
<?php include('footer.php') ?>