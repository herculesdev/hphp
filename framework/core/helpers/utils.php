<?php
/**
 * User: Hércules
 * Date: 18/01/2019
 * Time: 09:52
 */

// Constantes (função dateTo())
define("u_US", 0);
define("u_BR", 1);

/**
* Imprime a estrutura, valores e tipos de uma variável
* @param any $var - variável que será dissecada
* @param boolean $dump - além da estrutura e valores, mostrará os tipos?
* @return void
**/
function debug($var, $dump = false)
{
    echo "<pre>";
    if($dump)
        var_dump($var);
    else
        print_r($var);
    echo "</pre>";
}

/**
* Remove caractere $char do ínicio e  do final da string $str 
* @param string $str - string que será modificada
* @param char $char - caractere que deseja retirar do inicio e do final da string
* @return string - retorna a string modificada
**/
function remove_start_end_char($str, $char)
{
    // Obtém primeiro caractere de $str
    $ch = substr($str, 0,1);

    // Se verdadeiro, substitui o primeiro caractere de $str por nada
    if($char == $ch)
        $str = substr_replace($str, "", 0, 1);


    // Obtém último caractere de $str
    $ch = substr($str, -1);

    // Se verdadeiro, substitui o último caractere de $str por nada
    if($char == $ch)
        $str = substr_replace($str, "", -1, 1);

    return $str;
}

/**
* Converte uma data no formato americano para o formato brasileiro ou vice-versa
* @param string $date - data que será convertida
* @param int $to - formato para qual deseja converter (u_US/u_BR)
* @return string - retorna a data modificada
**/
function dateTo($date, $to)
{
    if($to == u_BR)
        return date("d/m/Y", $date);
    else if($to == u_US)
        return date("Y/m/d", $date);
    else
        return $date;
}

/**
* Retorna a URL base (seudominio.com ou seudominio.com/diretorioApp) concatenado $link (opicional)
* @param string $link - string que será concatenada coma  URL base
* @return string - string contendo a URL base + $link
**/
function base_url($link = "")
{
    $base = !empty(\Core\Config::get("base_url")) ? \Core\Config::get("base_url") . '/'. \Core\Config::get("base_dir") : \Core\Config::get("baseUrl");
    $base = !empty($link) ? $base . '/' . $link : $base;
    return $base;
}