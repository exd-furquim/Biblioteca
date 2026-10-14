<?php

// Arquivo incluido nas páginas restritas dp sistema.
// Garante que apenas usuários logados possam acessar o conteúdo

// Inicia a sessão do usuários (ou retoma uma sessão já existente)
session_start();

// Cabeçálhos HTTP que impedem o navegador de guardar a página em cache

header("Cache-control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Verifica se a variável de sessão 'nome' existe
// Se não existir, o usuário não está logado.

if (!isset($_SESSION['nome'])) {
    // header() redireciona o navegador para outra página
    header("Location: login.php");
    // exit() encerra o script para garantir que nada mais seja executado
    exit();
}