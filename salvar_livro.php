<?php

// salvar_livro.php
// recebe os dados do formulário de cadastro de livro e salva no banco de dados
// conceitos: POST, MySQL, Insert (CREATE DO CRUD)

// Protege a página: só usuários logados podem salvar livros
include("verificar_sessao.php");

// Inclui o arquivo de conexão com o banco de dados (MySQL)
include("conexao.php");

// Recebe os dados do formulário via POST
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$status = $_POST['status'];

// Prepara a query SQL para inserir os dados na tabela 'livros'
$sql = "INSERT INTO livros (titulo, autor, status)
VALUES ('$titulo', '$autor', '$status')";

// Executa a query no banco de dados
mysqli_query($conexao, $sql);

// Redireciona o usuário de volta para a página de listagem de livros
header("Location: listar_livro.php");
exit();