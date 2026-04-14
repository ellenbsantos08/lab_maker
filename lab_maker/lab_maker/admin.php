<?php
include('teste_dnb.php');

// agendamentos
$agendamentos = $conn->query("SELECT * FROM agendamentos ORDER BY data_reserva ASC");

// solicitações
$solicitacoes = $conn->query("SELECT * FROM solicitacoes ORDER BY id DESC");

// Kanban organizado
$kanban = [
    'Recebido' => [],
    'Análise' => [],
    'Fazendo' => [],
    'Concluído' => []
];

while($r = $solicitacoes->fetch_assoc()){

    $status = strtolower($r['status_kanban']);

    // compatível com qualquer versão do PHP
    if (strpos($status, 'receb') !== false) {
        $status = 'Recebido';
    } 
    elseif (strpos($status, 'anal') !== false) {
        $status = 'Análise';
    } 
    elseif (strpos($status, 'faz') !== false) {
        $status = 'Fazendo';
    } 
    elseif (strpos($status, 'conc') !== false) {
        $status = 'Concluído';
    } 
    else {
        $status = 'Recebido';
    }

    $kanban[$status][] = $r;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Admin - Lab Maker</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #0d1117;
    color: white;
}

.topbar {
    display: flex;
    justify-content: space-between;
    padding: 15px;
    background: #161b22;
}

.container {
    padding: 20px;
}

.card {
    background: #161b22;
    padding: 12px;
    margin-bottom: 10px;
    border-radius: 10px;
}

/* KANBAN */
.kanban {
    display: flex;
    gap: 10px;
}

.col {
    flex: 1;
    background: #161b22;
    padding: 10px;
    border-radius: 10px;
    min-height: 250px;
}

.item {
    background: #fff787;
    color: black;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 8px;
    font-size: 13px;
}

h3 {
    text-align: center;
    color: #00ff9f;
}
</style>

</head>

<body>

<div class="topbar">
    <div>🛠️ PAINEL ADMIN</div>
    <a href="index.php" style="color:#00ff9f;">← Voltar</a>
</div>

<div class="container">

<h2>📅 Agendamentos</h2>

<?php while($a = $agendamentos->fetch_assoc()): ?>
    <div class="card">
        <b><?php echo htmlspecialchars($a['nome_projeto']); ?></b><br>
        <small><?php echo htmlspecialchars($a['data_reserva']); ?></small>
    </div>
<?php endwhile; ?>

<hr>

<h2>📊 Kanban Solicitações</h2>

<div class="kanban">

<?php foreach($kanban as $status => $items): ?>

    <div class="col">
        <h3><?php echo $status; ?></h3>

        <?php if(empty($items)): ?>
            <p style="color:#666;text-align:center;">Sem itens</p>
        <?php endif; ?>

        <?php foreach($items as $i): ?>
            <div class="item">
                <?php echo htmlspecialchars($i['titulo']); ?>
            </div>
        <?php endforeach; ?>

    </div>

<?php endforeach; ?>

</div>

</div>

</body>
</html>