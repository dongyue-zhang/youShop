<?php 
session_start();

require_once('database.php');
$page_title = 'Search Results';

if (isset($_GET['search_category'])) {
    $sql = "SELECT * FROM product ";
    $category = $_GET['search_category'];
    $keyword = $_GET['search_keyword'];
    if ($category !== "all") {
        $sql .= "WHERE category = '$category';";
    }
    $db = db_connect();
    $result_set = mysqli_query($db, $sql);
    $results = array();
    
    while ($result = mysqli_fetch_assoc($result_set)) {
        if ($keyword != '') {
            if (stripos($result['name'], $keyword) !== false) {
                array_push($results, $result);
            }
        } else {
            array_push($results, $result);
        }
    }
    mysqli_close($db);
}

include('header.php');
?>

<?php 
if ($results != []) { ?>
    <h2 style='margin: 2%'><?php echo count($results)?> results found: </h2>
    <div id="item_list">
    <?php
    foreach($results as $result) {?>
        <div class='item_container'>
            <div class='item_img_name'>
                <a href="<?php echo "./detail.php?id=". $result['product_id']; ?>">
                    <img src="<?php echo $result['img_src']; ?>" class='item_img'>
                    <div class='item_name'><?php echo $result['name']; ?></div>
                </a>
            </div>
            <div class='item_price'>
                <span class='dollar_sign'>$</span>
                <span class='item_price_whole'><?php echo explode(".", $result['price'])[0]; ?></span>
                <span class='item_price_fraction'><?php echo explode(".", $result['price'])[1]; ?></span>
            </div>
        </div>
    <?php } ?>
    </div>
<?php } else {?>
    <h2 style='margin: 2rem 5rem 0'>
        Sorry, 0 result found.
    </h2>
<?php } ?>
</main>
<?php include('footer.php') ?>
    
