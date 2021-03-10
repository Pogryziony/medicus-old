const date = document.querySelector("#date");
const time = document.querySelector("#time");

const timepickerOptions = {
    format: "HH:mm",
    date: "12:00",
    controls: true,
    headers: true,
    increment: { minute:5 },
    rows: 8,
    text: {
        title: "Wybierz godzinę",
        cancel: "Cofnij",
        confirm: "Potwierdź",
        hour: "Godzina",
        minute: "Minuta"
    }
}

let timePicker = new Picker(time, timepickerOptions);

const datepickerOptions = {
    format: "YYYY-MM-DD",
    controls: true,
    headers: true,
    rows: 8,
    text: {
        title: "Wybierz datę",
        cancel: "Cofnij",
        confirm: "Potwierdź",
        year: "Rok",
        month: "Miesiąc",
        day: "Dzień"
    }
}

let datePicker = new Picker(date, datepickerOptions);