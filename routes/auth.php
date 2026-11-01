<?php

// show login form
$router->get("/auth/login", "Auth@showLogin");

// store login details
$router->post("/auth/login", "Auth@storeLogin");

// show registration form
$router->get("/auth/register", "User@showRegister");

// store registration details
$router->post("/auth/register", "User@storeRegister");

// show forgot password form
$router->get("/auth/forgot-password", "Auth@showForgotPassword");

// handle forgot password form submission (Brevo email send)
$router->post("/auth/forgot-password", "Auth@sendResetLink");

// show reset password form
$router->get("/auth/reset-password", "Auth@showResetPassword");

// handle reset password form submission (database update)
$router->post("/auth/reset-password", "Auth@updatePassword");

// show reset password form (GET request)
$router->get("/auth/reset-password", "Auth@showResetPassword");

// handle reset password form submission (POST request)
$router->post("/auth/reset-password", "Auth@updatePassword");