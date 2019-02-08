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

- App/ Arquivos da sua aplicação
- Core/ Arquivos do framework
- App/config/config.php - Arquivo de configuração (timezone, controlador padrão, banco de dados etc...)
