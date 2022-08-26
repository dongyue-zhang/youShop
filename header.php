<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dongyue Zhang">
    <meta name="date" content="2022-07-26">
    <link rel="stylesheet" href="./assignment2.css">
    <script src="./assignment2.js" defer></script>
    <title> youShop - <?php echo $page_title; ?> </title>  
</head>
<body>
    <header>
        <div id='logo'>youShop</div>
        <form method="get" action="./search.php" id='search_form'>
            <div id='search_bar'>
                <div id="search_category">
                    <select name="search_category">
                        <option value="all">All</option>
                        <option value="tv">TV</option>
                        <option value="laptop">Laptop</option>
                        <option value="phone">Phone</option>
                    </select>
                </div>
                <div class='search_input_container'><input type="text" name="search_keyword" ></div>
                <div class='search_button_container'>
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-search" viewBox="0 0 17 17">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        <div id='account_cart'>
            <div id="login_username">
                <?php
                    if (isset($_SESSION["username"])) { ?>
                        <div class='dropdown login_username' data-dropdown>
                                <svg data-dropdown-button xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 17 17">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <div id="dropdown-nav" data-dropdown-button>
                            <?php echo $_SESSION["username"]; ?></div>
                            <div class='dropdown-content'>
                                <div class='dropdown-item'><a href="myacount.php?id=<?php echo $_SESSION['user_id'] ?>">My Acount</a></div>
                                <hr>
                                <div class='dropdown-item'><a href="logedout.php">Logout</a></div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <a href='sign_in.php'>
                        <div class='login_username sign_in'>
                            
                                <div style='display: flex; align-items: center;'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                </div>
                                <div>Sign in/up</div>
                        </div>
                        </a>
                    <?php } ?>
            </div>
            
                <a href="./cart.php">
                <div id="cart">
                    <div>
                        <?php
                            if (isset($_SESSION['cart'])) {
                                echo $_SESSION['count'];
                            } else {
                                echo 0;
                            }
                        ?>
                    </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                        </div>
                    </div>
                </a>
        </div>
    </header>
        <div id='nav-bar'>
            <div><a href="index.php">Phone</a></div>
            <div><a href="laptop.php">Laptop</a></div>
            <div><a href="tv.php">TV</a></div>
        </div>
        <main>
