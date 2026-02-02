<?
require "include/functions.php";
define("__ROOT__", __DIR__);
session_start();

$is_authorized = is_authed();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Basura Cero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/restore_password.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
<body>

<?
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '';

if ($is_authorized) {
    // TODO check user type, based on it return different dashboard
    include "include/dashboard/user.php";
} else {
    SWITCH ( $page ) {
        case 'register':	       include "include/register.php";         break;
        case 'restore-password':   include "include/restore_password.php"; break;
        case 'login':
        default:			       include "include/login.php";
    }
}
?>

</body>
</html>