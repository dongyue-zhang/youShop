<?php 
session_start();
$page_title = 'Checkout';
include('header.php'); 
?>
<div class='form'>
    <h2>
        Your orders have been placed.
    </h2>
    <a href="./index.php">
        <button>Order more</button>
    </a>
</div>
</main>
<?php include('footer.php') ?>