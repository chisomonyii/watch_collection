<?php
// routes/admin.php

// Dashboard & Overview
$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/watch', 'AdminController@watch');

// Staff Management Routes
$router->get('/admin/staff', 'AdminController@showStaffManagement');
$router->get('/admin/staff-requests', 'AdminController@staffRequests');
$router->post('/admin/staff/approve/{id}', 'AdminController@approveStaff');
$router->get('/admin/staff/approve/{id}', 'AdminController@approveStaff');
$router->post('/admin/users/role/{id}', 'AdminController@updateUserRole');
$router->post('/admin/users/status/{id}', 'AdminController@updateStaffStatus');

// News Management Routes
$router->get('/admin/news', 'AdminController@news');
$router->post('/admin/news/store', 'AdminController@storeNews');
$router->post('/admin/news/delete/{id}', 'AdminController@deleteNews');
$router->get('/admin/news/delete/{id}', 'AdminController@deleteNews'); 
$router->post('/admin/news/update/{id}', 'AdminController@updateNews');
$router->get('/admin/news/update/{id}', 'AdminController@updateNews');

// Contact Management Routes
$router->get('/admin/contact', 'AdminController@contact');
$router->post('/admin/contact/read/{id}', 'AdminController@markContactRead');
$router->get('/admin/contact/read/{id}', 'AdminController@markContactRead');
$router->post('/admin/contact/send-message', 'AdminController@sendContactMessage');

// Watch Inventory Management Routes
$router->get('/admin/watch', 'AdminController@indexWatches');
$router->get('/admin/watch/add', 'AdminController@createWatch');
$router->post('/admin/watch/store', 'AdminController@storeWatch');
$router->get('/admin/watch/edit/{id}', 'AdminController@editWatch');
$router->post('/admin/watch/update/{id}', 'AdminController@updateWatch');
$router->post('/admin/watch/status/{id}', 'AdminController@updateWatchStatus');
$router->post('/admin/watch/delete/{id}', 'AdminController@deleteWatch');

// Payment Verification & Receipt Auditing Routes
$router->get('/admin/payment', 'AdminController@payments');
$router->get('/admin/payments', 'AdminController@payments');
$router->post('/admin/payments/update/{id}', 'AdminController@updatePaymentStatus');
$router->post('/admin/payment/update/{id}', 'AdminController@updatePaymentStatus');

$router->get('/admin/orders', 'AdminController@orders');

$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->post('/admin/shipping/store', 'AdminController@storeShippingMethod');
$router->post('/admin/shipping/update/{id}', 'AdminController@updateShippingMethod');
$router->get('/admin/shipping/delete/{id}', 'AdminController@deleteShippingMethod');