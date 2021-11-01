<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

//CONSTANT
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

//GLOBAL REQUIRE
require_once(ROOT . "app/DB.php");
require_once(ROOT . "app/AbstractController.php");

//URL TREATMENT
if (!empty($_GET)) {
    $params = explode('/', $_GET['p']);

    if ($params[0] !== "") {

        $controller = ucfirst($params[0]);
        $action = $params[1] ?? 'index';

        //eg: "Articles.php"
        require_once(ROOT . "controller/$controller.php");

        //eg: new Articles()
        $controller = new $controller();

        if (method_exists($controller, $action)) {
            unset($params[0], $params[1]);
            call_user_func_array([$controller, $action], $params);
        } else {
            http_response_code(404);
            echo "La page demandée n'existe pas";
        }
    }
} else {
    require_once(ROOT . "controller/Home.php");
    (new Home())->index();
}
