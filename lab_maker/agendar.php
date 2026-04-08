<?php
include('teste_dnb.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projeto = mysqli_real_escape_string($conn, $_POST['projeto']);
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    $sql = "INSERT INTO agendamentos (nome_projeto, data_reserva, horario) 
            VALUES ('$projeto', '$data', '$horario')";

    if ($conn->query($sql)) {
        echo "<script>alert('Sucesso! Espaço reservado.'); window.location='visualizar_agendamentos.php';</script>";
        exit(); // Adicione o exit para parar a execução aqui
    } else {
        die("Erro no Banco: " . $conn->error);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lab Maker - Agendar</title>
    <link rel="stylesheet" href="agendo.css">
</head>
<body>

<div class="container-form">
    <div class="form-card">
        <h2> Novo Agendamento</h2>
        
        <form action="agendar.php" method="POST">
            <div class="form-group">
                <label>NOME DO PROJETO</label>
                <input type="text" name="projeto" required placeholder="Ex: Braço Robótico">
            </div>

            <div class="form-group">
                <label>DATA DA RESERVA</label>
                <input type="date" name="data" required>
            </div>

            <div class="form-group">
                <label>HORÁRIO</label>
                <input type="time" name="horario" required>
            </div>

            <button type="submit" class="btn-submit">Confirmar Reserva</button>
            <a href="index.php" class="btn-back">← Voltar ao Menu</a>
        </form>
    </div>
</div>

</body>
</html>