function submitLogin() {
    const phone = login_phone.value;
    const password = login_password.value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/include/scripts/login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            const res = JSON.parse(xhr.responseText);

            if (res.redirect) {
                window.location.href = res.redirect;
            } else {
                console.log('Ooopsss, failed');
            }
        }
    };

    xhr.send("phone=" + encodeURIComponent(phone) + "&password=" + encodeURIComponent(password));
}