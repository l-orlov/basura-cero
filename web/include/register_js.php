<?php
require "functions.php";
session_start();

function register(array $data): bool {
    global $con;

    // Required fields and defaults
    $required = ['name', 'surname', 'document', 'phone', 'address', 'password'];

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
    $password = $data['password'];

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw, true);

    header('Content-Type: application/json');

    $is_success = register($body);

    if ($is_success) {
        echo json_encode([
            'success' => true, 
            'redirect' => '?page=user'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'redirect' => NULL
        ]);
    }
}

?>