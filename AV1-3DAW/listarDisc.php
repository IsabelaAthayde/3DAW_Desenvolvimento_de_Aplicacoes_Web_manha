

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de perguntas</title>
</head>
<body>
    <nav>
        <br>
        <a href="criarmulti.php">criar resp multiplas </a> - 
        <a href="criarDisc.php">criar resp Discursivas </a> - 
        <a href="listarMulti.php">listar resp multiplas </a> - 
        <br>
        <a href="listarDisc.php">listar resp Discursivas </a> - 
        <a href="listarUmaPerg.php">listar resp Discursivas </a> -  
        <a href="cadastroUsuario.php">cadastroUsuario </a> - 
        <a href="listarUsuarios.php">listarUsuarios </a> - 
        <br>
        <a href="alterarMulti.php">alterar resp multiplas </a> - 
        <a href="alterarDisc.php">alterar resp Discursivas </a> - 
        
    </nav>
    <h2>Lista de perguntas discursivas </h2>

    <br><br>
    
    <?php
    $perg = [];

    if (file_exists("pergResDisc.txt")) {
        $arqPerg = fopen("pergResDisc.txt", "r") or die("erro");
        while (!feof($arqPerg)) {
            $linha = fgets($arqPerg);
            if ($linha !== false) {
                $perg = explode(";", trim($linha));
                
                if($perg[0] != "pergunta") {
                    echo "<form action='listarMulti.php' method='POST'>" ;
    
                        echo "<br>". $perg[0];"<br>";
                        
                        echo "<br> <label for='resposta'>R:</label><input type='text' name='resposta'>
                        <input type='submit' value='Enviar'>";

                    echo "</form> <br>";
                }
            }
        }
        fclose($arqPerg);
    }
    ?>
</body>
</html>
