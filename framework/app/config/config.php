<?php
/**
 * User: Hércules
 * Date: 16/01/2019
 * Time: 17:27
 */

$config['default_controller'] = "Home/Welcome";
$config['base_dir'] = "framework";
$config['base_url'] = "http://{$_SERVER['SERVER_NAME']}";
$config['time_zone'] = "America/Sao_Paulo"; // List of supported timezones: https://secure.php.net/manual/en/timezones.php
$config['view_extensions'] = array("php","html");


$config['database'] = array(
        'driver' => "mysql",
        'host' => "localhost",
        'user' => "root",
        'password' => "12345678",
        'dbname' => "rastreio",
);