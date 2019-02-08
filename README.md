# H.PHP Framework
Framework leve e enxuto para desenvolvimento rápido em PHP.

## Features
- URL Amigáveis;
- Roteamento automático através do uso de estrutura de diretório + namespaces;
- Execução de comandos SQL de forma amigável e segura;
- Biblioteca de funções comuns;
- Padrão em camadas (MVC);

## Estrutura de diretórios
```
framework/
├── .htaccess
├── autoload.php
├── app/
│   ├── config/
│   |   └── config.php
│   ├── Controller/
|   │   ├── Home
│   |   |   └── Welcome.php
│   ├── Model/
│   ├── View/
│   |   ├── 404.php
│   |   └── Welcome.php
├── core/
│   ├── helpers/
│   |   └── utils.php
│   ├── Config.php
│   ├── Controller.php
│   ├── Model.php
│   └── Router.php
└── public/
│   ├── .htaccess
│   └── index.php
```

#### Pastas e arquivos importantes
- Framework/ - Pasta raiz, pode ser alterado para o nome de sua aplicação
- App/ - Arquivos da sua aplicação
- Core/ - Arquivos do framework
- App/config/config.php - Arquivo de configuração (timezone, controlador padrão, banco de dados etc...)

# Instalação
Considerando que já tenha um web server funcionando, pouca ou nenhuma configuração precisa ser feita para instalação do framework, basta baixar e extrair a pasta no diretório do seu servidor. Obs: a pasta raiz "framework/" pode ter seu nome alterado para o nome de sua aplicação, ou ainda, pode extrair o conteúdo interno dessa pasta para o diretório do seu web server, sendo que dessa forma não precisará informar a pasta após a url para que seja possível acessar o sistema.

# Testando
Após instalação, basta testar acessando a url no formato seuhost/framework, ex: http://localhost/framework ou ainda http://localhost/ caso tenha extraído conteúdo interno da pasta "framework/" para a raiz do web server.

# Criando primeiro controller/página
O H.PHP utiliza o padrão MVC, isto significa que a camada de acesso a dados ficam em "model/", a parte visual em "view/" e o controle de fluxo em "controller/". Quando uma requisição é feita a um sistema que utiliza o H.PHP Framework, um controlador é acionado, e este por sua vez aciona os models e/ou views responsáveis pelo processamento e apresentação dos dados.
A requisição se dá através da url no seguinte formato http://seuhost/framework/controlador/método/ ou ainda http://seuhost/framework/subpasta/controlador/método

**Exemplos:**  
http://localhost/framework/user/login, **user** e **login** são respectivamente **controlador** e **método**
http://localhost/framework/auth/user/login, **auth**, **user** e **login** são espectivamente **subpasta**, **controlador** e **método**

Obs: Mais adiante veremos que podemos passar parâmetros pela URL, então nem sempre que tivermos uma URL como a do segundo exemplo significará que teremos exatamente uma ou mais subpastas.

Entendido, tudo isto, vamos prosseguir com a prática. Dentro  da pasta App/controller crie um arquivo com o nome que desejar, por exemplo MeuPrimeiroControlador.php

Dentro do arquivo, escreva o esqueleto básico de um controller no H.PHP Framework:

```php
?php
namespace App\Controller\Home;

class MeuPrimeiroControlador extends \Core\Controller
{
    public function index()
    {
      echo "Olá Mundo!
    }
}
```


