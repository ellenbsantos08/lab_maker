<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('teste_dnb.php');

// pegar dados do formulário
$nome = $_POST['nome_projeto'];
$data = $_POST['data_reserva'];
$horario = $_POST['horario'];

// 🔒 verificar se já existe agendamento nesse horário
$sql_check = "SELECT * FROM agendamentos 
WHERE data_reserva = '$data' AND horario = '$horario'";

$res_check = $conn->query($sql_check);

if ($res_check->num_rows > 0) {
    echo "<script>alert('⚠️ Esse horário já está reservado!'); history.back();</script>";
    exit();
}

// 💾 salvar no banco
$sql = "INSERT INTO agendamentos (nome_projeto, data_reserva, horario)
VALUES ('$nome', '$data', '$horario')";

if ($conn->query($sql)) {
    // ✅ sucesso
    echo "<script>alert('✅ Agendamento realizado com sucesso!'); window.location='menu.php';</script>";
} else {
    // ❌ erro
    echo "<script>alert('Erro ao salvar agendamento!'); history.back();</script>";
}

exit();
?>
