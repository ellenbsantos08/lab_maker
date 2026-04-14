<?php
include("../db.php");

$res = $conn->query("SELECT * FROM agendamentos");

$data = [];

while($row = $res->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>