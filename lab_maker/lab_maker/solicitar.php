<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); 
    exit();
}

include('teste_dnb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sincronizado com os nomes da sua tabela 'agendamentos'
    $nome_projeto = mysqli_real_escape_string($conn, $_POST['titulo']);
    $solicitante = mysqli_real_escape_string($conn, $_POST['solicitante']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    
    // Define a data da reserva como a data atual do servidor
    $data_reserva = date('Y-m-d');
    $horario = "Pendente"; 

    // Lógica de Upload (Apenas captura o nome para o banco)
    $arquivo_nome = "";
    if(isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0){
        $arquivo_nome = $_FILES['arquivo']['name'];
        // Para salvar o arquivo fisicamente, use: move_uploaded_file($_FILES['arquivo']['tmp_name'], "uploads/".$arquivo_nome);
    }

    // SQL corrigido para usar as colunas: nome_projeto, data_reserva, horario
    $sql = "INSERT INTO agendamentos (nome_projeto, data_reserva, horario) 
            VALUES ('$nome_projeto', '$data_reserva', '$horario')";

    if ($conn->query($sql)) {
        header("Location: kanban.php"); 
        exit();
    } else {
        $erro = "Erro ao salvar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nova Solicitação</title>
    <link rel="stylesheet" href="solicito.css">
</head>
<body>

<div class="form-card">
    <h2>Criar Nova Solicitação</h2>
    
    <?php if(isset($erro)) echo "<div class='error-msg' style='color:red; text-align:center; margin-bottom:10px;'>$erro</div>"; ?>

    <form method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <input type="text" name="solicitante" placeholder="Seu Nome" required>
        </div>

        <div class="form-group">
            <input type="tel" name="celular" placeholder="Celular" required>
        </div>

        <div class="form-group">
            <input type="text" name="titulo" placeholder="Título da Solicitação" required>
        </div>

        <div class="form-group">
            <textarea name="descricao" placeholder="Descrição da Solicitação" required></textarea>
        </div>

        <div class="form-group">
            <textarea name="especificacoes_tecnicas" class="opcional" placeholder="Especificações Técnicas (opcional)"></textarea>
        </div>

        <div class="upload-container">
            <span class="cloud-icon">☁️</span>
            <span class="upload-title">Clique para Adicionar Anexos</span>
            <span class="upload-sub">ou arraste e solte arquivos aqui</span>
         
            
            <div class="btn-procurar">📎 + Procurar</div>
            
            <input type="file" name="arquivo" class="file-input" id="fileInput">
        </div>

        <button type="submit" class="btn-submit">
            Enviar Solicitação
        </button>

        <a href="menu.php" class="btn-back">← Voltar</a>
    </form>
</div>

<script>
    // Script para atualizar o visual quando um arquivo é escolhido
    const fileInput = document.getElementById('fileInput');
    const uploadTitle = document.querySelector('.upload-title');
    const uploadSub = document.querySelector('.upload-sub');

    fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
            uploadTitle.innerText = "Arquivo selecionado:";
            uploadSub.innerText = fileInput.files[0].name;
            uploadSub.style.color = "#10b981"; // Cor verde de sucesso
            uploadSub.style.fontWeight = "bold";
        }
    };
</script>

</body>
</html>