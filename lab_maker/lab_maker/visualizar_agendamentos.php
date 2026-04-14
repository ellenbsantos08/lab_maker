<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

include('teste_dnb.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lab Maker - Meus Agendamentos</title>
    <link rel="stylesheet" href="visualizo.css">
</head>
<body>

<div class="topbar">
    <div class="logo">🛠️ LAB MAKER</div>
    <a href="menu.php" class="btn-voltar">← Voltar ao Menu</a>
</div>

<div class="container">
    <h2>📅 Agendamentos Confirmados</h2>

    <div class="grid-container">
        <?php
        $sql = "SELECT * FROM agendamentos ORDER BY data_reserva ASC";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {

                echo "<div class='card'>";
                echo "<h3>" . $row['nome_projeto'] . "</h3>";
                echo "<p>📅 " . date('d/m/Y', strtotime($row['data_reserva'])) . " às ⏰ " . $row['horario'] . "</p>";

                echo "<a href='excluir_agendamento.php?id=" . $row['id'] . "' 
                        onclick=\"return confirm('Tem certeza que deseja apagar?')\" 
                        class='btn-excluir'>
                        🗑️
                      </a>";

                echo "</div>";
            }
        } else {
            echo "<p class='vazio'>Nenhum agendamento ainda.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>