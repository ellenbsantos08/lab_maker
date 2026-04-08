<?php
include('teste_dnb.php'); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lab Maker - Kanban</title>
    <link rel="stylesheet" href="kanbam.css"> 
</head>
<body>

<div class="topbar">
    <div class="logo">🛠️ PAINEL KANBAN</div>
    <a href="index.php" style="color: #00ff9f; text-decoration: none;">← Voltar ao Menu</a>
</div>

<div class="kanban-board">
    

   <?php
include('teste_dnb.php');
$colunas = ['Recebido', 'Analise', 'Fazendo', 'Concluído'];
?>

<div class="kanban-board">
    <?php foreach ($colunas as $status_atual): ?>
        <div class="kanban-column">
            <h3><?php echo $status_atual; ?></h3>
            
            <?php
            $sql = "SELECT * FROM solicitacoes WHERE status_kanban = '$status_atual'";
            $res = $conn->query($sql);
            while ($row = $res->fetch_assoc()):
                // Define a cor do post-it (se não tiver no banco, usa o amarelo padrão)
                $cor = $row['cor_postit'] ? $row['cor_postit'] : '#fff787';
            ?>
                <div class="kanban-card" style="background-color: <?php echo $cor; ?>;">
                    
                    <?php if (!empty($row['anexo_url'])): ?>
                        <img src="uploads/<?php echo $row['anexo_url']; ?>" alt="Foto">
                    <?php endif; ?>

                    <div class="card-header"><?php echo htmlspecialchars($row['titulo']); ?></div>
                    <p><?php echo htmlspecialchars($row['descricao']); ?></p>

                    <form action="atualizar_status.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <select name="status" onchange="this.form.submit()" class="btn-move">
                            <?php foreach ($colunas as $opt): ?>
                                <option value="<?php echo $opt; ?>" <?php if($row['status_kanban'] == $opt) echo 'selected'; ?>>
                                    Mover para: <?php echo $opt; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                    
                    <a href="editar_card.php?id=<?php echo $row['id']; ?>" style="font-size: 10px; text-decoration: none; color: blue;">⚙️ Editar Cores/Foto</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endforeach; ?>
</div>