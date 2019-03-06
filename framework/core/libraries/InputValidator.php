<?php
/**
 * User: Hércules
 * Date: 20/02/2019
 * Time: 08:25
 */

namespace Core\Libraries;

class InputValidator
{
    private $input;
    
    function __construct()
    {
        
    }
    
    function __construct($input)
    {
        $this->input = $input;
    }
    
    
    private function setInput($input)
    {
        $this->input = $input;
    }
    
    private function getInput()
    {
        return $this->input;
    }
    
    private function setRule()
    {
        
    }
}