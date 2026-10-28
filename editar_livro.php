<?php

// editar_livro.php
// Exibe um formulário para editar os detalhes de um livro existente no banco de dados.
// Conceitos: $_GET, SELECT do CRUD e MySQL.

// Protege a página para que apenas usuários logados posssam editar
require_once __DIR__ . "/verificar_sessao.php";

// Inclui a conexão com o banco de dados
require_once __DIR__ . "/conexao.php";

// Recebe o ID do livro pela URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    exit("ID do livro inválido.");
}

// Busca os detalhes do livro com o ID especificado
$consulta = mysqli_prepare($conexao, "SELECT id, titulo, autor, status FROM livros WHERE id = ?");

if (!$consulta) {
    http_response_code(500);
    exit("Não foi possível buscar o livro.");
}

mysqli_stmt_bind_param($consulta, "i", $id);
mysqli_stmt_execute($consulta);
$resultado = mysqli_stmt_get_result($consulta);
$livro = mysqli_fetch_assoc($resultado);
mysqli_stmt_close($consulta);

if (!$livro) {
    http_response_code(404);
    exit("Livro não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Editar Livro</h1>
        <p class="subtitulo">Altere os detalhes do livro abaixo e clique em "Atualizar Livro"</p>

        <!-- Formulário para editar os detalhes do livro -->
        <form action="atualizar_livro.php" method="POST">
            <input type="hidden" name="id"
                value="<?php echo htmlspecialchars((string) $livro['id'], ENT_QUOTES, 'UTF-8'); ?>">

            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo"
                    value="<?php echo htmlspecialchars($livro['titulo'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor"
                    value="<?php echo htmlspecialchars($livro['autor'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="disponivel" <?php if ($livro['status'] == 'disponivel')
                        echo 'selected'; ?>>Disponível
                    </option>
                    <option value="emprestado" <?php if ($livro['status'] == 'emprestado')
                        echo 'selected'; ?>>Emprestado
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Atualizar Livro</button>
        </form>

        <a href="listar_livro.php" class="btn btn-voltar">Voltar para a listagem</a>
    </div>

</body>

</html>