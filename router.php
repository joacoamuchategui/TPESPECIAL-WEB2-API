<?php

require_once 'libs/router.php';
require_once 'app/controllers/celulares.api.controller.php';
require_once 'app/controllers/marcas.api.controller.php';


$router = new Router();

$router->addRoute('celulares',            'GET',     'CelularesApiController',   'getAllCelulares');
$router->addRoute('celulares/:id',            'GET',     'CelularesApiController',   'getCelularByID');
$router->addRoute('celulares/:id',            'DELETE',  'CelularesApiController',   'deleteCelular');
$router->addRoute('celulares',                'POST',    'CelularesApiController',   'addCelular');
$router->addRoute('celulares/:id',            'PUT',     'CelularesApiController',   'updateCelular');
$router->addRoute('marcas',            'GET',     'MarcasApiController',   'getAllMarcas');
$router->addRoute('marcas/:id',            'GET',     'MarcasApiController',   'getMarcaByID');
$router->addRoute('marcas/:id',            'DELETE',  'MarcasApiController',   'deleteMarca');
$router->addRoute('marcas',                'POST',    'MarcasApiController',   'addMarca');
$router->addRoute('marcas/:id',            'PUT',     'MarcasApiController',   'updateMarca');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
