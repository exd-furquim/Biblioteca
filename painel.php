<?php

// inclui a verificação de sessão (protge a página de acesso não autorizada)
require_once __DIR__ . "/verificar_sessao.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!--exibe o nome do usuário logado(vem da sessão $_SESSION)-->
        <h1>Olá, <?php echo htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="subtitulo">Bem-vindo ao painel da Biblioteca.
            Escolha uma opção:</p>
            <!-- Cards grandes para facilitar a navegação-->
             <div class="painel-cards">
                <a href="cadastrar_livro.php" class="card-link">
                Cadastrar livro
                </a>
                 <a href="listar_livro.php" class="card-link">
                Listar livros
                </a>
                 <a href="logout.php" class="card-link">
                Sair
                </a>
        </div>
        <div class="dica-naveacao">
        <strong>Fluxo:</strong>
        Painel → Cadastrar Livro ou Listar livros → Editar / Excluir 
    </div>
    </div>
</body>
</html>
