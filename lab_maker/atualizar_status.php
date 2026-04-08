<?php
include('teste_dnb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']); // Pega o valor do <select name="status">
    
    $sql = "UPDATE solicitacoes SET status_kanban = '$status' WHERE id = $id";
    
    if ($conn->query($sql)) {
        header("Location: kanbam.php");
        exit();
    }
}
?>