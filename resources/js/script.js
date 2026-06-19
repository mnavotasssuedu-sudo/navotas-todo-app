// Display a welcome message when the page loads
window.addEventListener("load", function () {
    console.log("Website loaded successfully!");
});

// Show an alert when the button is clicked
function showMessage() {
    alert("Thank you for visiting our website!");
}

// Display current date and time
function showDateTime() {
    const dateTime = new Date();
    document.getElementById("datetime").innerHTML =
        "Current Date & Time: " + dateTime.toLocaleString();
}