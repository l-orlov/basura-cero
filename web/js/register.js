function submitRegister() {
    const name = register_name.value
    const surname = register_surname.value
    const document = register_document.value
    const phone = register_phone.value
    const password = register_password.value
    const password_confirm = register_password_confirm.value

    console.log(name, surname, document, phone, password)

    const address = `${register_address_1.value} ${register_address_2.value} ${register_address_3.value}` 

    const xhr = new XMLHttpRequest()
    xhr.open("POST", "/include/scripts/register.php", true)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")

    xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            const res = JSON.parse(xhr.responseText)

            if (res.redirect) {
                window.location.href = res.redirect
            } else {
                console.log('Ooopsss, failed')
            }
        }
    }

    const params = `name=${encodeURIComponent(name)}&surname=${encodeURIComponent(surname)}&document=${encodeURIComponent(document)}&phone=${encodeURIComponent(phone)}&address=${encodeURIComponent(address)}&password=${encodeURIComponent(password)}`

    xhr.send(params)
}

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

        for (let i = 0; i < this.indicators.length; i++) {
            this.indicators[i].addEventListener('click', () => {
                this.setActiveStep(i)
            })
        }

        this.prevBtn.el.addEventListener('click', () => this.prevActiveStep())
        this.nextBtn.el.addEventListener('click', () => this.nextActiveStep())
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
}

document.addEventListener('DOMContentLoaded', () => {
    const indicators = step_indicators.querySelectorAll(":scope > :not(.dot-container)")
    const contents = personal_data.children

    new StepIndicators(
        indicators, contents, new ControlButton(btn_prev), new ControlButton(btn_next)
    ) 
})