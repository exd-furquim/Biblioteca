<?php
 
 // excluir_livro.php
 // Remove um livro do banco de dados com base no ID.
 // Conceitos: $_GET, DELETE DO CRUD, MySQL
 
 // Protege a página para que apenas usuários logados possam acessar
 include("verificar_sessao.php");
 
 // Inclui a conexão com o banco de dados
 include("conexao.php");
 
 // Recebe o ID do livro pela URL
 $id = $_GET['id'];
 
 //Monta a query SQL para deletar o livro com o ID especificado
 $sql = "DELETE FROM livros WHERE id = $id";

 // Executa o DELETE no banco de dados
 mysqli_query($conexao, $sql);

 //Redireciona para a página de listagem de livros após a exclusão
    header("Location: listar_livro.php");
    exit();