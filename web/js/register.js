const indicators = step_indicators.querySelectorAll(":scope > :not(.dot-container)");
const contents = personal_data.children

let isBusy = false;
let currentStep = 0

function setBusy(on) {
    btn_next.disabled = on;
    btn_prev.disabled = on;
}

function hideButton(btn) {
    btn.style.opacity = '0'
    btn.style.cursor = 'auto'
    btn.disabled = true
}

function showButton(btn) {
    btn.style.opacity = ''
    btn.style.cursor = 'pointer'
    btn.disabled = false
}

function setActiveStep() {
    const current = indicators[currentStep].children[0]
    const currentContent = contents[currentStep]
    current.classList.add("active")
    currentContent.classList.remove("hidden")
}

function delActiveStep() {
    const current = indicators[currentStep].children[0]
    const currentContent = contents[currentStep]
    current.classList.remove("active")
    currentContent.classList.add("hidden")
}

function nextActiveStep() {
    if (currentStep >= indicators.length - 1) {
        return
    } 

    setBusy(true)

    delActiveStep();
    currentStep++;
    setActiveStep();

    if (currentStep == indicators.length-1) {
        hideButton(btn_next)
    }

    if (currentStep > 0) {
        showButton(btn_prev)
    }

    setTimeout(() => { 
        setBusy(false) 
    }, 100);
}

function prevActiveStep() {
    if (currentStep <= 0) {
        return    
    }

    setBusy(true)

    delActiveStep();
    currentStep--;
    setActiveStep();

    if (currentStep == 0) {
        hideButton(btn_prev)
    }

    if (currentStep <= indicators.length-1) {
        showButton(btn_next)
    }

    setTimeout(() => { 
        setBusy(false) 
    }, 100);
}

function submitRegister() {
    const name = register_name.value;
    const surname = register_surname.value;
    const document = register_document.value;
    const phone = register_phone.value;
    const password = register_password.value;
    const password_confirm = register_password_confirm.value;

    console.log(name, surname, document, phone, password)

    const address = `${register_address_1.value} ${register_address_2.value} ${register_address_3.value}` ;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/include/scripts/register.php", true);
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

    const params = `name=${encodeURIComponent(name)}&surname=${encodeURIComponent(surname)}&document=${encodeURIComponent(document)}&phone=${encodeURIComponent(phone)}&address=${encodeURIComponent(address)}&password=${encodeURIComponent(password)}`;

    xhr.send(params);
}

setActiveStep()
hideButton(btn_prev)