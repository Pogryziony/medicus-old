const place = document.querySelector("#place");
const dateFrom = document.querySelector("#date_from");
const timeFrom = document.querySelector("#time_from");
const dateTo = document.querySelector("#date_to");
const timeTo = document.querySelector("#time_to");


const timepickerOptions = {
    format: "HH:mm",
    date: "12:00",
    controls: true,
    headers: true,
    increment: { minute:30 },
    rows: 8,
    text: {
        title: "Wybierz godzinę",
        cancel: "Cofnij",
        confirm: "Potwierdź",
        hour: "Godzina",
        minute: "Minuta"
    }
}

let pickerFrom = new Picker(timeFrom, timepickerOptions);
let pickerTo = new Picker(timeTo, timepickerOptions);

const datepickerOptions = {
    "autohide": true,
    "disableTouchKeyboard": true,
    "todayHighlight": true,
    "todayBtn": true,
    "prevArrow": "<<<",
    "nextArrow": ">>>",
    "minDate": new Date(2015, 0),
    "maxDate": new Date(2100, 12),
    "weekStart": 1,
    "daysOfWeekHighlighted": [1,2,3,4,5]
}
const datepickerFrom = new Datepicker(dateFrom);
const datepickerTo = new Datepicker(dateTo)
datepickerFrom.setOptions(datepickerOptions);
datepickerTo.setOptions(datepickerOptions);

let today = new Date().toISOString().slice(0, 10)

datepickerFrom.setDate(today);
datepickerTo.setDate(today);

dateFrom.addEventListener("changeDate", function() {
    datepickerTo.setDate(datepickerFrom.getDate());
});

const checkboxes = document.querySelectorAll("input[type=checkbox]");

const dayOff = checkboxes[2];

dayOff.addEventListener("change", () => {
    if (dayOff.checked) {
        disableFormFields();
    } else {
        enableFormFields();
    }
})

if (dayOff.checked) {
    disableFormFields();
}

function disableFormFields() {
    place.setAttribute("disabled", "");
    timeFrom.setAttribute("disabled", "");
    timeTo.setAttribute("disabled", "");
    dateTo.setAttribute("disabled", "");
    // driver checkbox
    checkboxes[0].setAttribute("disabled", "");
    // subsistence allowance checkbox
    checkboxes[1].setAttribute("disabled", "");
}

function enableFormFields() {
    place.removeAttribute("disabled");
    timeFrom.removeAttribute("disabled");
    timeTo.removeAttribute("disabled");
    dateTo.removeAttribute("disabled");
    // driver checkbox
    checkboxes[0].removeAttribute("disabled");
    // subsistence allowance checkbox
    checkboxes[1].removeAttribute("disabled");
}
