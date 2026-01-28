<?
$user = get_user_info($_SESSION['user_id']);
?>
<div class="screen">
<?include __ROOT__ . '/include/header.php'?>

<div class="main content" id="dashboard_main">
    <div class="tab home">
        <div class="balance">
            <div class="info">
                <h1>Saldo disponible:</h1>
                <button 
                    class="transparent" 
                    data-shown="false" 
                    id="toggle_balance"
                    onclick="toggleBalance()"
                >
                    <img src="img/ico/eye/open.svg" alt="Toggle">
                </button>
            </div>
            <div class="content">
                <img src="img/balance.svg" style="width: 140px;">

                <div class="group">
                    <div class="bars">
                        <div class="bar">
                            <h1>Puntos:</h1>
                            <span>
                                <sub>p</sub><p id="p_points">******</p>
                            </span>
                        </div>
                        <div class="bar">
                            <h1>Pesos AR:</h1>
                            <span>
                                <sub>$</sub><p id="p_money">******</p>
                            </span>
                        </div>
                    </div>
                    <div class="btn-container">
                        <a href="?tab=balance" class="tab-link">
                            <button>Ver más</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="buttons">
            <button class="wide">
                <img src="img/ico/message.svg">
                <h1>Contactar con soporte</h1>
            </button>
            <button class="wide">
                <img src="img/ico/trash.svg">
                <h1>Retirar mis residuos</h1>
            </button>
        </div>
    </div>

    <div class="tab balance hidden">
        <div class="balance">
            <div class="info">
                <h1>Saldo disponible:</h1>
            </div>
            <div class="content">
                <img src="img/balance.svg" style="width: 140px;">
                <div class="group">
                    <div class="bars">
                        <div class="bar">
                            <h1>Puntos:</h1>
                            <span>
                                <sub>p</sub><p id="points">120</p>
                            </span>
                        </div>
                        <div class="bar">
                            <h1>Pesos AR:</h1>
                            <span>
                                <sub>$</sub><p id="money">195000</p>
                            </span>
                        </div>
                        <div class="bar">
                            <span>
                                <p>1 punto = 1500 ARS</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="buttons">
            <button class="wide">
                <img src="img/ico/box/in.svg">
                <h1>Ingresar puntos</h1>
            </button>
            <button class="wide">
                <img src="img/ico/box/up.svg">
                <h1>Retirar puntos</h1>
            </button>
        </div>
        <div class="notifications" id="balance_notifications">
            <div class="notification">
                <div class="icon">
                    <img src="img/ico/box/up-black.svg">
                </div>
                <div class="content">
                    <h1>Puntos retirados</h1>
                    <span>
                        <p class="date">20/01/26</p>
                        <p class="body">Retiro de 200 puntos</p>
                    </span>
                </div>
                <div class="date">
                    <p>14:55</p>
                </div>
            </div>
        </div>
        <div class="btn-container" id="show_more_button">
            <button class="shadow">Ver más</button>
        </div>
    </div>

    <div class="tab qr hidden">
        <div class="header">
            <h1>Escaneá el código QR</h1>
            <p>para obtener información</p>
        </div>
        <div class="qr">
            <img src="img/qr.png">
        </div>
    </div>

    <div class="tab notifications hidden">
        <div class="notifications">
            <div class="notification">
                <div class="icon">
                    <img src="img/ico/trash/cross.svg">
                </div>
                <div class="content">
                    <h1>Error de clasificación</h1>
                    <span>
                        <p class="body">Clasificación incorrecta... <a href="#">ver más</a></p>
                    </span>
                </div>
                <div class="date">
                    <p>14:55</p>
                </div>
            </div>
            <div class="notification">
                <div class="icon">
                    <img src="img/ico/trash/tick.svg">
                </div>
                <div class="content">
                    <h1>Residuos aceptados</h1>
                    <span>
                        <p class="body">Tus residuos fueron entregados en la planta</p>
                    </span>
                </div>
                <div class="date">
                    <p>14:52</p>
                </div>
            </div>
            <div class="notification">
                <div class="icon">
                    <img src="img/ico/trash/done.svg">
                </div>
                <div class="content">
                    <h1>Residuos retirados</h1>
                    <span>
                        <p class="body">Tus residuos están en proceso de traslado</p>
                    </span>
                </div>
                <div class="date">
                    <p>13:44</p>
                </div>
            </div>
        </div>
    </div>

    <div class="tab info hidden">
        <div class="status">
            <div class="indicator">
                <img src="img/ico/user-white.svg">
                <h1>Datos personales</h1>
            </div>
            <div class="language">
                <img src="img/ico/earth.svg">
                <h1>ESP</h1>
            </div>
        </div>

       <div class="view">
            <div class="fake-form">
                <h1>Datos Personales:</h1>
                <input id="name" required type="text" minlength="1" maxlength="50" placeholder="Nombre" value="<?php echo $user['name']; ?>">
                <input id="surname" required type="text" minlength="1" maxlength="50" placeholder="Apellido" value="<?php echo $user['surname']; ?>">
                <input id="document" required type="text" minlength="1" maxlength="50" placeholder="DNI/Pasaporte" value="<?php echo $user['document']; ?>">

                <h1>Teléfono:</h1>
                <div class="input-button">
                    <input id="phone" type="text" placeholder="xx x xx xxxxxxxx" value="<?php echo $user['phone']; ?>">
                    <button class="shadow">Enviar</button>
                </div>

                <input id="whatsapp_code" required type="text" minlength="1" maxlength="10" placeholder="Código de validación enviado por WhatsApp">

                <h1>Email:</h1>
                <div class="input-button">
                    <input id="email" type="text" placeholder="Email">
                    <button class="shadow">Enviar</button>
                </div>
                <input id="email_code" required type="text" minlength="1" maxlength="10" placeholder="Código de validación enviado por correo">

                <h1>Seguridad:</h1>
                <input id="password" required type="password" minlength="1" maxlength="50" placeholder="Ingrese la contraseña">
                <div class="input-button">
                    <input id="confirm_password" required type="password" minlength="1" maxlength="50" placeholder="Confirme la contraseña">
                    <button class="shadow">Cambiar</button>
                </div>

                <h1>Dirección:</h1>
                <input id="address" required type="text" minlength="1" maxlength="50" placeholder="Dirección" value="<?php echo $user['address']; ?>">
                <input id="floor" required type="text" minlength="1" maxlength="50" placeholder="Piso" value="<?php echo $user['floor']; ?>">
            </div>
        </div>

        <button class="wide shadow" id="update_data_button">Guardar datos</button>
    </div>

</div>

<?include __ROOT__ . '/include/navbar.php'?>
</div>
<script src="js/dashboard.js"></script>