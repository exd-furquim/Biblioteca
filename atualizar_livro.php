<?php

// atualizar_livro.php
// Recebe os dados do formulário de edição e atualiza o livro
// Conceitos: POST, MySQL, UPDATE (U DO CRUD)

// Protege a página: só usuários logados podem atualizar os livros
require_once __DIR__ . "/verificar_sessao.php";

// Inclui conexão com o banco de dados
require_once __DIR__ . "/conexao.php";

// Confere se o formulário foi enviado pelo método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Método não permitido.");
}

// Recebe e valida os dados enviados pelo formulário de edição
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$titulo = isset($_POST['titulo']) && is_string($_POST['titulo']) ? trim($_POST['titulo']) : '';
$autor = isset($_POST['autor']) && is_string($_POST['autor']) ? trim($_POST['autor']) : '';
$status = isset($_POST['status']) && is_string($_POST['status']) ? $_POST['status'] : '';

if (!$id || $titulo === '' || $autor === '' || !in_array($status, ['disponivel', 'emprestado'], true)) {
    http_response_code(400);
    exit("Dados inválidos para atualizar o livro.");
}

// Prepara o UPDATE para não inserir os dados diretamente no comando SQL
$sql = "UPDATE livros SET titulo = ?, autor = ?, status = ? WHERE id = ?";
$consulta = mysqli_prepare($conexao, $sql);

if (!$consulta) {
    http_response_code(500);
    exit("Não foi possível preparar a atualização do livro.");
}

mysqli_stmt_bind_param($consulta, "sssi", $titulo, $autor, $status, $id);

// Executa o UPDATE no banco de dados
if (!mysqli_stmt_execute($consulta)) {
    mysqli_stmt_close($consulta);
    http_response_code(500);
    exit("Não foi possível atualizar o livro.");
}

mysqli_stmt_close($consulta);

// Redireciona para a listagem após atualizar
header("Location: listar_livro.php");
exit();
