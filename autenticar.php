<?php
//Autenicar se o e-mail e senha estão certos
// Permite guardar os dados do usuario cadastrado entre as paginas

//Aqui inicia a sessão do usuário
session_start();


include("conexao.php");

// Recebe o email e senha digitados no formulário de login
$email = $_POST['email'];
$senha = $_POST['senha'];
//======================================
//Consulta o banco (READ do CRUD)
//Busca o usuário pelo email informado
//======================================
// Montando a consulta SQL SELECT
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
// Executa a consulta e guarda o resultado
$resultado = mysqli_query($conexao, $sql);

// mysqli_fetch_assoc() transforma a linha do resultado em array associativo
$usuario = mysqli_fetch_assoc($resultado);
//=================================
//VERIFICAÇÃO DE SENHA
//=================================
//password_verify() compara a senha digitada com o has salvo no banco
if ($usuario && password_verify($senha, $usuario['senha'])) {
    //login feio, guarda o nome do usuario na sessão
    $_SESSION['nome'] = $usuario['nome'];
    //redireciona para o painel principal
    header("location: painel.php");
    exit();
}
else {
    //login inválido = redireciona de volta para login com mensagem de erro
    header("Location: login.php?erro=login");
    exit();
}
