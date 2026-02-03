const loginPhoneEl = document.getElementById("loginPhone")
const loginPasswordEl = document.getElementById("loginPassword")
const togglePasswordBtn = document.getElementById("togglePasswordBtn") 
const togglePasswordImg = document.getElementById("togglePasswordImg") 

function submitLogin() {
    const phone = loginPhoneEl.value
    const password = loginPasswordEl.value

    fetch("include/api/login.php", 
        { method: "POST", body: JSON.stringify({ phone, password }) }
    )
    .then(async (res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`)
        const data = await res.json()

        if (data.success) {
            window.location.href = "?page=user"
        } else {
            console.log("Ooopsss, failed")
        }
    })
    .catch((err) => {
        console.error("Login request failed:", err)
    })
}

function togglePasswordVis() {
    const isPressed = togglePasswordBtn.getAttribute("aria-pressed")
    
    if (isPressed === "true") {
        loginPasswordEl.type = "text"
        togglePasswordBtn.setAttribute("aria-pressed", "false")
        togglePasswordImg.src = "img/ico/eye/grey-closed.svg"
    } else {
        loginPasswordEl.type = "password"
        togglePasswordBtn.setAttribute("aria-pressed", "true")
        togglePasswordImg.src = "img/ico/eye/grey-open.svg"
    }
}