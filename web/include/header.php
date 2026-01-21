<?
    $user_types = ['user', 'admin', 'transporter'];
    $user_types_map = [
        'user' => '<h2>Usuario</h2>',
        'admin' => '<h2>Administrador</h2>',
        'transporter' => '<h2>Transportista</h2>'
    ];

    function get_bool(string $param): ?bool {
        if (!isset($_GET[$param])) {
            return false;
        } 

        $x = strtolower(trim((string)$_GET[$param]));
        
        if ($x === 'true') {
            return true;
        } 
        
        return false;
    }

    // Here should be normal verification later
    $user_type = 'user';
    $user_type_html = $user_types_map[$user_type] ?? $user_types_map['user'];
    
    // $user_type = $_GET['user_type'] ?? '';

    // if (!in_array($user_type, $allowed, true)) {
    //     $user_type = '';
    // }

    $is_authed = get_bool("is_authed");
?>

<?php if ($is_authed): ?>
    <header>
        <div class="container">
            <div class="user">
                <img src="img/ico/user.svg" alt="User">
                <div class="info">
                    <h1>User name</h1>
                    <?php echo $user_type_html; ?>
                </div>
            </div>
            <img src="img/logo.png" alt="Basura Cero" style="width: 90px; height 35px;">
        </div>
    </header>
<?php else: ?>
    <header>
        <div class="container">
            <img src="img/logo.png" alt="Basura Cero" style="width: 90px; height 35px;">
            <button class="neutral">Ingresar</button>
        </div>
    </header>
<?php endif; ?>
