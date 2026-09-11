<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('career', 'Home::index');
$routes->get('career/csrf-token', 'AuthController::csrfToken');
$routes->post('career/login', 'AuthController::login');
$routes->post('career/register', 'AuthController::register');
$routes->post('career/logout', 'AuthController::logout');
$routes->get('career/portal', 'RecruitmentController::portal');
$routes->get('api/recruitment/jobs', 'RecruitmentController::jobs');
$routes->get('api/candidate/profile', 'RecruitmentController::profile');
$routes->post('api/candidate/profile', 'RecruitmentController::saveProfile');
$routes->get('api/candidate/applications', 'RecruitmentController::applications');
$routes->post('api/candidate/applications', 'RecruitmentController::apply');
