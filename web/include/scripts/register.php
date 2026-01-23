<?php
require "../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname= $_POST['surname'];
    $document = $_POST['document'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $is_success = register(
        $name,
        $surname,
        $document,
        $phone,
        $address,
        $password
    );

    header('Content-Type: application/json');

    $is_success = login($phone, $password);

    if ($is_success) {
        echo json_encode([
            'success' => true, 
            'redirect' => '?page=user'
        ]);
    } else {
        echo "TODO: register failure";
    }
}

?>