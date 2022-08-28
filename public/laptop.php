<?php 
session_start(); 
require_once('database.php');
$page_title = 'Laptops';

$db = db_connect(); 
$sql = "SELECT * FROM product ";
$sql_laptop = $sql."WHERE category = 'laptop'";
$result_set_laptop = mysqli_query($db, $sql_laptop);
include('header.php');
?>

<div id="item_list">
    <?php while($results_laptop = mysqli_fetch_assoc($result_set_laptop)) {?>
    <div class='item_container'>
        <div class='item_img_name'>
            <a href="<?php echo "./detail.php?id=". $results_laptop['product_id']; ?>">
                <img src="<?php echo "../" . $results_laptop['img_src']; ?>" class='item_img' alt="<?php echo $results_laptop['name'] ?>">
                <div class='item_name'><?php echo $results_laptop['name']; ?></div>
            </a>
        </div>
        <div class='item_price'>
            <span class='dollar_sign'>$</span>
            <span class='item_price_whole'><?php echo explode(".", $results_laptop['price'])[0]; ?></span>
            <span class='item_price_fraction'><?php echo explode(".", $results_laptop['price'])[1]; ?></span>
        </div>
    </div>
    <?php }
        mysqli_close($db);
    ?>
</div>
</main>
<?php include('footer.php') ?>