<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use App\DIOS;
use App\Libs;
use App\Models;

$router = new Router(URL);

/*
 * Namespace of controller classes
*/
$router->namespace("App\Controllers");

/*
 * Web
*/
$router->group(null);
$router->get("/","Web:redirect");
$router->get("/home","Web:home");
// $router->get("/home/{id}","Web:home");

/*
 * Cadastro 
 */
$router->group("cadastrar");
$router->get("/adminOrbe","Cadastro:register");
$router->post("/adminOrbe","Cadastro:create");
/*
 * Login 
 */
$router->group("login");
$router->get("/loginOrbe","Login:login");
$router->post("/loginOrbe","Login:auth");

/*
 * Error
*/
$router->group("error");
$router->get("/{errCode}","Web:error");

$router->dispatch();

if($router->error()){
   $router->redirect("error/{$router->error()}");
}