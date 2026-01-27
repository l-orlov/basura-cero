<?php
$con = DBconnect();

function DBconnect() {
    $config_file = __DIR__ . '/config/config.php';

    if (!file_exists($config_file)) {
        die("Error: Configuration file not found.");
    }

    $config = require $config_file;

    if (!isset($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_database'], $config['db_port'])) {
        die("Error: The configuration file is corrupted or incomplete.");
    }
    // Connect to MySQL with port
    $con = mysqli_connect(
        $config['db_host'], 
        $config['db_user'], 
        $config['db_pass'],
        $config['db_database'], 
        $config['db_port']
    );

    // Check connection
    if (!$con) {
        die("Unable to establish a DB connection: " . mysqli_connect_error());
    }

    mysqli_set_charset($con, "utf8");
    return $con;
}

function get_user_info(int $id) {
    global $con;

    $stmt = $con->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $user = $stmt->get_result()
                 ->fetch_assoc();

    return $user;
}

function is_authed() {
    global $con;

    if (isset($_SESSION['user_id'])) {
        return true;
    }

    return false;
}

?>