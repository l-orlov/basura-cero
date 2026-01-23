<div class="screen">
<?include 'header.php'?>

<div class="register">
    <div class="view">
        <div class="steps" id="step_indicators">
            <div class="step">
                <div class="circle">1</div>
                <div class="comment">
                    <p>Datos personales</p>
                </div>
            </div>

            <div class="dot-container">
                <div class="dot"></div>
            </div>
            
            <div class="step">
                <div class="circle">2</div>
                <div class="comment">
                    <p>Agregar contacto</p>
                </div>
            </div>

            <div class="dot-container">
                <div class="dot"></div>
            </div>

            <div class="step">
                <div class="circle">3</div>
                <div class="comment">
                    <p>Validar WhatsApp</p>
                </div>
            </div>

            <div class="dot-container">
                <div class="dot"></div>
            </div>

            <div class="step">
                <div class="circle">4</div>
                <div class="comment">
                    <p>Crear contraseña</p>
                </div>
            </div>

            <div class="dot-container">
                <div class="dot"></div>
            </div>
            
            <div class="step">
                <div class="circle">5</div>
                <div class="comment">
                    <p>Ingresar dirección</p>
                </div>
            </div>
        </div>
        <div class="controls">
            <button class="neutral" id="btn_prev"
                onclick="prevActiveStep()">
                <img src="img/ico/arrow/left.svg">
                Volver
            </button>

            <button class="neutral" id="btn_next"
                onclick="nextActiveStep()">
                Seguir
                <img src="img/ico/arrow/right.svg">
            </button>
        </div>
        <form id="personal_data">
            <div class="content">
                <h1>Datos Personales:</h1>
                    <input id="register_name" required type="text" minlength="1" maxlength="50" placeholder="Nombre">
                    <input id="register_surname" required type="text" minlength="1" maxlength="50" placeholder="Apellido">
                    <input id="register_document" required type="text" minlength="1" maxlength="50" placeholder="DNI/Pasaporte">
                <p class="comment">
                    Al confirmar el registro, acepto <a href="#">el acuerdo de usuario</a> de timbraMe24.
                </p>
            </div>

            <div class="content hidden">
                <h1>Agregar Contacto:</h1>
                <button class="wide">Agregar timbraMe24 a los contactos</button>
                <p class="comment">
                    Se agregará el contacto de timbraMe24 a su listo de contactos en el smartphone.
                </p>
            </div>

            <div class="content hidden">
                <h1>Validar WhatsApp:</h1>

                <div class="input-button">
                    <input id="register_phone" type="tel" placeholder="xx x xx xxxxxxxx">
                    <button type="button">Enviar</button>
                </div>

                <p class="comment hidden">
                    Ingrese el número de su WhatsApp en formato internacional (ej.: 54 9 11 55554444, sin el símbolo “+”), presione la tecla “Enviar” y siga las instrucciones que recibirá en su cuenta de WhatsApp.
                </p>
            </div>

            <div class="content hidden">
                <h1>Seguridad:</h1>
                <input required id="register_password" type="password" minlength="1" maxlength="50" placeholder="Ingrese la contraseña">
                <input required id="register_password_confirm" type="password" minlength="1" maxlength="50" placeholder="Confirme la contraseña">
            </div>


            <div class="content hidden">
                <h1>Dirección:</h1>

                <input required id="register_address_1" type="text" minlength="1" maxlength="20" placeholder="Ingrese su dirección">
                <p class="comment">
                    Ingrese la calle con altura. En la lista que aparezca seleccione su dirección correspondiente completa.
                </p>
                <input required id="register_address_2" type="text" minlength="1" maxlength="20" placeholder="Dirección completa">
                <input required id="register_address_3" type="text" minlength="1" maxlength="10" placeholder="Número de departamento">

                <h2>Si tiene un código promocional, ingréselo aquí:</h2>
                <input type="text" minlength="1" maxlength="50" placeholder="Código promocional">
                <button type="button" class="wide" onclick="submitRegister()">Guardar datos</button>
            </div>
        </form>
    </div>
</div>
</div>
<script src="js/register.js"></script>