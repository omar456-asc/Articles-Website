<?php

// Home page
$router->get('/', 'HomeController@index');

// Login page
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@authenticate');

// Groups page
$router->get('/groups', 'GroupsController@index')->middleware(AuthMiddleware::class);
$router->post('/groups', 'GroupsController@store')->middleware(AdminMiddleware::class);
$router->get('/groups/edit/{id}', 'GroupsController@edit')->middleware(AdminMiddleware::class);
$router->post('/groups/update/{id}', 'GroupsController@update')->middleware(AdminMiddleware::class);
$router->post('/groups/delete/{id}', 'GroupsController@delete')->middleware(AdminMiddleware::class);

// Users page
$router->get('/users', 'UsersController@index')->middleware(AuthMiddleware::class);
$router->post('/users', 'UsersController@store')->middleware(AdminMiddleware::class);
$router->get('/users/edit/{id}', 'UsersController@edit')->middleware(AdminMiddleware::class);
$router->post('/users/update/{id}', 'UsersController@update')->middleware(AdminMiddleware::class);
$router->post('/users/delete/{id}', 'UsersController@delete')->middleware(AdminMiddleware::class);

// Articles page
$router->get('/articles', 'ArticlesController@index')->middleware([AuthMiddleware::class, AdminMiddleware::class]);
$router->post('/articles', 'ArticlesController@store')->middleware([AuthMiddleware::class, AdminMiddleware::class]);

// Logout
$router->get('/logout', 'AuthController@logout')->middleware(AuthMiddleware::class);
