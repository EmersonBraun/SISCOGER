# SISCOGER
## Descrição
Sistema de controle processual da PMPR, dentre eles:  
### Processos:
+ **A**puração **D**isciplinar de **L**icenciamento
+ **C**onselho de **D**isciplina
+ **C**onselho de **J**ustificação
+ **F**ormulário de **A**puração de **T**ransgressão **D**isciplinar
+ **P**rocedimento **AD**ministrativo
### Procedimentos:
+ **A**uto de **P**risão em **F**lagrante **D**elito
+ Deserção
+ Exclusão
+ **I**nquérito **P**olicial **M**ilitar
+ **I**nquérito **S**anitário de **O**rigem
+ **I**nquérito **T**écnico
+ Procedimento Outros
+ Recursos
+ Sindicância
## Frameworks/linguagens usados
### [Laravel](https://laravel.com/) 
Framework feito em PHP para auxiliar a estrutura do Back-end da aplicação
### [Vue.js](https://vuejs.org/)
Framework feito em javascript para auxiliar na criação de componentes para o front-end da aplicação
## Estrutura da aplicação:
siscoger
+ app (MVC)
    + Console
    + Exceptions (exceções tratamento 404, etc)
    + Helpers (Funções globais)
    + Http
        + Controllers (controladores - processam as models e devolvem views)
        + Middleware (filtros)
    + Mail (Controle de emails)
    + Models (modelos - representação do banco de dados)
    + Notifications (Email - do sistema)
    + Presenters (camada para retirar lógica das views)
    + Providers 
    + Repositories (camada para fazer as buscas no banco de dados)
    + Rules (regras de validação)
+ bootstrap (inicialização da aplicação)
+ config
    + adminlte.php (configurações como nome da aplicação e menu)
    + app.php (configurações gerais da aplicação)
    + sistem.php (dados usados em toda aplicação, como postos/graduações, andamentos)
+ database
    + migrations (migrações - onde são criadas as tabelas do banco de dados)
    + seeds (semeadores)
+ node_modules 
+ public
    + css (estilos da aplicação)
    + fonts (fontes)
    + img (imagens usadas, brasões)
    + js (funcionalidades da aplicação)
    + vendor
        + adminlte (arquivos de estilo do template da aplicação)
        + plugins (funcionalidades em js para a aplicação)
+ resources
    + assets
        + js 
            + components (componentes da aplicação)
            + store
            + utils
            + app.js (**configurações gerais VUE**)
            + bootstrap.js (inicialização VUE)
            + components.js (registro de componentes para webpack)
            + filters.js (filtros)
            + mixins.js (funções e dados repetidos)
    + lang (linguagens e traduçẽos)
    + views (visão - telas para os usuários)
        + vendor
            + adminlte (template principal)    
+ routes
    + api.php (rotas - via ajax e axios)
    + web.php (rotas - pegam as URL e encaminham a um controlador)
+ storage (arquivos do sistema)
    + app
    + arquivos (uploads)
    + framework (módulos de dependências)
+ tests (testes do sistema)
+ vendor (arquivos das dependêcnias do sistema)
.babelrc (configuração para importar componentes dinamicamente)  
.env (dados sensíveis do sistema)  
.gitignore (arquivos que são ignoradas quando for subir para o repositório)  
.htaccess (apontamento para a pasta pública)
artinan (comandos para auxiliar no desenvolvimento)
composer.json (lista de dependências do sistema)
pacotes.txt (pacotes usados no sistema)

