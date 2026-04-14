<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclua sua conexão com o banco aqui (ex: include('conexao.php');)
// $conn = mysqli_connect("localhost", "usuario", "senha", "banco");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    // Criptografando a senha por segurança
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Cadastro realizado!'); window.location.href='index.php';</script>";
    } else {
        echo "Erro: " . mysqli_error($conn);
    }
}
?>
