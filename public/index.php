<?php

require_once '../config/config.php';
require_once '../vendor/autoload.php';

use App\Router;
use App\Controllers\ContactController;
use App\Controllers\BankController;
use App\Controllers\CustomerController;
use App\Controllers\AccountController;
use App\Controllers\TransactionController;
use App\Models\Banks;
use App\Models\Customer;

$router = new Router();  

$router->get('/', function() {
    echo "Home Page";
});

$router->get('/about', function() {
    echo 'About Page';
});

$router->get('/contact', ContactController::class . '::execute');
$router->post('/contact', ContactController::class . '::exec');


$router->get('/bank', BankController::class . '::index');
$router->post('/bank', BankController::class . '::store');
$router->get('/logout', BankController::class . '::logout');

$router->get('/customer', AccountController::class . '::index');
$router->post('/customer', AccountController::class . '::store');
$router->post('/customer', TransactionController::class . '::transaction');
// $router->post('/customer', TransactionController::class . '::showHideForm');

$router->get('/login', CustomerController::class . '::loginDisplay');
$router->post('/login', CustomerController::class . '::login');

$router->addNotFoundHandler(function () {
    echo 'Not found';
});

$router->run();

?>