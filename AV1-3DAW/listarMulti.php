
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de perguntas e respostas</title>
</head>
<body>
    <nav>
        <br>
        <a href="criarmulti.php">criar resp multiplas </a> - 
        <a href="criarDisc.php">criar resp Discursivas </a> - 
        <a href="listarMulti.php">listar resp multiplas </a> - 
        <br>
        <a href="listarDisc.php">listar resp Discursivas </a> - 
        <a href="cadastroUsuario.php">cadastroUsuario </a> - 
        <a href="listarUsuarios.php">listarUsuarios </a> - 
        <br>
        <a href="alterarMulti.php">alterar resp multiplas </a> - 
        <a href="alterarDisc.php">alterar resp Discursivas </a> - 
        
    </nav>
    <h2>Lista de perguntas e respostas </h2>

    
    <?php
        $perg = [];

        if (file_exists("pergRes.txt")) {
            $arqPerg = fopen("pergRes.txt", "r") or die("erro");
            while (!feof($arqPerg)) {
                $linha = fgets($arqPerg);
                if ($linha !== false) {
                    $perg = explode(";", trim($linha));
                    

                    if ($perg[0] != "pergunta") { 
                        echo "<br>". $perg[0];
                        echo "<br>A: " . $perg[1];
                        echo "<br>B: " . $perg[2];
                        echo "<br>C: " . $perg[3];
                        echo "<br>D: " . $perg[4];
                        echo "<br>E: " . $perg[5]. "<br>";
                    } 
                    
                }
            }
            fclose($arqPerg);
        }
    ?>

        <br>
    <form action="listarMulti.php" method="POST">
        <label for="resposta">Digite as respostas em sequencia:</label><input type="text" name="resposta" placeholder="A/B/C/D/E">
        
        <input type="submit" value="Enviar">

    </form>
</body>
</html>

