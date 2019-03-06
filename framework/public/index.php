<?php
/**
 * User: Hércules
 * Date: 15/01/2019
 * Time: 19:34
 */

require "../autoload.php";

date_default_timezone_set(Core\Config::get("time_zone"));

$router = new Core\Router($_SERVER['REQUEST_URI']);

$router->route();

