<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); 
    exit();
}

include('teste_dnb.php'); 

// 🔥 pegar dados vindos do calendário (GET)
$data_get = $_GET['data'] ?? '';
$horario_get = $_GET['horario'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projeto = mysqli_real_escape_string($conn, $_POST['projeto']);
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    // 🚫 VERIFICAR DUPLICADO
    $sql_check = "SELECT * FROM agendamentos 
    WHERE data_reserva = '$data' AND horario = '$horario'";

    $res_check = $conn->query($sql_check);

    if ($res_check->num_rows > 0) {
        echo "<script>alert('⚠️ Esse horário já está reservado!'); history.back();</script>";
        exit();
    }

    // 💾 SALVAR
    $sql = "INSERT INTO agendamentos (nome_projeto, data_reserva, horario) 
            VALUES ('$projeto', '$data', '$horario')";

    if ($conn->query($sql)) {
        echo "<script>alert('✅ Sucesso! Espaço reservado.'); window.location='visualizar_agendamentos.php';</script>";
        exit(); 
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

```
    <h2>📅 Novo Agendamento</h2>

    <form action="agendar.php" method="POST">

        <div class="form-group">
            <label>Nome do Projeto</label>
            <input type="text" name="projeto" required placeholder="Ex: Braço Robótico">
        </div>

        <div class="form-group">
            <label>Data da Reserva</label>
            <input type="date" name="data" value="<?php echo $data_get; ?>" required>
        </div>

        <div class="form-group">
            <label>Horário</label>
            <input type="time" name="horario" value="<?php echo $horario_get; ?>" required>
        </div>

        <button type="submit" class="btn-submit">Confirmar Reserva</button>

        <a href="menu.php" class="btn-back">← Voltar ao Menu</a>

    </form>
</div>
```

</div>

</body>
</html>
