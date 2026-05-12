function updateDate() {

    const now = new Date();

    const options = {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    };

    const fullDate = now.toLocaleDateString(undefined, options);

    document.getElementById("datetime").textContent = fullDate;

    document.getElementById("footer-day").textContent = fullDate;
}

updateDate();

setInterval(updateDate, 60000);