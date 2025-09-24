<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuarios = [];
$caminhoUsuarios = "../usuarios.txt";

if (file_exists($caminhoUsuarios)) {
    $arq = fopen($caminhoUsuarios, "r") or die("Erro ao abrir arquivo");
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha !== false && trim($linha) !== "") {
            $usuarios[] = explode(";", trim($linha));
        }
    }
    fclose($arq);
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    $id = $_SESSION['usuario'];
}

if (!isset($usuarios[$id])) {
    die("Usuário não encontrado");
}

$usuario = $usuarios[$id];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarios[$id] = [
        $_POST['nome'],
        $_POST['email'],
        $_POST['senha']
    ];

    $arq = fopen($caminhoUsuarios, "w") or die("Erro ao abrir arquivo");
    foreach ($usuarios as $u) {
        fwrite($arq, implode(";", $u) . "\n");
    }
    fclose($arq);

    $msg =  "Usuário atualizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar usuário</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
</head>
<body>
    <?php include '../navs/nav.php'; ?>
    <?php include '../navs/nav_usuarios.php'; ?>
    <h2>Alterar usuário <?php echo ($id == $_SESSION['usuario']) ? "(Meu Perfil)" : "(ID $id)<br>para fins educacionais"; ?></h2>
    <main class="main-align">
        <form action="?<?php if ($id != $_SESSION['usuario']) echo "id=$id"; ?>" method="POST">
            Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario[0]); ?>"><br><br>
            Email: <input type="text" name="email" value="<?php echo htmlspecialchars($usuario[1]); ?>"><br><br>
            Senha: <input type="text" name="senha" value="<?php echo htmlspecialchars($usuario[2]); ?>"><br><br>
            <input type="submit" value="Salvar">
        </form>
    </main>
    <?php $msg ?>

</body>
</html>
