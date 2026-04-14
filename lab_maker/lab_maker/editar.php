<?php
include('teste_dnb.php');

$id = $_POST['id'];
$titulo = $_POST['titulo'];

$conn->query("UPDATE tarefas SET titulo='$titulo' WHERE id=$id");