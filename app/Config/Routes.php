<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/alumnos', 'AlumnoController::index');
$routes->get('/alumnos/create', 'AlumnoController::create');
$routes->post('/alumnos/store', 'AlumnoController::store');
$routes->get('/alumnos/edit/(:num)', 'AlumnoController::edit/$1');
$routes->post('/alumnos/update/(:num)', 'AlumnoController::update/$1');
$routes->get('/alumnos/delete/(:num)', 'AlumnoController::delete/$1');

/**
 * Rutas para curso
 */
$routes->get('/cursos', 'CursoController::index');
$routes->get('/cursos/create', 'CursoController::create');
$routes->post('/cursos/store', 'CursoController::store');
$routes->get('/cursos/edit/(:num)', 'CursoController::edit/$1');
$routes->post('/cursos/update/(:num)', 'CursoController::update/$1');
$routes->get('/cursos/delete/(:num)', 'CursoController::delete/$1');

// Rutas para asignación de cursos a alumnos (se implementarán en siguiente paso)
$routes->get('/alumnos/(:num)/cursos', 'AlumnoCursoController::list/$1');
$routes->get('/alumnos/(:num)/cursos/all', 'AlumnoCursoController::allWithAssigned/$1');
$routes->post('/alumnos/(:num)/cursos/asignar', 'AlumnoCursoController::assign/$1');
$routes->post('/alumnos/(:num)/cursos/remover/(:num)', 'AlumnoCursoController::removeOne/$1/$2');