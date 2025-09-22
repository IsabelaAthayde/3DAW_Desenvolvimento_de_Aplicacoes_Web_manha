<?php
    $linhaSeparada = [];
    $dados = [];
    $i = 0;
    if (file_exists("pergResDisc.txt")) {
        $arqPerg = fopen("pergResDisc.txt", "r") or die("erro");
        while (!feof($arqPerg)) {
            $linha = fgets($arqPerg);
            if ($linha !== false) {
                $linhaSeparada = explode(";", trim($linha));
                
                
                if($linhaSeparada[0] != "pergunta") {
                    $dados[$i] = $linhaSeparada[0];

                    $i++;
                }
            }
        }
        fclose($arqPerg);
    }
?>

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
        <a href="cadastroUsuario.php">cadastroUsuario </a> - 
        <a href="listarUsuarios.php">listarUsuarios </a> - 
        <br>
        <a href="alterarMulti.php">alterar resp multiplas </a> - 
        <a href="alterarDisc.php">alterar resp Discursivas </a> - 
        
    </nav>
    <h2>Lista de perguntas discursivas </h2>
    <a href="criarmulti.php">criar resp multiplas </a> - 
    <a href="criarDisc.php">criar resp Discursivas </a> - 

    <br><br>
    <form action='listarUmaPerg.php' method='POST'>
    <?php
        
        echo "<label for="perg">Escolha uma pergunta para exibir:</label>";
        echo "<select name='perg' id='perg'>";
        foreach($dados as $elem) {
            echo "<option value='". $dados[$elem] ."'></option>";
        }
        echo "</select>";

        echo "<input type='submit' value='Enviar'>";
    ?>
    </form> <br>
</body>
</html>
