const entryBtn = document.getElementById("entry_search_button")

entryBtn.addEventListener("click", async () => {
    await getDataAndRender("true")
})

let pages = document.querySelectorAll(".page")
let currentPage = parseInt(document.querySelector("#page_num").textContent)

let nextBtn = document.querySelector("#next_btn")
let prevBtn = document.querySelector("#prev_btn")

nextBtn.addEventListener("click", async function() {
    ++currentPage
    await getDataAndRender()
})

prevBtn.addEventListener("click", async function() {
    --currentPage
    await getDataAndRender()
})

pages.forEach((e) => {
    e.addEventListener("click", async () => {
        let page = parseInt(e.textContent)
        currentPage = page
        await getDataAndRender()
    })
})

let sizeSelect = document.querySelector("#size_select")
let actualSize = 10
sizeSelect.addEventListener("change", async function() {
    await getDataAndRender();
})

async function getDataAndRender(filter) {
    let place = document.querySelector("#place").value
    let hours = document.querySelector("#hours").value
    let wasDriver = document.querySelector("#was_driver").value
    let subAllowance = document.querySelector("#sub_allowance").value
    let dayOff = document.querySelector("#day_off").value
    let sizeVal = (sizeSelect.value)
    await renderPage(place, hours, wasDriver, subAllowance, dayOff, currentPage, sizeVal, filter)
}

async function renderPage(place="", hours="", wasDriver="", subAllowance="", dayOff="", page=1, size=10, filter) {
    let num = location.href.indexOf("/public")
    num += 8
    let url = location.href.slice(0, num) + `index.php?action=getEntriesAjaxPage&page=${page}&size=${size}`
    if (filter === "true") {
        url += `&filter=${filter}`
        currentPage = 1
    }
    const res = await fetch(url, {
        method: "POST",
        body: `place=${place}&hours=${hours}&driver=${wasDriver}&subsistence_allowance=${subAllowance}&day_off=${dayOff}`,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    actualSize = size
    const content = await res.text();
    document.querySelector("#entries_table").innerHTML = content;
    let pagesCount = content.split(`<span id="pages_count">`)[1].split(`</span>`)[0]
    renderButtons(pagesCount)
    styleButtons(pagesCount)
    pages = document.querySelectorAll(".page")
    pages.forEach((e) => {
        e.addEventListener("click", async () => {
            let page = parseInt(e.textContent)
            currentPage = page
            await getDataAndRender()
        })
    })
}

function styleButtons(pagesCount) {
    if (currentPage > 1) {
        prevBtn.classList.remove("disabled")
    } else {
        prevBtn.classList.add("disabled")
    }
    if (currentPage == pagesCount) {
        nextBtn.classList.add("disabled")
    } else {
        nextBtn.classList.remove("disabled")
    }

    pages.forEach(e => {
        e.classList.remove("active")
        if(currentPage == e.textContent) {
            e.classList.add("active")
        }
    })
}

let pagesCount = parseInt(document.querySelector("#pages_count").textContent)

function renderButtons(pagesCount) {
    currentPage = parseInt(document.querySelector("#page_num").textContent)
    let html = `<li><button id="prev_btn" class="button disabled">Prev</button></li>`
    for (let i = 1; i <= pagesCount; i++) {
        html += `<li><button class="page `
        if (i === currentPage) html += 'active'
        html +=`">${i}</button></li>`
    }
    html += `<li><button id="next_btn" class="button">Next</button></li>`
    document.querySelector("#pagination_buttons").innerHTML = html

    nextBtn = document.querySelector("#next_btn")
    prevBtn = document.querySelector("#prev_btn")

    nextBtn.addEventListener("click", async function() {
        ++currentPage
        await getDataAndRender()
    })

    prevBtn.addEventListener("click", async function() {
        --currentPage
        await getDataAndRender()
    })

    sizeSelect = document.querySelector("#size_select")
    sizeSelect.addEventListener("change", async function() {
        await getDataAndRender();
    })
    sizeSelect.value = actualSize
}
