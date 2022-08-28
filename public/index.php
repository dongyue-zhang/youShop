<?php 
session_start();
require_once('database.php');
$page_title = 'Phones';
$db = db_connect();

$sql = "SELECT * FROM product ";
$sql_tv = $sql."WHERE category = 'tv'";
$sql_phone = $sql."WHERE category = 'phone'";
$sql_laptop = $sql."WHERE category = 'laptop'";
$result_set_tv = mysqli_query($db, $sql_tv);
$result_set_phone = mysqli_query($db, $sql_phone);
$result_set_laptop = mysqli_query($db, $sql_laptop);

include('header.php'); 
?>
<div id="item_list">
    <?php while($results_phone = mysqli_fetch_assoc($result_set_phone)) {?>
    <div class='item_container'>
        <div class='item_img_name'>
            <a href="<?php echo "./detail.php?id=". $results_phone['product_id']; ?>">
                <img src="<?php echo "../". $results_phone['img_src']; ?>" class='item_img' alt="<?php echo $results_phone['name']; ?>">
                <div class='item_name'><?php echo $results_phone['name']; ?></div>
            </a>
        </div>
        <div class='item_price'>
            <span class='dollar_sign'>$</span>
            <span class='item_price_whole'><?php echo explode(".", $results_phone['price'])[0]; ?></span>
            <span class='item_price_fraction'><?php echo explode(".", $results_phone['price'])[1]; ?></span>
        </div>
    </div>
    <?php }
        mysqli_close($db);
    ?>
</div>
</main>
<?php include('footer.php') ?>