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

setActiveStep()
hideButton(btn_prev)