<?php 
session_start();
$_SESSION = array(); 
$page_title = 'Logout';
include('header.php');
?>

<div class="form">
    <h2>
        You have logged out.
    </h2>
    <button>
        <a href='sign_in.php'>Sign in</a>
    </button>
</div>
</main>
<?php include('footer.php') ?>