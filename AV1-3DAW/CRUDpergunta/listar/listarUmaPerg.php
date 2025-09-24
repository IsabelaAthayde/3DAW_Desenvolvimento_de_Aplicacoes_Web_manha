<?php
$perguntas = [];

$caminhoPerg = __DIR__ . "/../../pergRes.txt";

if (file_exists($caminhoPerg)) {
    $arq = fopen($caminhoPerg, "r") or die("Erro");
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha && trim($linha) != "" && strpos($linha, "pergunta") === false) {
            $perguntas[] = explode(";", trim($linha));
        }
    }
    fclose($arq);
}

$perguntaSelecionada = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['perg'])) {
    $indice = $_POST['perg'];
    if (isset($perguntas[$indice])) {
        $perguntaSelecionada = $perguntas[$indice];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar uma pergunta</title>
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
    <?php include '../../navs/nav.php'; ?>
    <?php include '../../navs/nav_perguntas.php'; ?>

    <h2>Escolha uma pergunta</h2>
    <main class="main-align">
        <form action="listarUmaPerg.php" method="POST">
            <select name="perg">
                <?php foreach ($perguntas as $i => $perg) {
                    echo "<option value='$i'>" . $perg[0] . "</option>";
                } ?>
            </select>
            <input type="submit" value="Exibir">
        </form>

        <?php if ($perguntaSelecionada) { ?>
            <h3>Pergunta <?php echo $perguntaSelecionada[0]; ?>: </h3>

            <?php if ($perguntaSelecionada[2] || $perguntaSelecionada[3] || $perguntaSelecionada[4] || $perguntaSelecionada[5] || $perguntaSelecionada[6]) { 
                        echo $perguntaSelecionada[1];
            ?>
                <ul>
                    <li>A: <?php echo $perguntaSelecionada[2]; ?></li>
                    <li>B: <?php echo $perguntaSelecionada[3]; ?></li>
                    <li>C: <?php echo $perguntaSelecionada[4]; ?></li>
                    <li>D: <?php echo $perguntaSelecionada[5]; ?></li>
                    <li>E: <?php echo $perguntaSelecionada[6]; ?></li>
                </ul>
                <p>Resposta correta: <?php echo $perguntaSelecionada[7]; ?></p>
                        
            <?php } else { 
                echo $perguntaSelecionada[1];
            ?>
                
                <p>Resposta discursiva: <?php echo $perguntaSelecionada[7]; ?></p>
            <?php } ?>
        <?php } ?>
    </main>
</body>
</html>
