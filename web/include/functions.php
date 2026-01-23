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

function generate_remember_token(int $user_id) {
    global $con;

    $token = bin2hex(random_bytes(32));
    $stmt = $con->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
    $stmt->bind_param("si", $token, $user_id);
    $stmt->execute();

    return $token;
}

function login(
    string $phone, 
    string $password
) {
    global $con;

    $hashed = hash('sha256', $password);

    $stmt = $con->prepare("SELECT * FROM users WHERE phone = ? AND password = ?");
    $stmt->bind_param("ss", $phone, $hashed);
    $stmt->execute();

    $user = $stmt->get_result()
                 ->fetch_assoc();

    $stmt->close();
    
    if (!$user) {
        return false;
    }

    $token = generate_remember_token($user['id']);
    setcookie(
        'remember_me',
        $token,
        [
            'expires' => time() + 86400 * 30,
            'path'    => '/',
            'secure'  => true,
            'httponly'=> true,
            'samesite'=> 'Lax'
        ]
    );

    $_SESSION['user_id'] = $user['id'];
    return true;
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

function register(
    string $name,
    string $surname,
    string $document,
    string $phone,
    string $address,
    string $password
) {
    global $con;
    // TODO validation, email verification, etc

    $hashed = hash('sha256', $password);

    $stmt = $con->prepare(
        "INSERT INTO users (name, surname, phone, document, address, password, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, UNIX_TIMESTAMP(), UNIX_TIMESTAMP())"
    );

    $stmt->bind_param("ssssss", $name, $surname, $phone, $document, $address, $hashed);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}

function is_authed() {
    global $con;

    if (isset($_SESSION['user_id'])) {
        return true;
    }

    if (!isset($_COOKIE['remember_me'])) {
        return false;
    }

    $token = $_COOKIE['remember_me'];

    $stmt = $con->prepare("SELECT id FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();

    $user = $stmt->get_result()
            ->fetch_assoc();
    
    if ($user) {
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_surname'] = $user['surname'];
        $_SESSION['user_id'] = $user['id'];
        return true;
    }

    return false;
}

?>