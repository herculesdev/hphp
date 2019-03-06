<?php
/**
 * User: Hércules
 * Date: 18/01/2019
 * Time: 13:34
 */

namespace Core;

use http\Exception;

abstract class Controller{
    private $inputPost; // $_POST
    private $inputGet; // $_GET
    private $param;

    // $_POST
    public function setInputPost($post)
    {
        $this->inputPost = $post;
    }

    public function post($key)
    {
        return $this->inputPost[$key];
    }

    //$_GET
    public function setInputGet($get)
    {
        $this->inputGet = $get;

    }

    protected function get($key)
    {
        return $this->inputGet[$key];
    }

    // Params
    public function setParam($param)
    {
        $this->param = $param;
    }

    protected function param($key)
    {
        return $this->param[$key];
    }

    protected function loadView($view, $data = null)
    {
        $path = "../app/views/{$view}";


        $extensions = \Core\Config::get("view_extensions");

        $len =  count($extensions);

        for($i = 0; $i < $len; $i++) {
            if(file_exists($path . '.' . $extensions[$i])) {
                require $path . '.' . $extensions[$i];
                return;
            }
        }

        throw new \Exception("View not found");
    }

    protected function loadHelper($helperName)
    {
        $path = __DIR__ . "/helpers/" . $helperName . ".php";
        if(file_exists($path))
            require_once $path;
    }
}