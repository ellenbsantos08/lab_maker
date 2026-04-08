<?php
// Certifique-se de que removeu o $port do teste_dnb.php como conversamos
include('teste_dnb.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projeto = mysqli_real_escape_string($conn, $_POST['projeto']);
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    // Esta linha causou o erro no seu print porque 'nome_projeto' não foi achado no banco
    $sql = "INSERT INTO agendamentos (nome_projeto, data_reserva, horario) 
            VALUES ('$projeto', '$data', '$horario')";

    if ($conn->query($sql)) {
        echo "<script>alert('Sucesso! Espaço reservado.'); window.location='index.php';</script>";
    } else {
        // Se der erro de coluna de novo, ele vai te avisar aqui
        die("Erro no Banco: " . $conn->error);
    }
}
?>