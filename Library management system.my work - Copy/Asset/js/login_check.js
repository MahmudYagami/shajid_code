document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("login-form");
    const email = document.getElementById("email");
    const password = document.getElementById("password");

    document.getElementById("submit-btn").addEventListener("click", function () {
        if (email.value.trim() === "" || password.value.trim() === "") {
            alert("Please fill in all fields.");
        } else {
            form.submit();
        }
    });
});
