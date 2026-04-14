<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('teste_dnb.php');

if (isset($_SESSION['usuario_id'])) {
    header("Location: menu.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title>Lab Maker - Cadastro</title>
<link rel="stylesheet" href="agendo.css">
    <!-- CSS com versão para evitar cache -->


</head>
<body>

<div class="container-form">
    <div class="form-card">
        <h2>👤 Criar Conta</h2>
        
        <form action="processa_cadastro.php" method="POST">

            <div class="form-group">
                <label>NOME COMPLETO</label>
                <input type="text" name="nome" required placeholder="Digite seu nome...">
            </div>

            <div class="form-group">
                <label>E-MAIL</label>
                <input type="email" name="email" required placeholder="exemplo@email.com">
            </div>

            <div class="form-group">
                <label>SENHA</label>
                <input type="password" name="senha" required placeholder="********">
            </div>

            <button type="submit" class="btn-submit">
                🚀 Criar Conta
            </button>

            <a href="index.php" class="btn-back">
                ← Já tenho conta
            </a>

        </form>
    </div>
</div>

</body>
</html>