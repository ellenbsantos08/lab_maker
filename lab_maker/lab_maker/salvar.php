<?php
// salvar.php
$conn = new mysqli("localhost", "usuario", "senha", "nome_do_banco");

$nome = $_POST['nome'];
$data = $_POST['data'];
$horario = $_POST['horario'];

$sql = "INSERT INTO agendamentos (nome, data, horario) VALUES ('$nome', '$data', '$horario')";

if ($conn->query($sql) === TRUE) {
    header("Location: calendario.php"); // Volta para o calendário após salvar
}
?>