# Processo seletivo Vidya Code

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Sumário</summary>
  <ol>
    <li>
      <a href="#sobre-o-projeto">Sobre o Projeto</a>
      <ul>
        <li><a href="#desenvolvido-com">Desenvolvido com</a></li>
      </ul>
    </li>
    <li>
      <a href="#abrindo-o-projeto">Abrindo o Projeto</a>
      <ul>
        <li><a href="#pre-requisitos">Pre-requisitos</a></li>
        <li><a href="#instalação">Instalação</a></li>
      </ul>
    </li>
    <li>
      <a href="#funcionalidades-do-projeto">Funcionalidades do projeto</a>
      <ul>
        <li>
          <a href="#tela-de-cadastro-de-cliente">Tela de cadastro de cliente</a>
        </li>
        <li><a href="#tela-de-cadastro-de-produto">Tela de cadastro de produto</a>
        </li>
        <li><a href="#tela-de-cadastro-de-compras-(vínculo-de-produtos-e-clientes)">
          Tela de cadastro de Compras (vínculo de Produtos e Clientes)
        </a>
        </li>
        <li>
          <a href="#tela-de-consulta">Tela de consulta</a>
          <ul>
            <li><a href="#consulta-de-clientes">Consulta de clientes</a></li>
            <li><a href="#consulta-de-produtos">Consulta de produtos</a></li>
            <li><a href="#consulta-de-compras">Consulta de compras (vínculos)</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
    <a href="#sobre-a-api">Sobre a API</a>
    <ul>
      <li><a href="#listar-clientes">Listar Clientes</a></li>
      <li><a href="#listar-cliente">Listar Cliente</a></li>
      <li><a href="#cadastrar-cliente">Cadastrar cliente</a></li>
      <li><a href="#Editar-cliente">Editar cliente</a></li>
      <li><a href="#deletar-cliente">Deletar cliente</a></li>
      <li><a href="#listar-produtos">Listar Produtos</a></li>
      <li><a href="#listar-produto">Listar Produto</a></li>
      <li><a href="#cadastrar-produto">Cadastrar Produto</a></li>
      <li><a href="#editar-produto">Editar Produto</a></li>
      <li><a href="#deletar-produto">Deletar Produto</a></li>
      <li><a href="#listar-compras">Listar Compras</a></li>
      <li><a href="#listar-compra">Listar Compra</a></li>
      <li><a href="#cadastrar-Compra">Cadastrar Compra</a></li>
      <li><a href="#editar-Compra">Editar Compra</a></li>
      <li><a href="#deletar-compra">Deletar Compra</a></li>
      <li><a href="#atualizar-compras">Atualizar Compras</a></li>
    </ul>
    </li>
  </ol>
</details>

## Sobre o Projeto

![alt text](/images/home.png)

Este projeto foi desenvolvido para a etapa de teste técnico do processo seletivo da [Vidya Code](https://vidyacode.com.br/).  
A seguir estão listados os requisitos do projeto:
  - [x] Criação de Banco de dados Relacional
  - [x] Tela para cadastro de clientes
  - [x] Tela para cadastro de produtos
  - [x] Tela para cadastro de vínculo entre produtos e clientes com data de validade
  - [x] Bloquear exclusão de produtos vinculados a um cliente
  - [x] Procedimento para atualizar as datas de validade de vínculo dos produtos de um determinado cliente

A seguir estão listados os requisitos bônus do projeto:
  - [x] O campo de CNPJ na tela de cadastro de clientes deve servir de gatilho para uma consulta via api dos dados da empresa
  - [x] O campo de CEP na tela de cadastro de clientes deve servir de gatilho para uma consulta via api ao endereço da empresa
  - [x] Criar a modelagem de banco de dados com base nas tabelas criadas
  - [x] Crie um README no github bem documentado contendo todos os objetos, modelagem, prints da tela de todo trabalho desenvolvido.
  - [x] Realizar a validação dos campos no formulário de cadastro de produtos.
  - [x] Utilize o Composer para gerenciar as dependências
  - [x] Utilize Migrations para as tabelas criadas
  - [x] Deixe seu código mais legível utilizando Padrões de Projeto
  - [x] Utilize um container em docker para subir seu servidor PHP e seu banco de dados de sua preferência.

### Desenvolvido com 

* [![php][php]][php-url]
* [![Vue][Vue.js]][Vue-url]
* [![Mysql][Mysql]][Mysql-url]

### Diagrama de Entidade Relacionamento
![der projeto](/images/DER.png)

## Abrindo o Projeto

O projeto foi desenvolvido de maneira que pode ser inicializado tanto localmente, quanto com o uso do docker compose

### Pre-requisitos
  O projeto foi configurado para rodar dentro de containers, portanto, certifique-se que:
  <ul>
    <li>Caso possua uma instância do Mysql rodando na sua máquina (Porta 3306) pare ela, pois o container do mysql irá utilizar a porta 3306
    </li>
    <li>O <a href="https://www.docker.com/" target="_blank">Docker</a> instalado</li>
    <li>O <a href="https://docs.docker.com/compose/install/">Docker compose</a> instalado</li>
    li>que as portas 3000 (server) e 5173 (frontend) estão livres</li>
  </ul> 

<hr />

### Instalação

Para começar, faça o clone do repositório para a sua máquina

via ssh:
   ```sh
   git clone git@github.com:ArthurVianna96/PS_VidyaCode.git
   ```

via https:
   ```sh
   git clone https://github.com/ArthurVianna96/PS_VidyaCode.git
   ```

Uma vez clonado o repositório agora vamos iniciar o projeto.

#### Docker :whale:

<hr />

Dentro da raiz do projeto, rode a rede de containers
para Docker Compose < 1.29.2
   ```sh
   docker-compose up -d
   ```
Para Docker compose >= 1.29.2
Agora roda as migrations do banco de dados
   ```sh
   docker compose up
   ```
ATENÇÃO: os próximos passos só serão necessários na primeira vez que o projeto for inicializado  

entre no container do server
  ```sh
  docker -exec -it server sh
  ```
e rode as migrations do banco de dados
  ```sh
  vendor/bin/phinx migrate
  ```

## Funcionalidades do projeto

### Tela de cadastro de cliente

![tela de cadastro de cliente](/images/cadastro-clientes.png)
Esta tela consiste de um formulário para cadastro de um cliente no sistema. Os campos CNPJ e CEP possuem uma conexão com duas api's, [publica cnpj](https://publica.cnpj.ws) e [via cep](https://viacep.com.br) respectivamente, para coleta de dados sobre o cliente a ser cadastrado.

### Tela de cadastro de produto
![tela de cadastro de produto](/images/cadastro-produtos.png)
Esta tela consiste de um formulário para cadastro de produtos no sistema. 

### Tela de cadastro de Compras (vínculo de Produtos e Clientes)
![tela de compras](/images/cadastro-compras.png)
Esta tela consiste de um formulário para cadastro de produtos no sistema. Para este formulário, é necessário ter previamente cadastrado pelo menos um cliente e um produto no sistema, visto que é necessário selecionar um de cada campo no formulário bem como a data de validade do vínculo.

### Tela de consulta
![tela de consulta](/images/home-sem-consulta.png)
Esta tela é a tela de entrada do sistema. Aqui é possível visualizar todos os registros no sistema, basta escolher o tipo de consulta que deseja fazer. Os tipos de consulta disponíveis são:
- Cliente
- Produto
- Compras (vínculo de Produto e Cliente)

#### Consulta de clientes
![tela de consulta de clientes](/images/home-clientes.png)
Selecionando a consulta por clientes uma tabela contendo todos os clientes cadastrados e suas respectivas informações irá aparecer.  
Além de poder visualizar as informações dos clientes, algumas ações são possíveis, sendo elas:
- Editar um cliente (primeiro botão na seção de Ações):
  - Um formulário pré preenchido parecido com o de cadastro de cliente irá aparecer, basta editar o campo que deseja e salvar a alteração.
  ![edição de cliente](/images/edicao-cliente.png)
- Atualizar a data de validade de todos as compras (vínculos daquele cliente)( segundo botão na seção de Ações)
  - Um formulário perguntando a quantidade de dias a serem adicionados em todos os vínculos irá aparecer.
  - No formulário já existe uma quantidade padrão 30 de dias a serem adicionados. Caso não seja o desejado, basta alterar o valor no campo.
  ![atualização de cliente](/images/atualizacao-cliente.png)
- Deletar um cliente (último botão na seção de ações):
  - Basta clicar no icone para deletar o cliente
  - Clientes já vinculados a uma compra (vínculo) não poderão ser deletados, será necessário apagar todos os seus vínculos antes

<hr />

#### Consulta de Produtos
![tela de consulta de produtos](/images/home-produtos.png)
Selecionando a consulta por produtos uma tabela contendo todos os produtos cadastrados e suas respectivas informações irá aparecer.  
Além de poder visualizar as informações dos produtos, algumas ações são possíveis, sendo elas:
- Editar um produto (primeiro botão na seção de Ações):
  - Um formulário pré preenchido parecido com o de cadastro de produto irá aparecer, basta editar o campo que deseja e salvar a alteração.
  ![edição de produto](/images/edicao-produto.png)
- Deletar um produto (último botão na seção de ações):
  - Basta clicar no icone para deletar o produto
  - Produtos já vinculados a uma compra (vínculo) não poderão ser deletados, será necessário apagar todos os seus vínculos antes

<hr />

#### Consulta de Compras
![tela de consulta de compras](/images/home.png)
Selecionando a consulta por compras uma tabela contendo todos as compras cadastrados e suas respectivas informações irá aparecer.  
Além de poder visualizar as informações das compras, algumas ações são possíveis, sendo elas:
- Editar uma compra (primeiro botão na seção de Ações):
  - Um formulário pré preenchido parecido com o de cadastro de compra irá aparecer, basta editar o campo que deseja e salvar a alteração.
  ![edição de compra](/images/edicao-compra.png)
- Deletar um compra (último botão na seção de ações):
  - Basta clicar no icone para deletar a compra

## Sobre a API
Para o projeto foi desenvolvida uma API Restful que possui as seguintes funcionalidades:

### Listar clientes
  Retorna um JSON contendo todos os clientes

* **Endpoint**

  /client

* **Méthodo:**

  `GET`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br />
    ```json
    [
      {
        "id": 1,
        "company": "VIDYA CODE LTDA",
        "fictional_name": "VIDYA CODE",
        "register_number": "20.060.683/0001-80",
        "zip_code": "53417-350",
        "address": "Rua José Maria",
        "number": "107",
        "district": "Artur Lundgren I",
        "city": "Paulista",
        "state": "PE",
        "email": "vidyacode@vidyacode.com",
        "phone": "(61) 99626-8850"
      }
    ]
    ```
### Listar Cliente

  Retorna um JSON contendo um cliente.

* **Endpoint**

  /client/:id

* **Méthodo:**

  `GET`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    {
      "id": 1,
      "company": "VIDYA CODE LTDA",
      "fictional_name": "VIDYA CODE",
      "register_number": "20.060.683/0001-80",
      "zip_code": "53417-350",
      "address": "Rua José Maria",
      "number": "107",
      "district": "Artur Lundgren I",
      "city": "Paulista",
      "state": "PE",
      "email": "vidyacode@vidyacode.com",
      "phone": "(61) 99626-8850"
    }
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum cliente encontrado"
  }`

### Cadastrar Cliente

  Cadastra um cliente no banco de dados. Retorna um JSON contendo as informações do cliente cadastrado.

* **Endpoint**

  /client

* **Méthodo:**

  `POST`

* **Body:**

  ```json
  {
      "company": "VIDYA CODE LTDA",
      "fictional_name": "VIDYA CODE",
      "register_number": "20.060.683/0001-80",
      "zip_code": "53417-350",
      "address": "Rua José Maria",
      "number": "107",
      "district": "Artur Lundgren I",
      "city": "Paulista",
      "state": "PE",
      "email": "vidyacode@vidyacode.com",
      "phone": "(61) 99626-8850"
  }
  ```
  
* **Sucesso:**

  * **Status:** 201 <br />
    **Conteúdo:** <br /> 
    ```json
    {
      "company": "VIDYA CODE LTDA",
      "fictional_name": "VIDYA CODE",
      "register_number": "20.060.683/0001-80",
      "zip_code": "53417-350",
      "address": "Rua José Maria",
      "number": "107",
      "district": "Artur Lundgren I",
      "city": "Paulista",
      "state": "PE",
      "email": "vidyacode@vidyacode.com",
      "phone": "(61) 99626-8850"
    }
    ```
 
* **Erro:**

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Editar Cliente

  Edite um cliente no banco de dados. Retorna um JSON contendo as informações do cliente editado.

* **Endpoint**

  /client/:id

* **Méthodo:**

  `PUT`

* **Body:**

  ```json
  {
      "company": "VIDYA CODE LTDA",
      "fictional_name": "VIDYA CODE",
      "register_number": "20.060.683/0001-80",
      "zip_code": "53417-350",
      "address": "Rua José Maria",
      "number": "107",
      "district": "Artur Lundgren I",
      "city": "Paulista",
      "state": "PE",
      "email": "vidyacode@vidyacode.com",
      "phone": "(61) 99626-8850"
  }
  ```
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    null
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum cliente encontrado"
  }`

  OU

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Deletar Cliente

  Deleta um cliente do banco de dados.

* **Endpoint**

  /client/:id

* **Méthodo:**

  `DELETE`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    null
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum cliente encontrado"
  }`

  OU

  * **Status:** 409 CONFLICT <br />
    **Conteúdo:** `{
  "message": "O cliente está vinculado a uma compra e por isso não pode ser excluído"
  }`

    OU 

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Listar produtos
  Retorna um JSON contendo todos os produtos

* **Endpoint**

  /product

* **Méthodo:**

  `GET`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br />
    ```json
    [
      {
        "id": 1,
        "name": "OUTHACK",
        "description": "Software da empresa OUTHACK",
        "version": "1.0.1"
      },
      {
        "id": 2,
        "name": "Revit",
        "description": "Software de modelagem BIM",
        "version": "1.0.2"
      },
      {
        "id": 3,
        "name": "AutoCAD",
        "description": "Software para desenho 2D e 3D",
        "version": "8.2.1"
      }
    ]
    ```
### Listar Produto

  Retorna um JSON contendo um produto.

* **Endpoint**

  /product/:id

* **Méthodo:**

  `GET`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    {
      "id": 1,
      "name": "OUTHACK",
      "description": "Software da empresa OUTHACK",
      "version": "1.0.1"
    }
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum produto encontrado"
  }`

### Cadastrar Produto

  Cadastra um produto no banco de dados. Retorna um JSON contendo as informações do produto cadastrado.

* **Endpoint**

  /product

* **Méthodo:**

  `POST`

* **Body:**

  ```json
    {
      "name": "OUTHACK",
      "description": "Software da empresa OUTHACK",
      "version": "1.0.1"
    }
    ```
  
* **Sucesso:**

  * **Status:** 201 <br />
    **Conteúdo:** <br /> 
  ```json
    {
      "name": "OUTHACK",
      "description": "Software da empresa OUTHACK",
      "version": "1.0.1"
    }
    ```
 
* **Erro:**

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Editar Produto

  Edite um produto no banco de dados. Retorna um JSON contendo as informações do produto editado.

* **Endpoint**

  /product/:id

* **Méthodo:**

  `PUT`

* **Body:**

  ```json
  {
    "name": "OUTHACK",
    "description": "Software da empresa OUTHACK",
    "version": "1.0.1"
  }
  ```
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    null
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum produto encontrado"
  }`

  OU 
  
  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Deletar Produto

  Deleta um produto do banco de dados.

* **Endpoint**

  /product/:id

* **Méthodo:**

  `DELETE`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    null
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum produto encontrado"
  }`

  OU

  * **Status:** 409 CONFLICT <br />
    **Conteúdo:** `{
  "message": "O produto está vinculado a uma compra e por isso não pode ser excluído"
  }`

    OU 

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Listar compras
  Retorna um JSON contendo todos as compras

* **Endpoint**

  /purchase

* **Méthodo:**

  `GET`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br />
    ```json
    [
      {
        "id": 1,
        "client_id": 1,
        "client": "VIDYA CODE LTDA",
        "product": "OUTHACK",
        "product_id": 1,
        "expirationDate": "2023-02-17 00:00:00"
      },
      {
        "id": 2,
        "client_id": 1,
        "client": "VIDYA CODE LTDA",
        "product": "AutoCAD",
        "product_id": 3,
        "expirationDate": "2023-02-09 00:00:00"
      }
    ]
    ```
### Listar Compra

  Retorna um JSON contendo um compra.

* **Endpoint**

  /purchase/:id

* **Méthodo:**

  `GET`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    {
      "id": 1,
      "client_id": 1,
      "client": "VIDYA CODE LTDA",
      "product": "OUTHACK",
      "product_id": 1,
      "expirationDate": "2023-02-17 00:00:00"
    }
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum vínculo encontrado"
  }`

### Cadastrar Compra

  Cadastra uma compra no banco de dados. Retorna um JSON contendo as informações da compra cadastrada.

* **Endpoint**

  /purchase

* **Méthodo:**

  `POST`

* **Body:**

  ```json
    {
      "productId": 1,
      "clientId": 2,
      "expirationDate": "2023-01-28"
    }
    ```
  
* **Sucesso:**

  * **Status:** 201 <br />
    **Conteúdo:** <br /> 
  ```json
    {
      "productId": 2,
      "clientId": 2,
      "expirationDate": "2023-01-28"
    }
    ```
 
* **Erro:**

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`
  
### Editar Compra

  Edite uma compra no banco de dados. Retorna um JSON contendo as informações da compra editada.

* **Endpoint**

  /purchase/:id

* **Méthodo:**

  `PUT`

* **Body:**

  ```json
  {
    "productId": 1,
    "clientId": 2,
    "expirationDate": "2023-01-28"
  }
  ```
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    null
    ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum produto encontrado"
  }`

  OU

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Deletar Compra

  Deleta uma compra do banco de dados.

* **Endpoint**

  /purchase/:id

* **Méthodo:**

  `DELETE`
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
    ```json
    null
    ```
  
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
  "message": "Nenhum produto encontrado"
  }`

  OU

  * **Status:** 500 SERVER ERROR <br />
    **Conteúdo:** `{
  "message": <mensagem de erro>
  }`

### Atualizar compras

  Atualiza todas as compras (vínculos) de um cliente em `daysToAdd` dias. Retorna um JSON contendo todos os vínculos do cliente.

* **Endpoint**

  /expiration

* **Méthodo:**

  `POST`

* **Body:**

  ```json
    {
      "clientId": 1,
      "daysToAdd": 30
    }
  ```
  
* **Sucesso:**

  * **Status:** 200 <br />
    **Conteúdo:** <br /> 
  ```json
    [
      {
        "id": 1,
        "client_id": 1,
        "client": "VIDYA CODE LTDA",
        "product": "OUTHACK",
        "product_id": 1,
        "expirationDate": "2023-03-19 00:00:00"
      },
      {
        "id": 5,
        "client_id": 1,
        "client": "VIDYA CODE LTDA",
        "product": "OUTHACK",
        "product_id": 1,
        "expirationDate": "2023-02-27 00:00:00"
      },
      {
        "id": 2,
        "client_id": 1,
        "client": "VIDYA CODE LTDA",
        "product": "AutoCAD",
        "product_id": 3,
        "expirationDate": "2023-03-11 00:00:00"
      }
    ]
  ```
 
* **Erro:**

  * **Status:** 404 NOT FOUND <br />
    **Conteúdo:** `{
    "message": "Client does not have any products registered"
  }`

[php]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[php-url]: https://www.php.net/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Mysql]: https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white
[Mysql-url]: https://www.mysql.com/
