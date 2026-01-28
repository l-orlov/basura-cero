const tabs = dashboard_main.querySelectorAll(".tab")
const controls = navbar.querySelectorAll("a.tab-link")

function setTab(tabName) {
    let activeTab, requestedTab
    let activeTabName

    for (const tab of tabs) {
        if (!tab.classList.contains("hidden")) {
            activeTab = tab
            activeTabName = tab.classList[1]
        }

        if (tab.classList.contains(tabName)) {
            requestedTab = tab
        }
    }

    activeTab.classList.add("hidden")
    requestedTab.classList.remove("hidden")
    
    activeLink = navbar.querySelectorAll(`.tab-link.${activeTabName}`)[0]
    activeLink.classList.remove("active")

    for (const control of controls) {
        if (control.classList.contains(tabName)) {
            control.classList.add('active')
        }
    }
}

document.addEventListener('DOMContentLoaded', () => { 
    const links = document.querySelectorAll("a.tab-link")
    const initialTab = new URL(location.href).searchParams.get('tab');

    if (initialTab) {
        setTab(initialTab)
    }

    for (let i = 0; i < links.length; i++) {
        const link = links[i]

        link.addEventListener('click', (e) => {
            e.preventDefault()
            
            const url = new URL(link.href, location.origin)
            const tab = url.searchParams.get('tab')
            setTab(tab)
            
            const params = new URLSearchParams(location.search)
            params.set("tab", tab)
            const newUrl = location.pathname + '?' + params.toString()
            history.pushState({tab}, '', newUrl)
        })
    }
})

window.addEventListener('popstate', (e) => {
    const tab = e.state.tab || 
                new URL(location.href).searchParams.get('tab')

    if (tab) {
        setTab(tab)
    }
})

document.addEventListener('DOMContentLoaded', () => {

});
