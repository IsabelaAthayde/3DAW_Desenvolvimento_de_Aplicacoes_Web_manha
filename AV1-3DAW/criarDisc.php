 <?php
    $pergunta = $_POST['pergunta'];
    $resp = $_POST['resp'];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!file_exists("pergResDisc.txt")) {
            $arq = fopen("pergResDisc.txt", "w") or die("erro ao criar arquivo");
            $linha = "pergunta;resp\n";

            fwrite($arq, $linha);
            fclose($arq);
        }

        $arq = fopen("pergResDisc.txt", "a") or die("erro ao criar arquivo");
        $linha = $pergunta . ";" . $resp . "\n";

        fwrite($arq, $linha);
        fclose($arq);

    }
?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Pergunta</title>
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
<h1>Criar nova pergunta com resposta discursiva</h1>

    <form action="criarDisc.php" method="POST">

    
        <label for="pergunta">Pergunta:</label>
        <input type="text" name="pergunta" id="pergunta" required><br>

         <label for="resp">Resposta:</label>
        <input type="text" name="resp" id="resp" required><br>

        <input type="submit" value="Cadastrar">
    </form>

</body>
</html>

