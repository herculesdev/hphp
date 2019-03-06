<?php
/**
 * User: Hércules
 * Date: 18/01/2019
 * Time: 13:54
 */

function __autoload($class)
{
    require $class . ".php";
}