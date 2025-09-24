<?php
    $perguntas = [];
    $caminhoPerg = __DIR__ . "/../../pergRes.txt";
    $msg = " ";
    if (file_exists($caminhoPerg)) {
        $arq = fopen($caminhoPerg, "r") or die("erro");
        while (!feof($arq)) {
            $linha = fgets($arq);
            if ($linha !== false) {
                $perguntas[] = explode(";", trim($linha));
            }
        }
        fclose($arq);
    }
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("Pergunta não encontrada");
    }

    if (isset($perguntas[$id])) {
        $pergunta = $perguntas[$id];
    } else {
        die("Pergunta não encontrada");
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $texto = $_POST['pergunta'];
        $a = $_POST['respostaA'];
        $b = $_POST['respostaB'];
        $c = $_POST['respostaC'];
        $d = $_POST['respostaD'];
        $e = $_POST['respostaE'];
        $certa = $_POST['respostaCerta'];

        $perguntas[$id] = [$pergunta[0], $texto, $a, $b, $c, $d, $e, $certa];

        $arq = fopen($caminhoPerg, "w") or die("erro");
        foreach ($perguntas as $p) {
            $linha = implode(";", $p) . "\n";
            fwrite($arq, $linha);
        }
        fclose($arq);

        $msg = "Pergunta alterada com sucesso!";
        $pergunta = $perguntas[$id];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Pergunta</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
    <style>
        form {
            color: white;
            margin: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 15px;

        }

        input {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include '../../navs/nav.php'; ?>
    <?php include '../../navs/nav_perguntas.php'; ?>
    <h2>Alterar Pergunta</h2>

   
    <main class="main-align">

        <form action="alterarMulti.php?id=<?php echo $id; ?>" method="POST">
            ID: <?php echo $pergunta[0]; ?>  <br>
            Pergunta: <input type="text" name="pergunta" value="<?php echo $pergunta[1]; ?>">  
            Opção A: <input type="text" name="respostaA" value="<?php echo $pergunta[2]; ?>">  
            Opção B: <input type="text" name="respostaB" value="<?php echo $pergunta[3]; ?>">  
            Opção C: <input type="text" name="respostaC" value="<?php echo $pergunta[4]; ?>">  
            Opção D: <input type="text" name="respostaD" value="<?php echo $pergunta[5]; ?>">  
            Opção E: <input type="text" name="respostaE" value="<?php echo $pergunta[6]; ?>">  
            Resposta certa: 
            <select name="respostaCerta" id="respostaCerta" required>
                <option value="A" <?php if (($pergunta[7] ?? '') === 'A') echo 'selected'; ?>>A</option>
                <option value="B" <?php if (($pergunta[7] ?? '') === 'B') echo 'selected'; ?>>B</option>
                <option value="C" <?php if (($pergunta[7] ?? '') === 'C') echo 'selected'; ?>>C</option>
                <option value="D" <?php if (($pergunta[7] ?? '') === 'D') echo 'selected'; ?>>D</option>
                <option value="E" <?php if (($pergunta[7] ?? '') === 'E') echo 'selected'; ?>>E</option>
            </select>
            <br>
            <input type="submit" value="Salvar">
        </form>

        <p><?php echo $msg ?></p>
    </main>

</body>
</html>
