<?php 
session_start();
require_once('db_credentials.php');
require_once('database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_get_user = "SELECT * FROM users WHERE user_id ='$id';";
    $db = db_connect();
    $result_set_user = mysqli_query($db, $sql_get_user);
    $result_account = mysqli_fetch_assoc($result_set_user);
    
    $sql_get_orders = "SELECT product_id, quantity, order_date FROM orders WHERE user_id = '$id';";
    $result_set_orders = mysqli_query($db, $sql_get_orders);
    
    function find_product_id($orders_products, $product_id) {
        $index = -1;
        if (count($orders_products) !== 0 ) {
            for ($i = 0; $i < count($orders_products); $i++) {
                if ($orders_products[$i]['product_id'] === $product_id) {
                    $index = $i;
                }
            }
        }
        return $index;
    }
    $orders_products = array();
    while ($result_order = mysqli_fetch_assoc($result_set_orders)) {
        $product_id = $result_order['product_id'];
        $index = find_product_id($orders_products, $product_id);
        if ( $index === -1) {
            $order_product['quantity'] = $result_order['quantity'];
            $order_product['order_date'] = $result_order['order_date'];
            $sql_get_product = "SELECT product_id, name, price, img_src FROM product WHERE product_id = '$product_id';";
            $result_set_product = mysqli_query($db, $sql_get_product);
            $result_product = mysqli_fetch_assoc($result_set_product);
            $order_product['product_id'] = $result_product['product_id'];
            $order_product['name'] = $result_product['name'];
            $order_product['price'] = $result_product['price'];
            $order_product['img_src'] = $result_product['img_src'];
            array_push($orders_products, $order_product);
        } else {
            $orders_products[$index]['quantity'] ++;
        }
    }

    mysqli_close($db);
}
$page_title = 'My Account'.' - '.$_SESSION['username'];
include('header.php');
?>

<div>
    <div class='account_information'>
        <h2>Account information</h2>
        <div class='account_information'>
            <div class="textfield">
                <label for="email" class="">Email Address</label>
                <input type="text" name="email" id='email' value='<?php echo $result_account['email']?>' readonly>
            </div>
            <div class="textfield">
                <label for="username" class="">User Name</label>
                <input type="text" name="username" id='username' value='<?php echo $result_account['username']?>' readonly>
            </div>
            <div class="textfield">
                <label for="phonenumber" class="">Phone Number:</label>
                <input type="tel" name="phonenumber" id='phonenumber' value='<?php echo $result_account['phonenumber']?>' readonly>
            </div>
            <div class="textfield">
                <label for="street">Street:</label>
                <input type="text"name="street" id='street' value='<?php echo $result_account['street']?>'readonly>
            </div>
            <div class="textfield">
                <label for="city">City:</label>
                <input type="text"name="city" id='city' value='<?php echo $result_account['city']?>' readonly>
            </div>
            <div class="textfield">
                <label for="province">Province:</label>
                <input type="text" name="province" id='province' value='<?php echo $result_account['province']?>' readonly>
            </div>
            <div class="textfield">
                <label for="postalcode" class="">Postal Code:</label>
                <input type="text" name='postalcode' id='postalcode' value='<?php echo $result_account['postalcode']?>' readonly>
            </div>
        </div>
        <h2>Your orders</h2>
        <?php 
        if ($orders_products !== array()) { ?>
            <div id="order_list">
            <?php foreach($orders_products as $order_product) {?>
                <div class='order_container'>
                    <div class='order_img_container'>
                        <a href="<?php echo "./detail.php?id=". $order_product['product_id']; ?>">
                            <img src="<?php echo $order_product['img_src']; ?>" class='order_img'>
                        </a>
                    </div>
                    <div class='order_info'>
                        <div class='order_name_subtotal'>
                            <a href="<?php echo "./detail.php?id=". $order_product['product_id']; ?>">
                                <div class='order_name'><?php echo $order_product['name']; ?></div>
                            </a>
                            
                        
                        <div class='order_price'>Unit price: $<?php echo $order_product['price']; ?></div>
                        <div class='order_quantity'>Quantity: <?php echo $order_product['quantity']; ?></div>
                        <div class='order_subtotal'>Subtotal: $<?php echo $order_product['price'] * $order_product['quantity']; ?></div>
                        <div class='order_date'>Oreder Date: <?php echo $order_product['order_date']; ?></div> 
                        </div>
                    </div>
                </div>
            <?php } } else { ?>
            <h2>You haven't ordered anything yet.</h2>
        <?php } ?>
    </div>
</div>

</main>

<?php include('footer.php') ?>