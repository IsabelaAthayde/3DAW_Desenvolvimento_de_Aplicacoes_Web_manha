<?php
session_start();
$caminhoPerg = __DIR__ . "/../../pergRes.txt";

if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    $_SESSION['indice'] = 0;
    $_SESSION['respostas'] = [];
}

$perguntas = [];
if (file_exists($caminhoPerg)) {
    $arq = fopen($caminhoPerg, "r") or die("Erro ao abrir arquivo");
    fgets($arq);
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha !== false && trim($linha) != "") {
            $campos = explode(";", trim($linha));
            $perguntas[] = $campos;
        }
    }
    fclose($arq);
}

if (!isset($_SESSION['indice'])) {
    $_SESSION['indice'] = 0;
}
if (!isset($_SESSION['respostas'])) {
    $_SESSION['respostas'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
    $indiceAnterior = $_SESSION['indice'] - 1;
    $perguntaAnterior = $perguntas[$indiceAnterior];
    $respostaUsuario = $_POST['resposta'];

    $isDiscursiva = empty($perguntaAnterior[2]) && empty($perguntaAnterior[3]) &&
                    empty($perguntaAnterior[4]) && empty($perguntaAnterior[5]) &&
                    !empty($perguntaAnterior[7]);

    $respostaCerta = $perguntaAnterior[7] ?? '';

    $_SESSION['respostas'][] = [
        'pergunta' => $perguntaAnterior[1] ?? '',
        'resposta' => $respostaUsuario,
        'certa' => $respostaCerta,
        'discursiva' => $isDiscursiva,
        'correto' => $isDiscursiva ? null : (strtoupper($respostaUsuario) === strtoupper($respostaCerta))
    ];
}

$indiceAtual = $_SESSION['indice'];

if ($indiceAtual < count($perguntas)) {
    $perguntaAtual = $perguntas[$indiceAtual];
    $_SESSION['indice']++;
} else {
    echo '<link rel="stylesheet" href="/AV1-3DAW/style.css">';
    include '../../navs/nav.php'; 
    include '../../navs/nav_perguntas.php';
    echo '<style>
        h2, h3 {
            text-align: center;
        }
        a[href*="reset"] {
            display: block;
            text-align: center;
            margin: 20px auto;
            text-decoration: none;
            color: #00ffff;
        }
    </style>';
    echo "<h2>Quiz finalizado!</h2>";
    echo "<h3>Resultado:</h3>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Pergunta</th><th>Resposta do Usuário</th><th>Resposta Certa</th>";
    echo "<th>Status</th></tr>";

    foreach ($_SESSION['respostas'] as $r) {
        echo "<tr>";
        echo "<td>{$r['pergunta']}</td>";
        echo "<td>{$r['resposta']}</td>";
        echo "<td>{$r['certa']}</td>";
        if ($r['discursiva']) {
            echo "<td>-</td>";
        } else {
            $status = $r['correto'] ? "Acertou" : "Errou";
            echo "<td>$status</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    echo "<br><a href='listarPR.php?reset=1'>Reiniciar Quiz / Voltar para Lista</a><br>";
    session_destroy();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
    <style>
        input:not([type="submit"]) {
            width: fit-content;
        }
    </style>
</head>
<body>
    <?php include '../../navs/nav.php'; ?>
    <?php include '../../navs/nav_perguntas.php'; ?>
    <h2>Pergunta <?php echo $indiceAtual + 1; ?> de <?php echo count($perguntas); ?></h2>
    
    <main class="main-align">
        <p><?php echo $perguntaAtual[1]; ?></p>
        <form action="listarPR.php" method="POST">
            <?php
                $isDiscursiva = empty($perguntaAtual[2]) && empty($perguntaAtual[3]) &&
                                empty($perguntaAtual[4]) && empty($perguntaAtual[5]) &&
                                !empty($perguntaAtual[7]);
            
                if (!$isDiscursiva) {
                    if (!empty($perguntaAtual[2])) echo "<p><input type='radio' name='resposta' value='A' required> A) {$perguntaAtual[2]}</p><br>";
                    if (!empty($perguntaAtual[3])) echo "<p><input type='radio' name='resposta' value='B'> B) {$perguntaAtual[3]}</p><br>";
                    if (!empty($perguntaAtual[4])) echo "<p><input type='radio' name='resposta' value='C'> C) {$perguntaAtual[4]}</p><br>";
                    if (!empty($perguntaAtual[5])) echo "<p><input type='radio' name='resposta' value='D'> D) {$perguntaAtual[5]}</p><br>";
                    if (!empty($perguntaAtual[6])) echo "<p><input type='radio' name='resposta' value='E'> E) {$perguntaAtual[6]}</p><br>";
                } else {
                    echo "<label for='resposta'>Resposta:</label><br>";
                    echo "<textarea name='resposta' required></textarea><br>";
                }
            ?>
            <br>
            <input type="submit" value="Enviar">
        </form>
    </main>
</body>
</html>
