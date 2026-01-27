function submitLogin() {
    const phone = login_phone.value;
    const password = login_password.value;

    fetch("/include/login_js.php", 
        { method: "POST", body: JSON.stringify({ phone, password }) }
    )
    .then(async (res) => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();

        if (data.redirect) {
            window.location.href = data.redirect;
        } else {
            console.log("Ooopsss, failed");
        }
    })
    .catch((err) => {
        console.error("Login request failed:", err);
    });
}