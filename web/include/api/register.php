<?php
require "../functions.php";
session_start();

function register(array $data): bool {
    $con = DBconnect();

    // Required fields and defaults
    $required = ['name', 'surname', 'document', 'phone', 'address', 'floor', 'password'];

    foreach ($required as $key) {
        if (!isset($data[$key]) || $data[$key] === '') {
            return false; 
        }
    }

    $name     = $data['name'];
    $surname  = $data['surname'];
    $document = $data['document'];
    $phone    = $data['phone'];
    $address  = $data['address'];
    $floor    = $data['floor'];
    $password = $data['password'];

    $hashed = hash('sha256', $password);

    $stmt = $con->prepare(
        "INSERT INTO users (name, surname, phone, document, address, floor, password, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, UNIX_TIMESTAMP(), UNIX_TIMESTAMP())"
    );

    $stmt->bind_param("sssssss", $name, $surname, $phone, $document, $address, $floor, $hashed);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw, true);

    $is_success = register($body);
    header('Content-Type: application/json');

    echo json_encode([
        'success' => $is_success, 
    ]);
}

?>