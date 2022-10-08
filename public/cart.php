<?php session_start(); 
$page_title = 'Shopping Cart';

require_once('database.php');
// $_SESSION = array();
if (isset($_GET['product'])) {
    $product_id = $_GET['product'];
    if (!isset($_SESSION['username'])) {
        header('Location: sign_in.php');
    } else {
        if (array_search($product_id, $_SESSION['name']) !== false) {
            $index = array_search($product_id, $_SESSION['name']);
            $_SESSION['qty'][$index] += $_GET['qty'];
            $_SESSION['subtotal'][$index] = $_SESSION['price'][$index] * $_SESSION['qty'][$index];
            $_SESSION['count'] += $_GET['qty'];
        } else {
            $db = db_connect();
            $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
            $result_set = mysqli_query($db, $sql); 
            $result = mysqli_fetch_assoc($result_set);
            mysqli_close($db);
            $_SESSION['cart'][$_SESSION['count']] = $result['product_id'];
            $_SESSION['name'][$_SESSION['count']] = $result['name'];
            $_SESSION['img'][$_SESSION['count']] = $result['img_src'];
            $_SESSION['qty'][$_SESSION['count']] = $_GET['qty'];
            $_SESSION['price'][$_SESSION['count']] = $result['price'];
            $_SESSION['subtotal'][$_SESSION['count']] = $_SESSION['price'][$_SESSION['count']] * $_SESSION['qty'][$_SESSION['count']];
            $_SESSION['count'] += $_GET['qty'];
        }
        header('Location: ./cart.php');
    }

}
if ( isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    $index_to_delete = array_search($id_to_delete, $_SESSION['cart']);
    array_splice($_SESSION['cart'], $index_to_delete, 1); 
    // unset($_SESSION['cart'][$index_to_delete]);
    array_splice($_SESSION['name'], $index_to_delete, 1);

    array_splice($_SESSION['img'], $index_to_delete, 1);
    $_SESSION['count'] -= $_SESSION['qty'][$index_to_delete];
    array_splice($_SESSION['qty'], $index_to_delete, 1);
    array_splice($_SESSION['price'], $index_to_delete, 1);
    array_splice($_SESSION['subtotal'], $index_to_delete, 1);
    header('Location: ./cart.php');
}


if ( isset($_GET['checkout']) ) {
    if ($_GET['checkout'] == true) {
        $insert_result = 0;
        $db = db_connect();
        for($i = 0; $i < count($_SESSION['cart']); $i++) {
            $sql = "INSERT INTO orders (user_id, quantity, product_id) VALUES(".$_SESSION['user_id'].','.$_SESSION['qty'][$i].",'".$_SESSION['cart'][$i]."');";
            $insert_result += mysqli_query($db, $sql);
        }
        print_r($insert_result);
    }
    if ($insert_result == count($_SESSION['cart'])) {
        mysqli_close($db);
        $_SESSION['cart'] = [];
        $_SESSION['name'] = [];
        $_SESSION['img'] = [];
        $_SESSION['qty'] = [];
        $_SESSION['subtotal'] = [];
        $_SESSION['count'] = 0;
        header('Location: ./after_checkout.php');
    }
}
?>
<?php 
include('header.php');

if ( $_SESSION !== array() && count($_SESSION['cart']) !== 0 ) {?>
    <div class="account_information">
        <!-- <div class='cart_sum'> -->
            <div class='cart_total'>
                <h2>
                    Total: $<?php
                    $total = 0;
                    foreach($_SESSION['subtotal'] as $subttl) {
                    $total += $subttl; }
                    echo $total;?>
                </h2>
            <!-- </div> -->
        </div>
        <div id="order_list">
        <?php
        for($i = 0; $i < count($_SESSION['cart']); $i++) { ?>
            <div class='order_container'>
                <div class="order_img_container">
                    <a href="<?php echo "./detail.php?id=". $_SESSION['product_id'][$i]; ?>">
                        <img class="order_img" src="<?php echo $_SESSION['img'][$i] ?>" alt="">
                    </a>
                </div>
                <div class='order_info'>
                    <div class='order_name_subtotal'>
                        <div class='order_name'>
                            <?php echo $_SESSION['name'][$i]?>
                        </div>
                        <!-- <div class='order_subtotal'>
                        
                            <?php echo $_SESSION['subtotal'][$i]?>
                        </div> -->
                    </div>
                    <!-- <div class='order_price'>
                        Price: $<?php echo $_SESSION['price'][$i]?>
                    </div>  -->
                    <div class='order_quantity'>
                        Qty: <?php echo $_SESSION['qty'][$i]?>
                    </div>
                    <div class='order_subtotal item_price'>
                            <span class='dollar_sign'>$</span>
                            <span class='item_price_whole'><?php echo explode(".", $_SESSION['subtotal'][$i])[0]; ?></span>
                            <span class='item_price_fraction'><?php echo explode(".", $_SESSION['subtotal'][$i])[1]; ?></span>
                        </div>
                    <div><a href="?delete='<?php echo $_SESSION['cart'][$i]?>'"><button class="delete_button">Delete</button></a></div>
                </div>
            </div>
        <?php } ?>
        </div>
        <div class='add_to_cart_button text-align-right margin-right'>
            <a href="?checkout=true">
                <button >Checkout</button>
            </a>
        </div>
    </div>
<?php } else if (! isset($_SESSION)) {


}

else { ?>
    <div class='form'>
        <h2>Your shopping cart is empty.</h2>
        <div>
            <a href="./index.php"><button>Order more</button></a>
            <a href="./sign_in.php"><button>Sign in/up</button></a>
        </div>
    </div>
    <?php } ?>       
</main>
<?php include('footer.php') ?>