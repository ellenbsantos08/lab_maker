<?php
include('teste_dnb.php');

// 1. Pega o ID da URL e busca os dados atuais
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM solicitacoes WHERE id = $id";
    $res = $conn->query($sql);
    $dados = $res->fetch_assoc();

    if (!$dados) {
        die("Card não encontrado!");
    }
}

// 2. Processa a atualização quando clicar em Salvar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $cor = $_POST['cor_postit']; // Pega a cor do seletor

    $sql_update = "UPDATE solicitacoes SET 
                   titulo = '$titulo', 
                   descricao = '$descricao', 
                   cor_postit = '$cor' 
                   WHERE id = $id";

    if ($conn->query($sql_update)) {
        header("Location: kanbam.php"); // Volta para o Kanban
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Post-it #<?php echo $id; ?></title>
    <style>
        body { background: #0d1117; color: #white; font-family: sans-serif; display: flex; justify-content: center; padding: 50px; }
        .edit-card { background: #161b22; padding: 30px; border-radius: 12px; border: 1px solid #30363d; width: 400px; }
        h2 { color: #00ff9f; margin-top: 0; }
        label { display: block; margin: 15px 0 5px; color: #8b949e; font-size: 12px; }
        input, textarea { width: 100%; padding: 10px; background: #0d1117; border: 1px solid #30363d; color: white; border-radius: 6px; box-sizing: border-box; }
        .btn-save { background: #00ff9f; color: #0d1117; border: none; padding: 12px; width: 100%; border-radius: 6px; font-weight: bold; cursor: pointer; margin-top: 20px; }
        .btn-cancel { display: block; text-align: center; color: #8b949e; text-decoration: none; margin-top: 15px; font-size: 14px; }
    </style>
</head>
<body>

<div class="edit-card">
    <h2>⚙️ Editar Post-it</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

        <label>TÍTULO</label>
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($dados['titulo']); ?>" required>

        <label>CONTEÚDO</label>
        <textarea name="descricao" rows="5" required><?php echo htmlspecialchars($dados['descricao']); ?></textarea>

        <label>COR DO POST-IT</label>
        <input type="color" name="cor_postit" value="<?php echo $dados['cor_postit'] ? $dados['cor_postit'] : '#fff787'; ?>" style="height: 50px; cursor: pointer;">

        <button type="submit" class="btn-save">SALVAR ALTERAÇÕES</button>
        <a href="kanbam.php" class="btn-cancel">Cancelar e Voltar</a>
    </form>
</div>

</body>
</html>