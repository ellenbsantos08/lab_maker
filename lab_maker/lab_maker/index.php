<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('teste_dnb.php');

// Se o usuário já logou, ele não precisa ver o login de novo, vai direto pro Menu
if (isset($_SESSION['usuario_id'])) {
    header("Location: menu.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Maker - Login</title>
    <link rel="stylesheet" href="agendo.css">
</head>
<body>
    <div class="container-form">
        <div class="form-card">
            <h2>🔑 Acessar Lab</h2>
            
            <form action="processa_login.php" method="POST">
                <div class="form-group">
                    <label>E-MAIL</label>
                    <input type="email" name="email" required placeholder="seu@email.com">
                </div>
                
                <div class="form-group">
                    <label>SENHA</label>
                    <input type="password" name="senha" required placeholder="******">
                </div>
                
                <button type="submit" class="btn-submit">Entrar</button>
                
                <div style="margin-top: 15px; text-align: center;">
                    <a href="cadastro.php" class="btn-back" style="text-decoration: none; font-size: 14px;">Não tem conta? Cadastre-se</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>