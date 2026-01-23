<div class="screen">
<?include 'header.php'?>

<div class="main content">
    <?
    $tab = isset($_GET['tab']) ? htmlspecialchars($_GET['tab']) : '';

    SWITCH ( $tab ) {
        case 'qr':	            include "tabs/qr.php";              break;
        case 'info':            include "tabs/info.php";            break;
        case 'balance':         include "tabs/balance.php";         break;
        case 'notifications':   include "tabs/notifications.php";   break;
        case 'home':
        default:			include "tabs/home.php";
    }
    ?>
</div>

<?include 'footer.php'?>
</div>