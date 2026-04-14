<?php
include('teste_dnb.php');

$id = $_POST['id'];

$conn->query("DELETE FROM tarefas WHERE id=$id");
