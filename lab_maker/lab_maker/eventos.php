<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('teste_dnb.php');

$sql = "SELECT nome_projeto, data_reserva, horario FROM agendamentos";
$res = $conn->query($sql);

$eventos = [];

while ($row = $res->fetch_assoc()) {
    $eventos[] = [
        'title' => $row['nome_projeto'],
        'start' => $row['data_reserva'] . 'T' . $row['horario']
    ];
}

echo json_encode($eventos);
?>