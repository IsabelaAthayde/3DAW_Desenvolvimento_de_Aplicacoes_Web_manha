<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $pergunta = $_POST['pergunta'];
        $resp = $_POST['resp'];
        
        $caminhoPerg = __DIR__ . "/../../pergRes.txt";

        if(!file_exists($caminhoPerg)) {
            $arq = fopen($caminhoPerg, "w") or die("erro ao criar arquivo");
            $linha = "id;pergunta;rA;rB;rC;rD;rE;rCerta\n";
            fwrite($arq, $linha);
            fclose($arq);
        }

        $id = 1;
        $arq = fopen($caminhoPerg, "r") or die("Erro ao abrir arquivo");
        fgets($arq);
        while(!feof($arq)) {
            $linha = fgets($arq);
            if($linha !== false && trim($linha) != "") {
                $campos = explode(";", trim($linha));
                $id = ((int)$campos[0]) + 1;
            }
        }
        fclose($arq);

        $arq = fopen($caminhoPerg, "a") or die("erro ao abrir arquivo");
        $linha = $id . ";" . $pergunta . ";;;;;;" . $resp . "\n";
        fwrite($arq, $linha);
        fclose($arq);

        $msg = "Pergunta discursiva cadastrada com sucesso!";
    }
?>
 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Pergunta Discursiva</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
    <style>
        form {
            margin: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        input:not([type="submit"]):first-of-type {
            height: 100px;
        }
    </style>
</head>

<body>
     <?php include '../../navs/nav.php'; ?>
    <?php include '../../navs/nav_perguntas.php'; ?>
    <h2>Criar nova pergunta com resposta discursiva</h2>
    <main class="main-align">
        <form action="criarDisc.php" method="POST">

        
            <label for="pergunta">Pergunta:</label>
            <input type="text" name="pergunta" id="pergunta" required><br>

            <label for="resp">Resposta:</label>
            <textarea rows="5" cols="30" name="resp" id="resp" required></textarea>
            <br>

            <input type="submit" value="Cadastrar">
        </form>

        <?php $msg ?>
    </main>
</body>
</html>

