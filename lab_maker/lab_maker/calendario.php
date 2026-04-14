<?php
include('teste_dnb.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_agendar'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome_projeto']);
    $data = mysqli_real_escape_string($conn, $_POST['data_reserva']);
    $hora = mysqli_real_escape_string($conn, $_POST['horario']);
    
    $sql = "INSERT INTO agendamentos (nome_projeto, data_reserva, horario)
            VALUES ('$nome', '$data', '$hora')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: calendario.php");
        exit();
    }
}

$eventos_por_dia = [];
$query = "SELECT nome_projeto, data_reserva FROM agendamentos"; 
$resultado = mysqli_query($conn, $query);

if ($resultado) {
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $eventos_por_dia[$linha['data_reserva']][] = $linha['nome_projeto'];
    }
}

$mes_atual = 4;
$ano_atual = 2026;
$hoje = 13;

$primeiro_dia = mktime(0,0,0,$mes_atual,1,$ano_atual);
$dias_no_mes = date('t', $primeiro_dia);
$inicio_semana = date('w', $primeiro_dia);

$nomes_dias = ['dom','seg','ter','qua','qui','sex','sáb'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lab Maker - Agenda</title>

<style>
body {
    font-family: Arial;
    margin: 0;
    background: #f5f7fb;
}

/* TOPBAR FIXA */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #161b22;
    color: white;
    padding: 15px 20px;
}

.btn-voltar {
    background: #00ff9f;
    color: black;
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}

/* CONTAINER */
.container {
    max-width: 1000px;
    margin: 30px auto;
}

/* CALENDÁRIO */
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
}

.weekday {
    text-align: center;
    font-weight: bold;
    color: #555;
}

.day {
    background: white;
    border: 1px solid #ddd;
    border-radius: 10px;
    min-height: 90px;
    padding: 8px;
}

.day.today {
    border: 2px solid #0066cc;
}

.num {
    font-weight: bold;
}

/* EVENTOS */
.event-info {
    font-size: 11px;
    color: #0066cc;
    margin-top: 5px;
}

/* FORM */
.reserva-container {
    margin-top: 40px;
}

.form-row {
    display: flex;
    gap: 10px;
}

input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.btn-agendar {
    background: #0066cc;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
}
</style>

</head>

<body>

<!-- ✅ TOPBAR CORRETA -->
<div class="topbar">
    <div>🗓️ Calendário - Lab Maker</div>

    <a href="admin.php" class="btn-voltar">
        ← Voltar para o ADM
    </a>
</div>

<div class="container">

<h2>Abril de 2026</h2>

<div class="calendar-grid">

<?php foreach ($nomes_dias as $d): ?>
    <div class="weekday"><?php echo $d; ?></div>
<?php endforeach; ?>

<?php for ($i = 0; $i < $inicio_semana; $i++): ?>
    <div></div>
<?php endfor; ?>

<?php for ($dia = 1; $dia <= $dias_no_mes; $dia++): 

$data = "$ano_atual-" . str_pad($mes_atual,2,"0",STR_PAD_LEFT) . "-" . str_pad($dia,2,"0",STR_PAD_LEFT);

?>

<div class="day <?php echo ($dia == $hoje ? 'today' : ''); ?>">
    <div class="num"><?php echo $dia; ?></div>

    <?php if(isset($eventos_por_dia[$data])): ?>
        <?php foreach($eventos_por_dia[$data] as $e): ?>
            <div class="event-info"><?php echo $e; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php endfor; ?>

</div>

<!-- FORM -->
<div class="reserva-container">
    <h3>Nova Reserva</h3>

    <form method="POST" class="form-row">

        <input type="text" name="nome_projeto" placeholder="Projeto" required>
        <input type="text" name="horario" placeholder="Horário" required>
        <input type="date" name="data_reserva" required>

        <button class="btn-agendar" name="btn_agendar">Agendar</button>

    </form>
</div>

</div>

</body>
</html>