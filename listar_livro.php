<?php

// listar_livro.php
// Exibe todos os livros cadastrados em uma tabela.
// Conceitos: MySQL, SELECT (READ DO CRUD), loop while(repete em um loop enquando uma centença ainda for verdadeira)

// Protege a página: só ususários logados podem listar livros.
include("verificar_sessao.php");

// Inclui a conexão do banco de dados.
include("conexao.php");

// Consulta SQL que busca todos os livros databela.
$sql = "SELECT * FROM livros";

// Executa a consulta e guarda o resultado
$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar livro - Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Container mais largo para acomodar a tabela -->
    <div class="container container-largo">
        <h1>Listagem de livros</h1>
        <p class="subtitulo">
            Todos os livros cadastrados no sistema.
        </p>
        <!-- Taela estilizada com os dados dos livros -->
        <table class="tabela-livros">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php
            // Loop while percorre cada linha retornada pela consulta SQL
            while ($livro = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <td><?php echo $livro['id']; ?></td>
                    <td><?php echo $livro['titulo']; ?></td>
                    <td><?php echo $livro['autor']; ?></td>
                    <td><?php echo $livro['status']; ?></td>
                    <td class="acoes">
                        <!-- Link para editar o livro -->
                        <!-- envia o ID pela URL com ?id= -->
                        <a href="editar_livro.php?id=<?php echo $livro['id']; ?>" class="link-editar">
                            Editar
                        </a>
                        <!-- Link para excluir com confirmação do JS -->
                        <a href="excluir_livro.php?id=
                       <?php echo $livro['id']; ?>" class="link-excluir"
                            onclick="return confirm('Tem certeza que deseja excluir o livro?')">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <!-- Botão para voltar para o painel -->
        <a href="painel.php" class="btn btn-voltar">Voltar para o Painel.</a>
    </div>
</body>

</html>