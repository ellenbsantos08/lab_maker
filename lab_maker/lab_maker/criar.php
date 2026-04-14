<?php
include('teste_dnb.php');

$titulo = $_POST['titulo'];

$conn->query("INSERT INTO tarefas (titulo, coluna) VALUES ('$titulo', 'Recebido')");