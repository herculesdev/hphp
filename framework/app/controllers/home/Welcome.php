<?php
/**
 * User: Hércules
 * Date: 20/01/2019
 * Time: 16:26
 */

namespace App\Controllers\Home;

class Welcome extends \Core\Controller
{
    public function index()
    {
        $this->loadView("Welcome");   
    }
}