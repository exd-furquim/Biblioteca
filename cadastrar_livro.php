<?php

// Protege a página: só usuários logadosmpodem cadastrar livros
require_once __DIR__ . "/verificar_sessao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro - Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Cadastrar Livro</h1>
        <p class="subtitulo">Preencha os dados do livro.</p>

        <!-- Formulário envia os dados para salvar_livro.php -->
        <form action="salvar_livro.php" method="POST">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required placeholder="Digite o título do livro">
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" required placeholder="Digite o nome do autor">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="disponivel">Disponível</option>
                    <option value="emprestado">Emprestado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-block btn-sucesso">
                Salvar Livro
            </button>
        </form>

        <a href="painel.php" class="btn btn-voltar">
            Voltar para o Painel.
        </a>
    </div>

</body>

</html>