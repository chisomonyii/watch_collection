<?php
// routes/staff.php

$router->get('/staff/dashboard', 'Staff@dashboard');
$router->get('/staff/orders', 'Staff@orders');
$router->get('/staff/watch', 'Staff@watch');
$router->get('/staff/contact', 'Staff@contact');

$router->get('/staff/profile', 'Staff@profile');
$router->post('/staff/profile/update', 'Staff@updateProfile');

$router->get('/staff/reviews', 'Staff@reviews');
$router->get('/staff/reviews/approve/{id}', 'Staff@approveReview');
$router->get('/staff/reviews/reject/{id}', 'Staff@rejectReview');

