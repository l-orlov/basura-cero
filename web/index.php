<?
require "include/functions.php";
session_start(); 

$is_authorized = is_authed();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Basura Cero</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/user.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
<body>

<?
$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : '';

if ($is_authorized) {
    include "include/user.php";
} else {
    SWITCH ( $page ) {
        case 'register':	include "include/register.php";        break;
        case 'login':
        default:			include "include/login.php";
    }
}

?>

</body>
</html>