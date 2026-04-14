<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('teste_dnb.php'); // Importa a conexão

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Garante que o ID seja um número por segurança

    // Comando para deletar da tabela agendamentos
    $sql = "DELETE FROM agendamentos WHERE id = $id";

    if ($conn->query($sql)) {
        // Se der certo, volta para a lista com um aviso
        echo "<script>alert('Agendamento removido!'); window.location='visualizar_agendamentos.php';</script>";
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
}
?>