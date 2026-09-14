const form = document.querySelector("form");
const email = document.getElementById("email");
const password = document.getElementById("password");
const firstname = document.getElementById("firstname")
const lastname = document.getElementById("lastname")
const notyf = new Notyf();

const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

form.addEventListener("submit", function (event) {
    event.preventDefault();

    let isValid = true;

    document.querySelectorAll(".error-message").forEach(error => {
        error.textContent = "";
    });

    document.querySelectorAll(".error").forEach(input => {
        input.classList.remove("error");
    });

    if(firstname.value.trim() === ""){
        showError(firstname, "firstname is required")
        isValid = false;
    }

    
    if(lastname.value.trim() === ""){
        showError(lastname, "lastname is required")
        isValid = false;
    }

    if (email.value.trim() === "") {
        showError(email, "Email is required");
        isValid = false;
    } else if (!emailRegex.test(email.value.trim())) {
        showError(email, "Please enter a valid email address");
        isValid = false;
    }

    if (password.value.trim() === "") {
        showError(password, "Password is required");
        isValid = false;
    }

    if (isValid) {
        notyf.success("Account Created successful!");
    }
});

function showError(input, message) {
    input.classList.add("error");

    const errorMessage = input.parentElement.querySelector(".error-message");

    if (errorMessage) {
        errorMessage.textContent = message;
    }
}