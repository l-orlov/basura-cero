<div class="screen">
<?include 'header.php'?>

<div class="restore-password">
    <div class="view" id="firstStep">
        <div id="sendCodeBlock">
            <h1>Número de WhatsApp:</h1>
            <div class="input-button">
                <input 
                    id="restorePhone" 
                    type="tel"
                    required
                    placeholder="xx x xx xxxxxxxx"
                >
                <button type="button" onclick="sendCode()">Enviar</button>
            </div>
            <p class="comment">
                Introduce el número de WhatsApp vinculado a su cuenta para recibir el código de restablecimiento de contraseña.
            </p>
        </div>
        <div class="hidden" id="enterCodeBlock">
             <h1>Introduce el código recibido:<h1>
            <div class="input-button">
                <input 
                    id="restoreCode" 
                    type="tel"
                    required
                >
                <button type="button" onclick="verifyCode()">Verificar</button>
            </div>
            <p class="comment">
                El código de verificación no llegó - <a href="#">reenviar</a>.
            </p>
        </div>
    </div>

    <div class="view hidden" id="secondStep">
        <h1>Seguridad:</h1>
        <input 
            required 
            id="restorePassword" 
            type="password" 
            minlength="1" 
            maxlength="50" 
            placeholder="Ingrese la contraseña"
        >
        <input 
            required 
            id="restorePasswordConfirm" 
            type="password" 
            minlength="1"
            maxlength="50" 
            placeholder="Confirme la contraseña"
        >
        <p id="passwordError"></p>

        <button type="button" class="wide submit" onclick="changePassword()">Guardar datos</button>
    </div>
</div>
</div>

<script src="js/restore_password.js"></script>