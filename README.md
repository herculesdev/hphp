(setq markdown-xhtml-header-content
      "<style type='text/css'>
h1, h2, pre, div { font-family: monospace; font-size: 1em; line-height: 1.1; -webkit-text-size-adjust: none; }
h1 { font-size: 1.5em; }
h2 { font-size: 1.25em; }
ul.ascii, ul.ascii ul {  margin-left: 0; padding-left: 0;  list-style: none; }

ul.ascii li { margin: 0; padding: 0; }

/* level 1 */
ul.ascii > li::before { content: ""; }

/* level 2 */
ul.ascii > li > ul > li::before { content: "├──\00a0"; }
ul.ascii > li > ul > li:last-child::before { content: "└──\00a0"; }

/* level 3 */
ul.ascii > li > ul > li > ul > li::before { content: "│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0└──\00a0"; }

/* level 4 */
ul.ascii > li > ul > li > ul > li > ul > li::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li:last-child > ul > li::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child > ul > li:last-child::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li > ul > li::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }

/* level 5 */
ul.ascii > li > ul > li > ul > li > ul > li > ul > li::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li > ul > li:last-child > ul > li::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li > ul > li:last-child > ul > li:last-child::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li:last-child > ul > li > ul > li::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li:last-child::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li > ul > li > ul > li::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li > ul > li > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }

/* level 6 */
ul.ascii > li > ul > li > ul > li > ul > li > ul > li > ul > li::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li > ul > li > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li > ul > li > ul > li:last-child > ul > li::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li > ul > li > ul > li:last-child > ul > li:last-child::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li > ul > li:last-child > ul > li > ul > li::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li > ul > li:last-child > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li:last-child::before { content: "│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li:last-child > ul > li > ul > li > ul > li::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child > ul > li > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li:last-child::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li:last-child::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li:last-child::before { content: "│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li > ul > li > ul > li > ul > li::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li > ul > li > ul > li > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li > ul > li > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li > ul > li > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li > ul > li::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li > ul > li:last-child > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li > ul > li::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li > ul > li::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0│\00a0\00a0\00a0└──\00a0"; }
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0├──\00a0"}
ul.ascii > li > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul > li:last-child::before { content: "\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0\00a0└──\00a0"; }
</style>")

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
├── app/
│   ├── config/
│   |   └── config.php
│   ├── model/
│   ├── view/
│   |   ├── 404.php
│   |   └── Welcome.php
│   ├── controller/
│   |   └── Welcome.php
├── core/
│   ├── Config.php
│   ├── Controller.php
│   ├── Model.php
│   └── Router.php
└── public/
│   └── index.php
```
