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
Considerando que exista um servidor instalado e configurado, a instalação do H.PHP Framework é muito simples: baixe e extraia o conteúdo para o diretório `www` do seu web server.  
**Observação:** A pasta raiz `framework` pode ter o seu nome alterado para o nome de sua aplicação, bem como seu conteúdo interno também pode ser colocado no diretório `www` do web server.

### Testando
Após a instalação, podemos testar o funcionamento do framework acessando um dos seguintes links:   
`http://seuservidor/framework/`, caso tenha feito a instalação padrão   
`http://seuservidor/nomeSuaApp/`, caso tenha renomeado a pasta raiz para um nome qualquer  
`http://seuservidor/`, caso tenha colocado o conteúdo interno da pasta raiz direto no diretório `www` do seu web server.  
se tudo correr bem, poderá visualizar o seguinte resultado:

![](https://i.imgur.com/E0Q22K0.png)

# Criando Primeiro Controller
O H.PHP utiliza o padrão MVC, isto significa que a camada de acesso a dados ficam em `App/model`, a parte visual em `App/view` e o controle de fluxo em `App/controller`. Quando uma requisição é feita a um sistema construido sobre o H.PHP Framework, um controlador é acionado e nele você pode escrever o código que acionará a camada de negócios ou carregará uma view.
A requisição se dá através da URL no seguinte formato:    
http://seuhost/framework/controlador/método/

Para exemplificar criaremos em `App/controller` um arquivo chamado `MeuControlador.php`

```php
<?php
namespace App\Controller;

class MeuControlador extends \Core\Controller
{
    public function teste()
    {
      echo "Olá Mundo!";
    }
}
```

Na primeira linha após o `<?php` temos a definição do  namespace do controlador e isto é de extrema importância para que o roteamento funcione adequadamente. A criação dos namepaces deve seguir as seguintes regras:  
1. Nomes em CamelCase
2. O namespace deve ser igual ao caminho do diretório

Exemplificando as regras, imagine que em `App/controller` você crie uma pasta com o nome `moduloX` e dentro dela coloque um controlador `SeuControlador.php`, logo o seu namespace será `App\Controller\ModuloX`.

- Apesar de não ser obrigatório, é extremamente recomendável que o seu controlador herde da classe `Core\Controller`, pois esta fornece um comportamento padrão, sem ela não será possível receber dados via post, get, resgatar parâmetros da URL e diversas outras coisas, logo, dificilmente você encontrará algum motivo para não herdá-la. 

- O método `index()` é o método padrão, ele pode ser acionado mesmo quando omitimos seu nome da URL, passando somente o nome do controlador.
- Através de subpasta, controladores e métodos que você formará as URL's amigáveis do seu sistema.

Para testar basta acessar  
http://seuhost/framework/meuprimeirocontrolador/index   
O endereço http://seuhost/framework/meuprimeirocontrolador/ tem o mesmo efeito do link anterior, pois aqui omitimos o nome 'index' da URL, mas como este é o método padrão e nenhum outro nome foi informado, ele será acionado do mesmo jeito.

Para acionar `segundoMetodo()` use a seguinte URL:
http://seuhost/framework/meuprimeirocontrolador/segundometodo/

# Criando e Carregando Views
Crie um arquivo de nome `minhaView.html` no diretório `App/view`, dentro insira o conteúdo que desejar, tal como o seguinte código HTML  

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Minha View</title>
</head>
<body>
    <h2>Olá Mundo!</h2>
</body>
</html>
```
Para carregá-la a partir de um controlador basta usar a funcionalidade herdada `loadView($view)` da seguinte forma:  
```php
<?php
namespace App\Controller;

class MeuPrimeiroControlador extends \Core\Controller
{
    public function index()
    {
      echo "Olá Mundo!";
    }
    
    public function segundoMetodo()
    {
        // Carrega a view "minhaView.html"
        $this->loadView("minhaView");
    }
}
```

**Observação:** Views por padrão podem ter os formatos  `.PHP` e `.HTML`, no entanto é possível adicionar novos formatos editando o arquivo `App/Config/config.php` adicionando mais elementos na entrada `viewExtensions`. 

#### Enviando dados para a view
O primeiro passo é alterar a extensão da nossa view de `.HTML` para `.PHP` ficando `minhaView.php`, isto é necessário pois agora vamos receber dados do controlador e exibí-los.  

No controlador vamos fazer alterar o `segundoMetodo()` criando um array de nome qualquer e inserindo os dados que desejamos
```php
    public function segundoMetodo()
    {
        $dados['nome'] = 'Hércules M.';
        $dados['idade'] = '21';
        
        // Carrega a view "minhaView.php" e envia o array $dados
        $this->loadView("minhaView", $dados);
    }
}
```
**Observação:** Os dados chegam na view da forma em que foram passados no controlador, então caso queira passar uma única informação, não é necessário criar um array. Pode-se fazer `$dados = 'Hercules';`


No arquivo minhaView.php vamos escrever um código PHP para resgatar e exibir os dados provenientes do controlador
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Minha View</title>
</head>
<body>
    <h2>Olá, meu nome é <?php echo $data['nome'] ?> e tenho <?php echo $data['idade] ?> anos</h2>
</body>
</html>
```
**Observação:** Na view, os dados sempre são recuperados através da variável `$data`, não importa o nome que você deu a ela no controlador.  
**Observação 2:** As views podem ser colocadas em subdiretórios. Ex: dentro de `App/view` podemos criar uma pasta chamada `viewsUsuario` e dentro dela colocar `minhaView.php`, contudo no momento de carregá-la devemos informar o subdiretório.  
O código a seguir ilustra isso:  
`$this->loadView("viewsUsuario/minhaView");`

