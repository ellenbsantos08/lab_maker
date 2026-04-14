<?php
include('teste_dnb.php');

$nome = $_POST['nome'];
$celular = $_POST['celular'];
$pessoas = $_POST['pessoas'];
$horario = $_POST['horario'];
$data = $_POST['data'];

$dataHora = $data . " " . $horario;

$stmt = $conn->prepare("
    INSERT INTO agendamentos (nome, celular, pessoas, data_reserva)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param("ssis", $nome, $celular, $pessoas, $dataHora);
$stmt->execute();

header("Location: index.php");
?>