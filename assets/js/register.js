const registerForm = document.getElementById("register-form");

registerForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(registerForm);

    const data = {
        firstname: formData.get("firstname"),
        lastname: formData.get("lastname"),
        email: formData.get("email"),
        password: formData.get("password"),
        csrf_token: formData.get("csrf_token")
    };

    // First name
    if (data.firstname.trim() === "") {
        showToast("First name is required", "error");
        return;
    }

    // Last name
    if (data.lastname.trim() === "") {
        showToast("Last name is required", "error");
        return;
    }

    // Email
    if (data.email.trim() === "") {
        showToast("Email is required", "error");
        return;
    }

    if (!validateEmail(data.email)) {
        showToast("Please enter a valid email", "error");
        return;
    }

    // Password
    if (data.password.trim() === "") {
        showToast("Password is required", "error");
        return;
    }

    if (!validatePassword(data.password)) {
        showToast(
            "Password must contain uppercase, lowercase, number, special character and be at least 6 characters",
            "error"
        );
        return;
    }

    handleRegistration(data);
});


function validateEmail(email) {

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return emailPattern.test(email);
}


function validatePassword(password) {

    const passwordPattern =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{6,}$/;

    return passwordPattern.test(password);
}


async function handleRegistration(data) {

    const button = document.getElementById("register-button");

    button.disabled = true;
    button.textContent = "Creating Account...";

    let registrationSuccessful = false;

    try {

        const response = await fetch(window.location.href, {
            method: "POST",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {

            registrationSuccessful = true;

            showToast("Registration successful!", "success");

            setTimeout(function () {
                window.location.href = "/Watch_Collection/auth/login";
            }, 3000);

        } else {

            if (result.errors) {

                result.errors.forEach(function (error) {
                    showToast(error, "error");
                });

            } else {

                showToast(result.message, "error");
            }
        }

    } catch (error) {

        console.error(error);

        showToast("Something went wrong. Please try again.", "error");

    } finally {

        if (!registrationSuccessful) {
            button.disabled = false;
            button.textContent = "Create Account";
        }
    }
}


function showToast(message, type) {

    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",

        style: {
            background: type === "success" ? "green" : "red"
        }

    }).showToast();
}