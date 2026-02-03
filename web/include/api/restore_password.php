<?php
require "../functions.php";
session_start();

function restore_password(
    string $phone, 
    string $new_password
) {
    $con = DBconnect();

    $hashed = hash('sha256', $new_password);

    $stmt = $con->prepare("UPDATE users SET password = ? WHERE phone = ?");
    $stmt->bind_param("ss", $hashed, $phone);

    if ($stmt->execute()) {
        return $stmt->affected_rows >= 0;
    }

    return false;
}

// The POST request handling part goes here 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw, true);

    $is_success = restore_password($body['phone'], $body['password']);
    header('Content-Type: application/json');

    echo json_encode([
        'success' => $is_success, 
    ]);
}
?>