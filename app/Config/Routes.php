<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// app/Config/Routes.php

$routes->get('/contact', 'Contact::index');
$routes->post('/contact/submit', 'Contact::submit');


