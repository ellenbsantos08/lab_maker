<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('teste_dnb.php'); // Certifica-te que corrigiste o $port neste ficheiro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // 'Recebido' deve ser igual ao nome da tua primeira coluna no kanbam.php
    $sql = "INSERT INTO solicitacoes (titulo, descricao, status_kanban) 
            VALUES ('$titulo', '$descricao', 'Recebido')";

    if ($conn->query($sql)) {
        header("Location: kanbam.php"); // Redireciona logo para o Trello
    } else {
        echo "Erro ao gravar: " . $conn->error;
    }
}
?>