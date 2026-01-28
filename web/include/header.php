<?
    if ($is_authorized) {
        $user = get_user_info($_SESSION['user_id']);
        $user_name_html = '<h1>'.$user['name'].' '.$user['surname'].'</h1>';

        // TODO hardcoded
        $user_type_html = '<h2>Usuario</h2>';
    }
?>

<?php if ($is_authorized): ?>
    <header>
        <div class="container">
            <div class="user">
                <a href="?tab=info" class="tab-link">
                    <div class="notified" data-count="3">
                        <img src="img/ico/user.svg" alt="User">
                    </div>
                </a>
                <div class="info">
                    <?php echo $user_name_html; ?>
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
            <a href="?page=login">
                <button class="neutral">Ingresar</button>
            </a>
        </div>
    </header>
<?php endif; ?>
