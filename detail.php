<?php session_start(); 
$page_title = 'Item Details';
require_once('db_credentials.php');
require_once('database.php');
$db = db_connect();
$id = $_GET['id'] ;
$sql = "SELECT * FROM product WHERE product_id = '$id'";

$result_set = mysqli_query($db, $sql);
$result = mysqli_fetch_assoc($result_set);
mysqli_close($db);

?>
<?php include('header.php') ?>
<div class='detail'>
    <div class='detail_item'>
        <div class='detail_item_img_container'>
            <img class='detail_item_img' src='<?php echo $result['img_src']?>'>
        </div>
        <form  action='cart.php' method='get'>
            <div class='detail_item_name'>
                <?php echo $result['name']?>
                <input type='hidden' name='product' value='<?php echo $result['product_id']?>' />
            </div>
            <div class='detail_item_info'>
                <div class='item_price'>
                    <span class='dollar_sign'>$</span>
                    <span class='item_price_whole'><?php echo explode(".", $result['price'])[0]; ?></span>
                    <span class='item_price_fraction'><?php echo explode(".", $result['price'])[1]; ?></span>
                </div>
                <div class='detail_item_bref'>
                    <div>
                        <label>Brand: </label>
                        <span><?php echo $result['maker']?></span>
                    </div>
                    <div>
                        <label>Model: </label>
                        <span><?php echo $result['model']?></span>
                    </div>
                    <div>
                        <label>Color: </label>
                        <span><?php echo $result['color']?></span>
                    </div>
                    <div>
                        <label>Resolution: </label>
                        <span><?php echo $result['resolution']?></span>
                    </div>
                    <div>
                        <label>Display: </label>
                        <span><?php echo $result['display']?></span>
                    </div>
                    <div>
                        <label>Screen size: </label>
                        <span><?php echo $result['size']?></span>
                    </div>
                </div>
                <div class='item_qty'>
                    <label>Quantity: </label>
                    <select name='qty'>
                        <?php
                            for ($i = 0; $i < 10; $i++) { ?>
                                <option value="<?php echo $i+1; ?>"><?php echo $i+1;?></option>
                            <?php } ?>
                    </select>
                </div>
    
            </div>
            <div class='add_to_cart_button'>
                <button type='onsubmit'>
                        Add to Cart
                    </button>
            </div>
        </form>
        </div>
    <div class='detail_info'>
        <h2>More information</h2>
        <?php
        if (strpos($result['detail'], "##") !== false) {
            $sections = explode("##", $result['detail']);
            foreach($sections as $section) {
                $subtitle = explode("$$", $section)[0];
                $section = explode("$$", $section)[1];
        ?>
        <div class='detail_info_sub'><?php echo $subtitle ?></div>
        <ul class='detail_info_ul'>
        <?php
            foreach(explode(">>", $section) as $li) { ?>
            <li>
                <?php echo "$li";?>
            </li>
        <?php } ?>
        </ul>
        <?php  } } else {
            $section = $result['detail'];
        ?>
        <ul class='detail_info_ul'>
        <?php
            foreach(explode(">>", $section) as $li) {
                ?>
            <li>
                <?php echo "$li";?>
            </li>
        <?php } ?>
        </ul>
        <?php } ?>
    </div>
</div>
</main>
<?php include('footer.php') ?>