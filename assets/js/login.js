const loginForm = document.querySelector("#login-form");
const loginButton = document.querySelector("#login-button");

const handlePost = async (post) => {
    try {
        loginButton.disabled = true;
        loginButton.textContent = "Logging in...";

        const response = await fetch("/Zeith/auth/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(post)
        });

        const data = await response.json();
        console.log(data);

        if (data.success === true) {

            Toastify({
                text: data.message || "Login successful",
                duration: 3000,
                gravity: "top",
                position: "right"
            }).showToast();

            // Use the dynamic redirect URL returned from Auth::storeLogin()
            // Falls back to staff dashboard if redirect isn't specified
            setTimeout(() => {
                window.location.href = data.redirect || "/Zeith/staff/dashboard";
            }, 1500); // Reduced slightly for smoother UX

        } else {

            const serverErrors = data?.errors;

            serverErrors.forEach(error => {
                Toastify({
                    text: error,
                    duration: 3000,
                    gravity: "top",
                    position: "right"
                }).showToast();
            });
        }

    } catch (error) {

        Toastify({
            text: "Invalid Credentials. Please input the right details.",
            duration: 3000,
            gravity: "top",
            position: "right"
        }).showToast();

    } finally {
        loginButton.disabled = false;
        loginButton.textContent = "Login";
    }
};

loginForm.addEventListener("submit", (event) => {
    event.preventDefault();

    let valid = true;

    const password = document.querySelector("#password").value.trim();
    const email = document.querySelector("#email").value.trim();
    const csrfToken = document.querySelector("#csrf-token").value.trim();

    if (password.length < 1) {
        Toastify({
            text: "Password is required",
            duration: 3000,
            gravity: "top",
            position: "right"
        }).showToast();
        valid = false;
    }

    if (email.length < 1) {
        Toastify({
            text: "Email is required",
            duration: 3000,
            gravity: "top",
            position: "right"
        }).showToast();
        valid = false;
    }

    if (!valid) {
        return;
    }

    let post = {
        email: email,
        password: password,
        csrf_token: csrfToken
    };

    handlePost(post);
});