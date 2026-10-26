<?php

// show login form
$router->get("/auth/login", "Auth@showLogin");

// store login details
$router->post("/auth/login", "Auth@storeLogin");

// show registration form
$router->get("/auth/register", "User@showRegister");

// store registration details
$router->post("/auth/register", "User@storeRegister");