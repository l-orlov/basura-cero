<div class="screen login background">
    <div class="container">
        <div class="logo">
            <img src="img/logo.png" alt="Basura Cero" style="width: 180px;">
        </div>

        <form action="">
            <label for="phone">Ingrese su Numero de Teléfono:</label>
            <div class="icon-input">
                <img src="img/ico/phone.svg">
                <input
                    required
                    type="tel" 
                    name="phone" 
                    id="phone" 
                    inputmode="tel" 
                    autocomplete="tel"
                    placeholder="54 611 6462 4836"
                />
            </div>

            <label for="password">Ingrese su Contraseña:</label>
            <div class="icon-input">
                <img src="img/ico/key.svg">
                <input 
                    required
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password" 
                />
            </div>
            <div class="misc">
                <a href="/?page=register">Registrar nuevo</a>
                <a href="#">Me olvidé la contraseña</a>
            </div>

            <div class="btn-container">
                <button type="submit" class="wide">Iniciar sesión</button>
            </div>
        </form>
    </div>
</div>