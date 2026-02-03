class BalanceNotifications {
    constructor(notificationsContainer) {
        this.lengthFetched = 0
        this.container = notificationsContainer
    }

    fetchMore() {
        // TODO fetch database, etc.
        // for now hardcoded
        this.lengthFetched++

        return `
            <div class="notification">
                <div class="icon"><img src="img/ico/box/up-black.svg"></div>
                <div class="content">
                    <h1>Puntos retirados</h1>
                    <span>
                        <p class="date">20/01/26</p>
                        <p class="body">Retiro de 200 puntos</p>
                    </span>
                </div>
                <div class="date"><p>14:55</p></div>
            </div>
        `
    }

    populate() {
        const notification = this.fetchMore()

        if (!notification) {
            return // Also should hide "Show more button"
        }

        this.container.insertAdjacentHTML('beforeend', notification)
    }
}

function getUserBalance() {
    // TODO fetch database for balance
    return [190, 190000] 
}

function toggleBalance() {
    img = toggle_balance.children[0]
    isShown = toggle_balance.dataset.shown === "true"

    // Toggle state
    isShown = !isShown

    if (isShown) {
        const [balance, money] = getUserBalance()
        p_points.textContent = balance
        p_money.textContent = money
        img.src = "img/ico/eye/closed.svg"
    } else {
        p_points.textContent = '****'
        p_money.textContent = '****'
        img.src = "img/ico/eye/open.svg"
    }
    
    toggle_balance.dataset.shown = String(isShown)
}

function updateUserInfo() {
    const name = document.getElementById('name').value;
    const surname = document.getElementById('surname').value;
    const userDocument = document.getElementById('document').value;
    const phone = document.getElementById('phone').value;
    const whatsappCode = document.getElementById('whatsapp_code').value;
    const email = document.getElementById('email').value;
    const emailCode = document.getElementById('email_code').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const address = document.getElementById('address').value;
    const floor = document.getElementById('floor').value;

    fetch("include/api/update_user.php", { 
        method: "POST", 
        body: JSON.stringify({
            document: userDocument,
            name: name,
            surname: surname,
            phone: phone,
            password: password,
            address: address,
            floor: floor 
        })}
    )
    .then(async (res) => {
        const data = await res.json();
        if (data.success) {
            location.reload();
        } else {
            console.log("Ooopsss, failed");
        }
    })
    .catch((err) => {
        console.error("Update failed:", err);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const notifHandler = new BalanceNotifications(balance_notifications)
    show_more_button.addEventListener('click', () => notifHandler.populate())
    update_data_button.addEventListener('click', () => updateUserInfo())
})
