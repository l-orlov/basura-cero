<?php
require "../functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    header('Content-Type: application/json');

    $is_success = login($phone, $password);

    if ($is_success) {
        echo json_encode([
            'success' => true, 
            'redirect' => '?page=user'
        ]);
    } else {
        echo "TODO: login failure";
    }
}
?>