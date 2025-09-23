📁 Estrutura do Projeto
├── 📄 index.php                 # Front Controller (Roteador)
├── 📄 .htaccess                 # Configuração de URLs amigáveis
├── 📄 database.sql              # Script de criação do banco
├── 📁 generic/
│   ├── 📄 Autoload.php          # Autocarregamento de classes
│   └── 📄 MysqlSingleton.php    # Conexão com banco (Singleton)
├── 📁 controller/               # Controladores (Controllers)
│   ├── 📄 HomeController.php
│   ├── 📄 DoadorController.php
│   ├── 📄 InstituicaoController.php
│   └── 📄 DoacaoController.php
├── 📁 service/                  # Lógica de Negócio (Services)
│   ├── 📄 DoadorService.php
│   ├── 📄 InstituicaoService.php
│   └── 📄 DoacaoService.php
├── 📁 dao/                      # Acesso a Dados (DAO)
│   ├── 📄 IDoadorDAO.php
│   ├── 📄 DoadorDAO.php
│   ├── 📄 IInstituicaoDAO.php
│   ├── 📄 InstituicaoDAO.php
│   ├── 📄 IDoacaoDAO.php
│   └── 📄 DoacaoDAO.php
├── 📁 model/                    # Modelos de Dados
│   ├── 📄 Doador.php
│   ├── 📄 Instituicao.php
│   └── 📄 Doacao.php
├── 📁 template/                 # Templates (Views)
│   ├── 📄 ITemplate.php
│   ├── 📄 HomeTemplate.php
│   ├── 📄 DoadorTemplate.php
│   ├── 📄 InstituicaoTemplate.php
│   └── 📄 DoacaoTemplate.php
└── 📁 views/                    # Arquivos de Visualização
    ├── 📁 includes/
    │   ├── 📄 header.php
    │   └── 📄 footer.php
    ├── 📁 home/
    │   └── 📄 dashboard.php
    ├── 📁 doador/
    │   ├── 📄 listar.php
    │   ├── 📄 formulario.php
    │   └── 📄 detalhes.php
    ├── 📁 instituicao/
    │   ├── 📄 listar.php
    │   ├── 📄 formulario.php
    │   └── 📄 detalhes.php
    └── 📁 doacao/
        ├── 📄 listar.php
        ├── 📄 formulario.php
        └── 📄 detalhes.php



        