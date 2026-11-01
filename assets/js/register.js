const registerForm = document.getElementById("register-form");

registerForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(registerForm);

  // Get the selected role from the radio inputs or active toggle
  const selectedRoleInput =
    document.querySelector('input[name="role"]:checked') ||
    document.getElementById("selected-role");
  const roleValue = selectedRoleInput ? selectedRoleInput.value : "staff";

  const data = {
    firstname: (formData.get("firstname") || "").trim(),
    lastname: (formData.get("lastname") || "").trim(),
    email: (formData.get("email") || "").trim(),
    password: (formData.get("password") || "").trim(),
    csrf_token: (formData.get("csrf_token") || "").trim(),
    role: roleValue, // <--- Included role here!
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
    const response = await fetch("/Zeith/auth/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(data),
    });

    // Grab the raw text first to inspect it if JSON parsing fails
    const rawText = await response.text();
    let result;

    try {
      result = JSON.parse(rawText);
    } catch (e) {
      console.error("Server returned non-JSON text:", rawText);
      showToast(
        "Server returned an invalid response. Check F12 Console.",
        "error",
      );
      return;
    }

    if (result.success === true) {
      registrationSuccessful = true;
      showToast("Registration successful!", "success");

      setTimeout(function () {
        window.location.href = "/Zeith/auth/login";
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
    showToast("Something went wrong. Please check your connection.", "error");
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
