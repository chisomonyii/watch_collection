<?php

// GET route for the contact page
$router->get('/user/contact', 'Contact@showContactPage');

// POST route for form submission
$router->post('/api/contact', 'Contact@submitForm');