 <?php
    $pergunta = $_POST['pergunta'];
    $rA = $_POST['rA'];
    $rB = $_POST['rB'];
    $rC = $_POST['rC'];
    $rD = $_POST['rD'];
    $rE = $_POST['rE'];
    $rCerta = $_POST['rCerta'];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!file_exists("pergRes.txt")) {
            $arq = fopen("pergRes.txt", "w") or die("erro ao criar arquivo");
            $linha = "pergunta;rA;rB;rC;rD;rE;rCerta\n";

            fwrite($arq, $linha);
            fclose($arq);
        }

        $arqA = fopen("pergRes.txt", "a") or die("erro ao criar arquivo");
        $linha = $pergunta . ";" . $rA . ";" . $rB . ";" . $rC . ";" . $rD . ";" . $rE . ";" . $rCerta . "\n";

        fwrite($arqA, $linha);
        fclose($arqA);

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
<h1>Criar nova pergunta com resposta multipla</h1>

    <form action="criarmulti.php" method="POST">

    
        <label for="pergunta">Pergunta:</label>
        <input type="text" name="pergunta" id="pergunta" required><br>

         <label for="rA">Resposta letra A:</label>
        <input type="text" name="rA" id="rA" required><br>
        
        <label for="rB">Resposta letra B:</label>
        <input type="text" name="rB" id="rB" required><br>

        <label for="rC">Resposta letra C:</label>
        <input type="text" name="rC" id="rC" required><br>

        <label for="rD">Resposta letra D:</label>
        <input type="text" name="rD" id="rD" required><br>

        <label for="rE">Resposta letra E:</label>
        <input type="text" name="rE" id="rE" required><br>

        <label for="rCerta">Resposta Certa:</label>
        <input type="text" name="rCerta" id="rCerta" required><br> 

        <input type="submit" value="Cadastrar">
    </form>

</body>
</html>

