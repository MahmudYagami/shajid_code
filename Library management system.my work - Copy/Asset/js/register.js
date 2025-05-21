document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registrationForm");

    form.addEventListener("submit", function (e) {
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;
        const idProof = document.getElementById("id_proof").files[0];

        let errorMessage = "";

        if (!name || !email || !password || !confirmPassword || !idProof) {
            errorMessage = "All fields including ID proof are required.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            errorMessage = "Invalid email format.";
        } else if (password !== confirmPassword) {
            errorMessage = "Passwords do not match.";
        }

        if (errorMessage) {
            e.preventDefault();
            alert(errorMessage);
        }
    });
});
