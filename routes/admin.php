<?php
// routes/admin.php

$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/watch', 'AdminController@watch');
$router->get('/admin/staff-requests', 'AdminController@staffRequests');
$router->post('/admin/staff/approve/{id}', 'AdminController@approveStaff');
$router->get('/admin/staff/approve/{id}', 'AdminController@approveStaff');
$router->get('/admin/contact', 'AdminController@contact');

// News Management Routes
$router->get('/admin/news', 'AdminController@news');
$router->post('/admin/news/store', 'AdminController@storeNews');
$router->post('/admin/news/delete/{id}', 'AdminController@deleteNews');
$router->get('/admin/news/delete/{id}', 'AdminController@deleteNews'); 

// Update route handles saving edits from your modal
$router->post('/admin/news/update/{id}', 'AdminController@updateNews');
$router->get('/admin/news/update/{id}', 'AdminController@updateNews');

// Contact Management Routes
$router->get('/admin/contact', 'AdminController@contact');
$router->post('/admin/contact/read/{id}', 'AdminController@markContactRead');
$router->get('/admin/contact/read/{id}', 'AdminController@markContactRead');
$router->post('/admin/contact/send-message', 'AdminController@sendContactMessage');