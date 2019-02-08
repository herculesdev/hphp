# H.PHP Framework
Framework para desenvolvimento rápido em PHP, leve e enxuto.

## Features
###### URL Amigáveis;
###### Execução de comandos SQL de forma amigável e segura;
###### Biblioteca de funções comuns;
###### Roteamento automático através do uso de estrutura de diretório + namespaces;
###### Padrão em camadas (MVC);

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
