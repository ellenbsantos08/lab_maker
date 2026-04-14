<?php
include('teste_dnb.php');

$res = $conn->query("SELECT * FROM tarefas");
$tarefas = [];

while($row = $res->fetch_assoc()){
    $tarefas[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kanban</title>
    <link rel="stylesheet" href="kanbam.css">
</head>
<body>

<div class="topbar">
    <button onclick="novaTarefa()" class="btn-nova">➕ Nova Tarefa</button>
    <a href="menu.php" class="btn-voltar">← Voltar</a>
</div>

<div class="kanban-board">

<?php
$colunas = ["Recebido", "Analise", "Fazendo", "Concluído"];

foreach ($colunas as $col) {
    echo "<div class='coluna' ondrop='drop(event)' ondragover='allowDrop(event)' data-col='$col'>";
    echo "<h3>$col</h3>";

    foreach ($tarefas as $t) {
        if ($t['coluna'] == $col) {
            echo "
            <div class='card' draggable='true' ondragstart='drag(event)' id='card{$t['id']}'>
                
                <span class='titulo' ondblclick='editar({$t['id']})'>
                    {$t['titulo']}
                </span>

                <button onclick='excluir({$t['id']})' class='btn-delete'>
                    🗑️
                </button>

            </div>";
        }
    }

    echo "</div>";
}
?>

</div>

<script>
function allowDrop(ev){ ev.preventDefault(); }

function drag(ev){
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev){
    ev.preventDefault();
    let id = ev.dataTransfer.getData("text");
    let card = document.getElementById(id);

    if(ev.target.classList.contains("coluna")){
        ev.target.appendChild(card);

        let coluna = ev.target.getAttribute("data-col");
        let tarefa_id = id.replace("card","");

        fetch("mover.php", {
            method:"POST",
            body: new URLSearchParams({
                id: tarefa_id,
                coluna: coluna
            })
        });
    }
}

function novaTarefa(){
    let titulo = prompt("Nome da tarefa:");
    if(!titulo) return;

    fetch("criar.php", {
        method:"POST",
        body: new URLSearchParams({titulo})
    }).then(()=> location.reload());
}

function excluir(id){
    if(!confirm("Excluir tarefa?")) return;

    fetch("excluir.php", {
        method:"POST",
        body: new URLSearchParams({id})
    }).then(()=> location.reload());
}

function editar(id){
    let novo = prompt("Novo nome:");
    if(!novo) return;

    fetch("editar.php", {
        method:"POST",
        body: new URLSearchParams({id, titulo: novo})
    }).then(()=> location.reload());
}
</script>

</body>
</html>