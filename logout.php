<?php
// logout.php
// Encerrar a sessão do usuário de forma segura e redirecionar para a página de login.
// Conceitos: session_destroy(), limpeza de cookies, header() anti-cache.

// Inica a sessão para poder destruí-la
session_start();

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Remove o cookie de sessão, se existir
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destrói a sessão
session_destroy();

// Cabeçalhos para evitar cache do navegador
header("Cache-Control: no-store, no-cache, must-revalidate");
header("pragma: no-cache");
header("Expires: 0");

// Redireciona para a página de login
header("Location: login.php");
exit();