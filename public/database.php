<?php 
    include realpath(__DIR__ . '/../vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
    if(file_exists(dirname(__DIR__, 1) . '/.env')) {
        $dotenv->load();
    }
    

    function db_connect() {
        // $connection = mysqli_connect($_ENV['DB_SERVER'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
        $server = $_ENV["server"];
        $username = $_ENV["user"];
        $password = $_ENV["password"];
        $db = $_ENV["database"];
        $port = $_ENV["port"];
        $connection = mysqli_connect($server, $username, $password, $db, $port);
        confirm_db_connect();
        return $connection;
    }

    function db_disconnect($connection) {
        if(isset($connection)) {
            mysqli_close($connection);
        }
    }

    function confirm_db_connect() {
        if(mysqli_connect_errno()) { //mysqli_connect_errno() return error code
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
    }

    function confirm_result_set($result_set) {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }
?>