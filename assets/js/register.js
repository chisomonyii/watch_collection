const registerForm = document.getElementById("register-form");

registerForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(registerForm);

  const data = {
    firstname: (formData.get("firstname") || "").trim(),
    lastname: (formData.get("lastname") || "").trim(),
    email: (formData.get("email") || "").trim(),
    password: (formData.get("password") || "").trim(),
    csrf_token: (formData.get("csrf_token") || "").trim(),
  };

  if (data.firstname === "") {
    showToast("First name is required", "error");
    return;
  }

  if (data.lastname === "") {
    showToast("Last name is required", "error");
    return;
  }

  if (data.email === "") {
    showToast("Email is required", "error");
    return;
  }

  if (!validateEmail(data.email)) {
    showToast("Please enter a valid email", "error");
    return;
  }

  if (data.password === "") {
    showToast("Password is required", "error");
    return;
  }

  if (!validatePassword(data.password)) {
    showToast(
      "Password must contain uppercase, lowercase, number, special character and be at least 6 characters",
      "error",
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
        // Target the explicit POST route rather than window.location.href
        const response = await fetch("/Watch_Collection/auth/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        });

        const responseText = await response.text();
        let result;

        try {
            result = JSON.parse(responseText);
        } catch (jsonErr) {
            console.error("Server returned non-JSON output:", responseText);
            showToast("Server output invalid. Check console for output.", "error");
            return;
        }

        if (result.success === true) {
            registrationSuccessful = true;
            showToast("Registration successful!", "success");

            setTimeout(function () {
                window.location.href = "/Watch_Collection/auth/login";
            }, 1500);

        } else {
            if (result.errors && Array.isArray(result.errors)) {
                result.errors.forEach(function (error) {
                    showToast(error, "error");
                });
            } else {
                showToast(result.message || "Registration failed", "error");
            }
        }

    } catch (error) {
        console.error("Fetch request failed:", error);
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
      background: type === "success" ? "green" : "red",
    },
  }).showToast();
}
