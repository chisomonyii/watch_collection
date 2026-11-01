<?php
// routes/staff.php
$router->get('/staff/dashboard', 'Staff@dashboard');
$router->get('/staff/overview', 'Staff@dashboard'); // fallback alias

$router->get('/staff/orders', 'Staff@orders');
$router->get('/staff/orders/{id}', 'Staff@orders');
$router->post('/staff/orders/update/{id}', 'Staff@updateOrderStatus');

$router->get('/staff/watch', 'Staff@watch');
$router->get('/staff/watch/details/{id}', 'Staff@viewWatchDetails');
$router->get('/staff/contact', 'Staff@contact');

$router->get('/staff/profile', 'Staff@profile');
$router->post('/staff/profile/update', 'Staff@updateProfile');

$router->get('/staff/reviews', 'Staff@reviews');
$router->get('/staff/reviews/approve/{id}', 'Staff@approveReview');
$router->get('/staff/reviews/reject/{id}', 'Staff@rejectReview');

$router->get('/staff/subscribers', 'Staff@index');

// CSV Export Route
$router->get('/staff/subscribers/export', 'Staff@exportCsv');

// AJAX Endpoint for Sending Newsletters MUST be POST
$router->post('/staff/send-newsletter', 'Staff@sendNewsletter');

// AJAX Endpoint for Deleting Subscriber
$router->post('/staff/subscribers/delete', 'Staff@deleteSubscriber');