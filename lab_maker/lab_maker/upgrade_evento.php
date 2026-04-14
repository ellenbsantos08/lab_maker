<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('teste_dnb.php');

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$start = $data['start'];

$stmt = $conn->prepare("UPDATE agendamentos SET data_reserva = ? WHERE id = ?");
$stmt->bind_param("si", $start, $id);
$stmt->execute();
?>