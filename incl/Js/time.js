function updateDateTime() {
  const now = new Date();

  const options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  };

  const date = now.toLocaleDateString(undefined, options);

  document.getElementById("datetime").textContent = date;
}

updateDateTime(); // run once immediately
setInterval(updateDateTime, 60000); // update every minute