<?php
include('teste_dnb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

    // IMPORTANTE: Aqui definimos que todo novo card nasce como 'Recebido'
    $sql = "INSERT INTO solicitacoes (titulo, descricao, status_kanban) 
            VALUES ('$titulo', '$descricao', 'Recebido')";

    if ($conn->query($sql)) {
        // Após salvar, ele te joga direto para o painel Kanban
        header("Location: kanbam.php");
        exit();
    } else {
        echo "Erro ao gravar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lab Maker - Nova Solicitação</title>
    <link rel="stylesheet" href="solicito.css"> 
</head>
<body>

<div class="container-form">
    <div class="form-card">
        <h2>📝 Nova Solicitação</h2>
        
        <form action="solicitar.php" method="POST">
            <div class="form-group">
                <label>TÍTULO DO CHAMADO</label>
                <input type="text" name="titulo" required placeholder="Ex: Conserto de impressora 3D">
            </div>

            <div class="form-group">
                <label>DESCRIÇÃO DO PROBLEMA / NECESSIDADE</label>
                <textarea name="descricao" required placeholder="Descreva detalhadamente o que você precisa..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Enviar para o Kanban</button>
            <a href="index.php" class="btn-back">← Voltar ao Menu</a>
        </form>
    </div>
</div>

</body>
</html>