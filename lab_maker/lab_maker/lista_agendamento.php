<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 include('teste_dnb.php'); ?>
<div class="trello-list" style="margin-top: 30px;">
    <div class="list-header">📅 PRÓXIMOS AGENDAMENTOS</div>
    <?php
    $sql = "SELECT * FROM agendamentos ORDER BY data_reserva ASC";
    $res = $conn->query($sql);
    while($row = $res->fetch_assoc()) {
        echo "<div class='trello-card' style='border-left: 5px solid var(--primary-neon);'>";
        echo "<strong>" . $row['nome_projeto'] . "</strong><br>";
        echo "<small>" . date('d/m/Y', strtotime($row['data_reserva'])) . " - " . $row['horario'] . "</small>";
        echo "</div>";
    }
    ?>
</div>