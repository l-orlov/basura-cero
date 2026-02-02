const registerStepIndicatorsEl = document.getElementById("registerStepIndicators")
const registerPrevBtn = document.getElementById("registerPrevBtn")
const registerNextBtn = document.getElementById("registerNextBtn")
const registerForm = document.getElementById("registerForm")

const indicators = registerStepIndicatorsEl.querySelectorAll(":scope > :not(.dot-container)")
const contents = registerForm.children

class ControlButton {
    constructor(el) {
        this.el = el
    }

    show() {
        this.el.style.opacity = ''
        this.el.style.cursor = 'pointer'
        this.el.disabled = false
    }

    hide() {
        this.el.style.opacity = '0'
        this.el.style.cursor = 'auto'
        this.el.disabled = true
    }
}

class StepIndicators {
    constructor(indicators, contents, prevButton, nextButton) {
        this.prevBtn = prevButton
        this.nextBtn = nextButton
        this.indicators = indicators
        this.contents = contents

        this.currentStep = 0
        this.setActiveStep(this.currentStep)
        this.prevBtn.hide()
    }

    isLastStep() {
        return this.currentStep == this.indicators.length - 1
    }

    isFirstStep() {
        return this.currentStep == 0
    }

    setBusy(isOn) {
        this.prevBtn.el.disabled = isOn
        this.nextBtn.el.disabled = isOn
    }

    updateActive(curStep, nextStep) {
        this.unsetActive(curStep)
        this.setActive(nextStep)
    }

    setActive(step) {
        const current = this.indicators[step].children[0]
        const currentContent = this.contents[step]
        current.classList.add("active")
        currentContent.classList.remove("hidden")
    }

    unsetActive(step) {
        const current = this.indicators[step].children[0]
        const currentContent = this.contents[step]
        current.classList.remove("active")
        currentContent.classList.add("hidden")
    }

    nextActiveStep() {
        if (this.isLastStep()) {
            return
        }

        if (!this.isValidatedStep()) {
            return
        }

        this.setBusy(true)
        this.updateActive(this.currentStep, ++this.currentStep)

        if (this.isLastStep()) {
            this.nextBtn.hide()
        }

        if (!this.isFirstStep()) {
            this.prevBtn.show()
        }

        setTimeout(() => { 
            this.setBusy(false) 
        }, 100)
    }

    prevActiveStep() {
        if (this.isFirstStep()) {
            return
        }

        if (!this.isValidatedStep()) {
            return
        }

        this.setBusy(true)
        this.updateActive(this.currentStep, --this.currentStep)

        if (this.isFirstStep()) {
            this.prevBtn.hide()
        }

        if (!this.isLastStep()) {
            this.nextBtn.show()
        }

        setTimeout(() => { 
            this.setBusy(false) 
        }, 100)
    }

    setActiveStep(step) {
        if (!this.isValidatedStep()) {
            return    
        }

        this.setBusy(true)
        this.updateActive(this.currentStep, step)
        this.currentStep = step

        if (this.isFirstStep()) {
            this.prevBtn.hide()
        } else {
            this.prevBtn.show()
        }

        if (this.isLastStep()) {
            this.nextBtn.hide()
        } else {
            this.nextBtn.show()
        }

        setTimeout(() => { 
            this.setBusy(false) 
        }, 100)
    }

    isValidatedStep() {
        const currentContent = this.contents[this.currentStep]
        const inputs = currentContent.querySelectorAll("input")

        for (const input of inputs) {
            input.checkValidity()
        }

        const firstInvalid = currentContent.querySelector(':invalid')
        const currentIndicator = this.indicators[this.currentStep].children[0]
        
        if (firstInvalid) {
            firstInvalid.reportValidity()
            currentIndicator.classList.remove("valid")
            return false
        } 

        currentIndicator.classList.add("valid")
        return true
    }
}

const stepIndicators = new StepIndicators(
    indicators, contents, 
    new ControlButton(registerPrevBtn), 
    new ControlButton(registerNextBtn)
)

function submitRegister() {
    const name = registerName.value
    const surname = registerSurname.value
    const userDocument = registerDocument.value
    const phone = registerPhone.value
    const password = registerPassword.value
    const passwordConfirm = registerPasswordConfirm.value

    const address = `${registerAddress1.value} ${registerAddress2.value}`
    const floor = registerAddress3.value

    // Ensure each step was valid
    for (let i = 0; i < stepIndicators.indicators.length; i++) {
        const indicator = stepIndicators.indicators[i]
        const circle = indicator.children[0]

        if (!circle.classList.contains("valid")) {
            stepIndicators.setActiveStep(i)
            stepIndicators.isValidatedStep()
        }
    }

    if (password !== passwordConfirm) {
        stepIndicators.setActiveStep(3)
        const errorField = document.getElementById("passwordError")
        errorField.textContent = "Las contraseñas no coinciden"
        return
    }

    fetch("include/api/register.php", {
        method: "POST",
        body: JSON.stringify({
            name,
            surname,
            document,
            phone,
            address,
            floor,
            password
        })
    })
    .then(async (res) => {
        const data = await res.json()
        if (data.redirect) {
            window.location.href = data.redirect
        } else {
            console.log("Ooopsss, failed")
        }
    })
    .catch((err) => {
        console.error("Register request failed:", err)
    })
}

document.addEventListener('DOMContentLoaded', () => {
    for (let i = 0; i < indicators.length; i++) {
        indicators[i].addEventListener('click', () => {
            stepIndicators.setActiveStep(i)
        })
    }

    registerPrevBtn.addEventListener('click', () => stepIndicators.prevActiveStep())
    registerNextBtn.addEventListener('click', () => stepIndicators.nextActiveStep())
})