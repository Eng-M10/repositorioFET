# FET - Repositório Científico

Bem-vindo ao Repositório Científico da Faculdade de Engenharias da UP-Maputo (FET). Este projeto foi desenvolvido para fornecer uma plataforma centralizada para armazenar, gerenciar e compartilhar trabalhos científicos produzidos pelos estudantes e professores da faculdade.

## Funcionalidades

- **Upload de Documentos:** Faça o upload de artigos, monografias, e outros documentos científicos relevantes.
- **Pesquisa Avançada:** Explore o repositório através de uma pesquisa avançada para encontrar trabalhos específicos.
- **Comentários e Avaliações:** Colabore com outros usuários através de comentários e avaliações nos documentos.

## Requisitos do Sistema

- PHP 7.x
- MySQL 5.x
- Apache

## Instalação

1. Clone o repositório para o seu ambiente local:

    ```bash
    git clone https://github.com/Eng-M10/repositorioFET.git
    ```

2. Configure o banco de dados MySQL com as credenciais apropriadas em `config/database.php`.

3. Importe o esquema do banco de dados usando o arquivo SQL fornecido em `database/lr.sql`.

4. Inicie seu servidor web.

5. Acesse o aplicativo através do navegador web:

    ```
    http://localhost/repositorioFET
    ```

## Contribuição

Se você deseja contribuir para o desenvolvimento deste projeto, siga estas etapas:

1. Faça um fork do repositório.
2. Crie uma branch para suas alterações:

    ```bash
    git checkout -b feature/nova-funcionalidade
    ```

3. Faça suas alterações e faça commit:

    ```bash
    git commit -am 'Adiciona nova funcionalidade'
    ```

4. Faça push para o seu fork:

    ```bash
    git push origin feature/nova-funcionalidade
    ```

5. Crie um pull request.

## Licença

Este projeto está licenciado sob a [Licença MIT](LICENSE).
