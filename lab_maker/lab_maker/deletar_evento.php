<?php
include("teste_dnb.php");

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("INSERT INTO agendamentos (data_reserva, titulo, descricao) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $data["data"], $data["titulo"], $data["descricao"]);
$stmt->execute();

echo json_encode(["ok" => true]);
?>