<?php
$usuarios = [];
$busca = '';
$resultados = [];

$caminhoUsuarios = "../usuarios.txt";

if (file_exists($caminhoUsuarios)) {
    $arq = fopen($caminhoUsuarios, "r") or die("erro");
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha !== false) {
            $usuarios[] = explode(";", trim($linha));
        }
    }
    fclose($arq);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busca = trim($_POST['busca']);
    if ($busca != '') {
        for ($i = 1; $i < count($usuarios); $i++) {
            $usuario = $usuarios[$i];
            if (stripos($usuario[0], $busca) !== false || stripos($usuario[1], $busca) !== false) {
                $resultados[] = $usuario;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Buscar usuario</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
    <style>
        form {
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
    </style>
</head>
<body>
     <?php include '../navs/nav.php'; ?>
    <?php include '../navs/nav_usuarios.php'; ?>
    <h2>Buscar usuarios</h2>

    <main class="main-align">
        <form action="buscar.php" method="POST">
            <input type="text" name="busca" placeholder="Nome ou email do usuario">
            <input type="submit" value="Buscar">
        </form>

        <?php
        if ($busca != '') {
            echo "<h3>Resultados da busca para \"$busca\"</h3>";
            if (count($resultados) > 0) {
                echo "<table border='1'><tr><th>Nome</th><th>email</th><th>senha</th></tr>";
                foreach ($resultados as $usuario) {
                    echo "<tr>";
                    echo "<td>" . $usuario[0] . "</td>";
                    echo "<td>" . $usuario[1] . "</td>";
                    echo "<td>" . $usuario[2] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Nenhum usuario encontrado!</p>";
            }
        }
        ?>
    </main>
    
</body>
</html>
