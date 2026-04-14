<?php
include('teste_dnb.php');

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$title = $data['title'];

$stmt = $conn->prepare("UPDATE agendamentos SET nome_projeto=? WHERE id=?");
$stmt->bind_param("si", $title, $id);
$stmt->execute();
?>