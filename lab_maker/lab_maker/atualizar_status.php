<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('teste_dnb.php');

$id = $_POST['id'];
$status = $_POST['status'];

$sql = "UPDATE agendamentos SET status_kanban='$status' WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: kanbam.php");
} else {
    echo "Erro: " . $conn->error;
}