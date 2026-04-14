<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('teste_dnb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    // Busca na tabela que você definiu: usuarios_cadastro
    $sql = "SELECT * FROM usuarios_cadastro WHERE email = '$email'";
    $res = $conn->query($sql);
    
    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();

        // Verifica se a senha bate com o hash do banco
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];

            // 🔐 DEFINE TIPO DE USUÁRIO
            if ($user['email'] == "admin@labmaker.com") {
                $_SESSION['tipo'] = "admin";
                header("Location: admin.php");
            } else {
                $_SESSION['tipo'] = "usuario";
                header("Location: menu.php");
            }

            exit();
        }
    }

    // Se falhar, volta para o login
    echo "<script>alert('E-mail ou senha incorretos!'); window.location='index.php';</script>";
}
?>
