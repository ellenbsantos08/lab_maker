<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lab Maker - Painel Principal</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>

<div class="menu-container">

    <header class="menu-header">
        <h1>LAB MAKER</h1>
        <p>
            Olá, <strong><?php echo $_SESSION['usuario_nome']; ?></strong> |
            <a href="logout.php" class="logout-link">Sair</a>
        </p>
    </header>

    <nav class="menu-grid">

        <a href="agendar.php" class="menu-item">
            <span class="icon">📅</span>
            <span class="label">Agendar Espaço</span>
        </a>

        <a href="solicitar.php" class="menu-item">
            <span class="icon">📝</span>
            <span class="label">Nova Solicitação</span>
        </a>

        <a href="calendario.php" class="menu-item">
            <span class="icon">📆</span>
            <span class="label">Calendário</span>
        </a>

        <a href="kanbam.php" class="menu-item">
            <span class="icon">📋</span>
            <span class="label">Kanban</span>
        </a>

    </nav>

</div>

</body>
</html>