<?php
require "../functions.php";
session_start();

/*
 * Tries to login user, returns true on success, false otherwise
 * TODO No verification/validation so far
 */
function login(
    string $phone, 
    string $password
) {
    $con = DBconnect();

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

    // Save id to session
    $_SESSION['user_id'] = $user['id'];
    return true;
}

// The POST request handling part goes here 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw, true);

    $is_success = login($body['phone'], $body['password']);

    header('Content-Type: application/json');
    echo json_encode([
        'success' => $is_success, 
    ]);
}
?>