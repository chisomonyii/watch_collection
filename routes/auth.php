<?php

// show login form
$router->get("/login", "Auth@showLogin");

// store login details
$router->post("/login", "Auth@storeLogin");

// show registration form
$router->get("/register", "User@showRegister");

// store registration details
$router->post("/register", "User@storeRegister");