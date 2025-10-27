<?php
    $caminhoPerg = __DIR__ . "/../../pergRes.txt";
    $header = '';
    $perguntasById = [];

    if (file_exists($caminhoPerg)) {
        $arq = fopen($caminhoPerg, 'r') or die('erro');
        $firstLine = fgets($arq);
        if ($firstLine !== false) $header = rtrim($firstLine, "\r\n");

        while (!feof($arq)) {
            $linha = fgets($arq);
            if ($linha !== false && trim($linha) !== '') {
                $campos = explode(';', trim($linha));
                while (count($campos) < 8) $campos[] = '';
                $idRow = $campos[0];
                $perguntasById[$idRow] = $campos;
            }
        }
        fclose($arq);
    }

    if (!isset($_GET['id'])) die("Pergunta não encontrada");
    $id = $_GET['id'];
    if (!isset($perguntasById[$id])) die("Pergunta não encontrada");

    $pergunta = $perguntasById[$id];
    $msg = '';

    $currentAnswer = $pergunta[7];  

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $textoPergunta = $_POST['pergunta'] ?? '';
        $resposta = $_POST['resposta'] ?? '';

        $pergunta[1] = $textoPergunta;
        $pergunta[7] = $resposta;
        $perguntasById[$id] = $pergunta;

        $arq = fopen($caminhoPerg, 'w') or die('erro');
        if ($header !== '') fwrite($arq, $header . PHP_EOL);
        foreach ($perguntasById as $row) {
            while (count($row) < 8) $row[] = '';
            fwrite($arq, implode(';', $row) . PHP_EOL);
        }
        fclose($arq);

        $msg = "Pergunta alterada com sucesso!";
        $currentAnswer = $resposta;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Pergunta Discursiva</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
    <style>
        form {
            color: white;
            margin: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 25px;

        }
    </style>
</head>
<body>
    <?php include '../../navs/nav.php'; ?>
    <?php include '../../navs/nav_perguntas.php'; ?>

    <h2>Alterar Pergunta Discursiva</h2>
    <main class="main-align">
        <form action="alterarDisc.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
            <p>ID: <?php echo htmlspecialchars($id); ?></p>
            <p>Pergunta:</p> <input type="text" name="pergunta" value="<?php echo htmlspecialchars($pergunta[1] ?? ''); ?>" required>
            <p>Resposta:</p>  <textarea name="resposta" required><?php echo htmlspecialchars($currentAnswer ?? ''); ?></textarea>
            <input type="submit" value="Salvar">
        </form>

        <p><?php echo htmlspecialchars($msg); ?></p>
    </main>
</body>
</html>
