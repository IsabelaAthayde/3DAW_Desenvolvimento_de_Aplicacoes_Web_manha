<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarios = [];
    if (file_exists("usuarios.txt")) {
        $arq = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");
        while (!feof($arq)) {
            $linha = fgets($arq);
            if ($linha !== false && trim($linha) != "") {
                $usuarios[] = explode(";", trim($linha));
            }
        }
        fclose($arq);
    }

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $logado = false;

    foreach ($usuarios as $id => $u) { 
        if ($u[1] == $email && $u[2] == $senha) {
            $_SESSION['usuario'] = $id;
            $_SESSION['usuario_nome'] = $u[0]; 
            $logado = true;
            break;
        }
    }

    if (!$logado) {
        $erro = "Email ou senha inválidos!";
    } else {
        header("Location: home.php");
        exit;
    }
}

if (isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">

</head>
<body>
    <main class="main-align">
        
        <h2>Login</h2>
        
            <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
            <form method="POST" action="index.php">
                Email: <input type="text" name="email" required><br><br>
                Senha: <input type="password" name="senha" required><br><br>
                <input type="submit" value="Entrar">
            </form>
            <p>Não possui cadastro?   <a href="./CRUDusuario/cadastro.php"> CADASTRE-SE</a></p>
    </main>
</body>
</html>
