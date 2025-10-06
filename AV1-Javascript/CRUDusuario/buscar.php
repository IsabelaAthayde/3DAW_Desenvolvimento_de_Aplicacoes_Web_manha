<?php
$usuarios = [];
$resultados = [];
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

$busca = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $busca = trim($_POST['busca'] ?? '');
    if ($busca != '') {
        for ($i = 0; $i < count($usuarios); $i++) {
            $usuario = $usuarios[$i];
            if (stripos($usuario[0], $busca) !== false || stripos($usuario[1], $busca) !== false) {
                $resultados[] = $usuario;
            }
        }
    }
}

if ($busca != '') {
    echo "<h3>Resultados da busca para \"$busca\"</h3>";
    if (count($resultados) > 0) {
        echo "<table><tr><th>Nome</th><th>Email</th><th>Senha</th></tr>";
        foreach ($resultados as $usuario) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($usuario[1]) . "</td>";
            echo "<td>" . htmlspecialchars($usuario[2]) . "</td>";
            echo "<td>" . htmlspecialchars($usuario[3]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum usuário encontrado!</p>";
    }
} else {
    echo "<p>Digite um termo para buscar.</p>";
}
?>
