<?php 
session_start(); 
require_once('db_credentials.php');
require_once('database.php');
$page_title = 'TVs';

$db = db_connect();
$sql = "SELECT * FROM product ";
$sql_tv = $sql."WHERE category = 'tv'";
$result_set_tv = mysqli_query($db, $sql_tv);

include('header.php'); 
?>
<div id="item_list">
    <?php while($results_tv = mysqli_fetch_assoc($result_set_tv)) {?>
    <div class='item_container'>
        <div class='item_img_name'>
            <a href="<?php echo "./detail.php?id=". $results_tv['product_id']; ?>">
                <img src="<?php echo $results_tv['img_src']; ?>" alt="<?php echo $results_tv['name'] ?>" class='item_img'>
                <div class='item_name'><?php echo $results_tv['name']; ?></div>
            </a>
        </div>
        <div class='item_price'>
            <span class='dollar_sign'>$</span>
            <span class='item_price_whole'><?php echo explode(".", $results_tv['price'])[0]; ?></span>
            <span class='item_price_fraction'><?php echo explode(".", $results_tv['price'])[1]; ?></span>
        </div>
    </div>
    <?php }
        mysqli_close($db);
    ?>
</div>
</main>
<?php include('footer.php') ?>