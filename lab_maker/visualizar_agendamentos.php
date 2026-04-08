<?php 
include('teste_dnb.php'); // Ligação à base de dados
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lab Maker - Meus Agendamentos</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <div class="topbar">
        <div class="logo">🛠️ LAB MAKER</div>
        <a href="index.php" style="color: #00ff9f; text-decoration: none;">Voltar ao Menu</a>
    </div>

    <div class="container" style="padding: 40px; max-width: 800px; margin: auto;">
        <h2 style="color: #00ff9f; margin-bottom: 30px;">📅 Agendamentos Confirmados</h2>
        
        <div class="grid-container" style="display: grid; gap: 15px;">
            <?php
            // Procura todos os agendamentos por ordem de data
            $sql = "SELECT * FROM agendamentos ORDER BY data_reserva ASC";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        echo "<div class='card' style='background: #161b22; padding: 20px; border-left: 5px solid #00ff9f; margin-bottom: 10px; position: relative;'>";
        echo "<h3 style='margin: 0; color: white;'>" . $row['nome_projeto'] . "</h3>";
        echo "<p style='color: #8b949e; margin: 10px 0 0;'>Data: " . date('d/m/Y', strtotime($row['data_reserva'])) . " às " . $row['horario'] . "</p>";
        
        // BOTÃO DE APAGAR
        echo "<a href='excluir_agendamento.php?id=" . $row['id'] . "' 
                 onclick=\"return confirm('Tem certeza que deseja apagar este agendamento?')\" 
                 style='color: #ff4d4d; text-decoration: none; font-size: 0.8rem; position: absolute; top: 10px; right: 15px;'>
                 [ EXCLUIR ]
              </a>";
        
        echo "</div>";
    }
} else {
    echo "<p style='color: #8b949e;'>Ainda não existem agendamentos.</p>";
}
?>
        </div>
    </div>
</body>
</html>