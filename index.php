<?php

ob_start();

use Source\Models\Patient;

require __DIR__ . "/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(url(), "@");


$router->namespace("Source\App");
/** get */
$router->get("/", "Web@home");
$router->get("/cadastrar", "Web@formPage");
$router->get("/listagem", "Web@listAll");
$router->get("/listagem/com-consulta-feita", "Web@listAppointmentDone");
$router->get("/listagem/sem-consulta-feita", "Web@listWithOutAppointmentDone");
$router->get("/paciente/{id}", "Web@patient");
$router->get("/consulta/{id}", "Web@appointment");
/** post */
$router->post("/cadastrar", "Web@register");
/** put */
$router->put("/consulta/{id}", "Web@appointment");


$router->dispatch();


ob_flush();