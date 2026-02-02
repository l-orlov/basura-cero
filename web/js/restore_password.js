const enterCodeEl = document.getElementById("enterCodeBlock")
const restorePhoneEl = document.getElementById("restorePhone")
const restoreCodeEl = document.getElementById("restoreCode")
const firstStep = document.getElementById("firstStep")
const secondStep = document.getElementById("secondStep")
const restorePassword = document.getElementById("restorePassword")
const restorePasswordConfirm = document.getElementById("restorePasswordConfirm")
const passwordError = document.getElementById("passwordError")

function sendCode() {
    // TODO Make code verification, send to phone etc
    if (restorePhoneEl.reportValidity()) {
        enterCodeEl.classList.remove("hidden")
    }
}

function verifyCode() {
    if (restoreCodeEl.reportValidity()) {
        firstStep.classList.add("hidden")
        secondStep.classList.remove("hidden")
    }
}

function changePassword() {
    restorePassword.reportValidity()
    restorePasswordConfirm.reportValidity()

    const phone = restorePhoneEl.value
    const password = restorePasswordConfirm.value

    if (restorePassword.value !== restorePasswordConfirm.value) {
        passwordError.textContent = "Las contraseñas no coinciden"
        return 
    }

    fetch("include/api/restore_password.php", 
        { method: "POST", body: JSON.stringify({ phone, password }) }
    )
    .then(async (res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`)
        const data = await res.json()

        if (data.redirect) {
            window.location.href = data.redirect
        } else {
            console.log("Ooopsss, failed")
        }
    })
    .catch((err) => {
        console.error("Request failed:", err)
    })
}