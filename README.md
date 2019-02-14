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

### Namespaces
Na primeira linha após o `<?php` temos a definição do  namespace do controlador e isto é de extrema importância para que o roteamento funcione adequadamente. A criação dos namepaces deve seguir as seguintes regras:  
1. Nomes em CamelCase
2. O namespace deve ser igual ao caminho do diretório

Exemplificando as regras, imagine que em `App/controller` você crie uma pasta com o nome `moduloX` e dentro dela coloque um controlador `SeuControlador.php`, logo o seu namespace será `App\Controller\ModuloX`.

### Herança
Apesar de não ser obrigatório, é extremamente recomendável que o seu controlador herde da classe `Core\Controller`, pois esta fornece um comportamento padrão, sem ela não será possível receber dados via post, get, resgatar parâmetros da URL e diversas outras coisas, logo, dificilmente você encontrará algum motivo para não herdá-la. 

### Testando
Acesse http://seuservidor/framework/meucontrolador/teste, se tudo correr bem o seguinte resultado deve ser visualizado:

![](https://i.imgur.com/6F3uxjK.jpg)

Você pode criar outros métodos e executá-los acessando a URL sempre no formato seuservidor/framework/seuControlador/seuMetodo

### Método Especial index()
Caso queira, pode-se criar um método `index()` ele é conhecido por "Método Padrão" e é acionado automaticamente quando você não informa o nome do método na URL, ex: http://seuservidor/framework/meucontrolador

# Criando e Carregando Views
As views são a parte visual da aplicação e normalmente é formada de códigos mistos (PHP, HTML, CSS e JavaScript). Para gerar sua primeira view, crie no diretório `App/view` um arquivo de nome `minhaView.html` e insira nele o seguinte código:
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
Agora precisamos carregá-la e renderizá-la a partir de um controlador, para tal iremos utilizar a funcionalidade herdada `loadView()`. Reaproveitando o controlador criado na sessão "Criando Primeiro Controller" o código fica da seguinte forma:

```php
<?php
namespace App\Controller;

class MeuControlador extends \Core\Controller
{
    public function teste()
    {
      $this->loadView("minhaView);
    }
}
```

**Observação:** Você deve ter notado que passamos somente o nome da view, sem a extensão ".html" para a função `loadView()`, isto é feito desta forma pois o H.PHP Framework procura e detecta automaticamente a extensão. Por padrão, são aceitos os formatos `.PHP` e `.HTML`, sendo perfeitamente possível adicionar novas extensões alterando a entrada `viewExtensions` no arquivo `App/Config/config.php`.

Feito isso, acesse http://seuservidor/framework/meucontrolador/teste para visualizar o resultado:

![](https://i.imgur.com/oRRtt2K.jpg)

### Enviando dados para view
No controlador vamos alterar o método `teste()` criando um array de nome qualquer e inserindo os dados que desejamos enviar para a view
```php
    public function teste()
    {
        $dados['nome'] = 'Hércules M.';
        $dados['idade'] = '21';
        
        // Carrega a view "minhaView.php" e envia o array $dados
        $this->loadView("minhaView", $dados);
    }
}
```
**Observação:** Os dados chegam na view da forma em que foram enviados pelo controlador, logo os índices podem ser associativos, numéricos ou sequer precisa ser um array.

Na view alteraremos a extensão do arquivo de `.html` para `.php`, ficando então `minhaView.php`. Isto é necessário pois agora receberemos dados de forma dinâmica provenientes do controlador e para tal utilizaremos códigos em PHP embebidos em meio ao HTML.  
O arquivo fica com o seguinte código:
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
**Observação 2:** As views podem ser colocadas em subdiretórios, bastanto informá-los no momento em que carregar a view.  
Ex: `$this->loadView("subdiretorio/minhaView");`

# Models
A camada models é conhecida como a camada em que se implementa as regras de negócio e onde se dá o acesso a dados. Para gerar seu primeiro model, crie um arquivo `MeuModelo.php` em `App/Models`.

Dentro escreva o esqueleto básico de um model.
```php
<?php
namespace App\Model;

class MeuModel extends \Core\Model
{

}
```
É extremamente recomendável que seus modelos extenda o comportamento da classe `\Core\Model`, no entanto isto não é obrigatório. Alguns desenvolvedores aplicam o padrão DAO, criando uma camada extra dentro de `App/Model`. Neste caso, como as DAO's realizaram as operações com banco de dados, os mesmos devem herdar de `\Core\Model` e as demais classes não-DAO's podem servir apenas de modelo de dados.

### Fazendo INSERT
Para realizar operação insert no banco de dados de forma fácil, basta utilizarmos a funcionalidade herdada `create()`, passando os seguintes parâmetros:  
- String $table - nome da tabela
- Array $data - array associativo em que a chave(índice) é o nome do campo e o valor é e a informação a ser guardada no campo.

```php
public function inserirUsuario($nome, $email, $senha) {
    $dados['nome'] = $nome;
    $dados['email'] = $email;
    $dados['senha'] = $senha;
    
    $this->create("users", $dados);
}
```
### Fazendo SELECT
O Select pode ser feito de duas formas  
**1. Com a funcionalidade herdada `read()`**
Para realizar um select com o `read()` é muito fácil, basta chamar a função passando os parâmetros:
 - String $table - nome da tabela
 - Array $columns - array contendo as colunas que deseja trazer do banco
 ```php
public function obterUsuarios() {
    $campos = array("id", "nome", "email");    
    $this->read("users", $campos);
}
```
O retorno da função é um array de índices numéricos sendo que cada elemento é outro array associativo com os dados.

**2. Com as funcionalidades herdadas `select()`, `from()` e `execSelect()`**

### Fazendo UPDATE

### Fazendo DELETE

### Cláusula WHERE

