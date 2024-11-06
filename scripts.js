function calculatePrice() {
    console.log("calculatePrice function called");

    var hoursInput = document.getElementById('hours');
    var hours = parseFloat(hoursInput.value);
    console.log("Hours entered:", hours);

    if (isNaN(hours) || hours <= 0) {
        alert("Please enter a valid number of hours.");
        return;
    }

    var baseRate = 33; // Base hourly rate without VAT
    var rateWithVAT = baseRate * 1.255; // Base rate with 25.5% VAT

    var totalWithoutVAT = baseRate * hours;
    var totalWithVAT = rateWithVAT * hours;

    document.getElementById('totalWithoutVAT').innerText = 'Yhteensä ilman ALV:ta: EUR ' + totalWithoutVAT.toFixed(2);
    document.getElementById('totalWithVAT').innerText = 'Yhteensä sis. ALV 25.5%: EUR ' + totalWithVAT.toFixed(2);

    console.log("Total without VAT:", totalWithoutVAT);
    console.log("Total with VAT:", totalWithVAT);
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault();
        calculatePrice();
    });
});