const dateFrom = document.querySelector("#date_from");
const dateTo = document.querySelector("#date_to");


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

let date = new Date();
let firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
let lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

datepickerFrom.setDate(firstDay);
datepickerTo.setDate(lastDay);

dateFrom.addEventListener("changeDate", function() {
    dateTo.focus();
})
