<?php
/**
 * User: Hércules
 * Date: 19/01/2019
 * Time: 09:28
 */

namespace Core;

class Router extends Controller
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
        $this->loadHelper("utils");
    }

    /**
     * Prepara a URL recebida no construtor para ser processada pelos demais métodos desta classe,
     * removendo a pasta raiz + barras inicial e final da URI
     * @access private
     * @return string - URI limpa, no formato "pasta/controlador/método/parametros"
     */
    private function prepareUri()
    {
        $baseDir = remove_start_end_char(Config::get("base_dir"), '/');
        $baseDir = "{$baseDir}/";

        // remove o diretório base da URL deixando apenas "controlador/método/"
        $preparedUri = str_replace($baseDir, "", $this->url);

        $preparedUri = remove_start_end_char($preparedUri, '/');

        return $preparedUri;

    }

    /**
     * Obtém o namespace completo da classe ex: Name1/Name2/Classe, nome do método e parâmetros
     * @param string - URI que tenha sido preparada pelo método prepareUri
     * @access private
     * @return array - vetor associativo com os elementos class, method e params.
     */
    private function getConInformation($uri)
    {
        $controllersNamespace = "/App/Controllers";

        // Se a URL é vazia, então retorna informações do controlador padrão
        if(empty($uri)) {
            $default = Config::get("default_controller");
            $conNamespace = $controllersNamespace . "/" . $default;
            $conNamespace = str_replace("/", "\\", $conNamespace);

            $conInfo = array(
                "class" => $conNamespace,
                "method" => 'index',
                "params" => null,
            );

            return $conInfo;
        }

        // Parse da URL para determinar o namespace, controlador, método e parâmetro
        $urlArray = explode("/", $uri);
        $arrayLen = count($urlArray);

        $conNamespace = $controllersNamespace;
        $dir = ".." . strtolower($controllersNamespace);
        for($i = 0; $i < $arrayLen; $i++) {
            $dir = $dir . "/" . $urlArray[$i]; // monta o caminho de diretório
            $conNamespace = $conNamespace . "/" . ucwords($urlArray[$i]); // monta o caminho do namespace

            // Se é um diretório, adiciona "/" ao final da string e vai para próxima iteração
            if(!is_file($dir . ".php")) {
                $dir = $dir . "/";
                continue;
            }
            
            // Obtém o nome do método (ultimo elemento antes dos parâmetros da URL)
            $lastIndex = $arrayLen -1;
            $methodName = $i < $lastIndex ? $urlArray[$i+1] : 'index';

            // Se houver, copia parâmetros da URL para o array $params
            $param = $i+2;
            for($param, $j = 0; $param < $arrayLen; $param++, $j++) {
                $params[$j] = $urlArray[$param];
            }
            break;
        }

        
        $conNamespace = str_replace("/", "\\", $conNamespace);
        
        if(!isset($methodName))
            return null;

        $conInfo = array(
            "class" => $conNamespace,
            "method" => $methodName,
            "params" => $params,
        );

        return $conInfo;

    }

    /**
     * Realiza o roteamento da URI recebida pelo construtor, resultando na instanciação do controlador
     * e na chamada do método requisitado.
     * @access public
     * @return void
     */
    public function route()
    {
        $preparedUri = $this->prepareUri();
        $conInfo = $this->getConInformation($preparedUri);

        if($conInfo) {
            $controller = new $conInfo['class'];
            $controller->setParam($conInfo['params']);
            $controller->setInputPost($_POST);
            $controller->setInputGet($_GET);

            $check = array($controller, $conInfo['method']);
            if(is_callable($check))
                $controller->$conInfo['method']();
            else
                $this->loadView("404");
        }else
        {
            $this->loadView("404");
        }

    }
}