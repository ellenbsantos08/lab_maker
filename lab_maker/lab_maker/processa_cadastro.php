<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('teste_dnb.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $check_email = "SELECT id FROM usuarios_cadastro WHERE email = '$email'";
    $res_check = $conn->query($check_email);

    if ($res_check && $res_check->num_rows > 0) {
        echo "<script>alert('Este e-mail já está cadastrado!'); window.location='cadastro.php';</script>";
        exit();
    } else {
        $sql = "INSERT INTO usuarios_cadastro (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        if ($conn->query($sql)) {
            $_SESSION['usuario_id'] = $conn->insert_id;
            $_SESSION['usuario_nome'] = $nome;

            header("Location: menu.php"); 
            exit(); 
        } else {
            echo "Erro crítico no banco de dados: " . $conn->error;
        }
    }
}
?>