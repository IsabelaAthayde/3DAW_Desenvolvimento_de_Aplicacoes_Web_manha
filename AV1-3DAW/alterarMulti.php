<?php

    if (!file_exists("pergRes.txt")) {
        echo "Não é possivel alterar perguntas não existentes!";

    }
    
    $arqPR = fopen("pergRes.txt", "r") or die("erro ao criar arquivo");

    $dados = [];

    while(!feof($arqPR))    
    {
        if()
        if ($linha !== false) {
            $dados[] = explode(";", trim($linha));
        }
        
        echo $dados[0] . "\n";
        echo $dados[1] . "\n";
        echo $dados[2] . "\n";
        echo $dados[3] . "\n";
        echo $dados[4] . "\n";
        echo $dados[5] . "\n";
        echo $dados[6] . "\n";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pergunta</title>
</head>
<body>

<h1>Editar Pergunta</h1>

<section>
    <form action="alterarMulti.php"method="POST">
 
        <label for="pergunta">pergunta:</label>
        <input type="text" name="pergunta" value="<?php echo $pergunta[0]; ?>" required><br>

        <label for="respostaA">Opção A:</label>
        <input type="text" name="respostaA" value="<?php echo $pergunta[1]; ?>" required><br>

        <label for="respostaB">Opção B:</label>
        <input type="text" name="respostaB" value="<?php echo $pergunta[2]; ?>" required><br>

        <label for="respostaC">Opção C:</label>
        <input type="text" name="respostaC" value="<?php echo $pergunta[3]; ?>" required><br>

        <label for="respostaD">Opção D:</label>
        <input type="text" name="respostaD" value="<?php echo $pergunta[4]; ?>" required><br>

         <label for="respostaE">Opção E:</label>
        <input type="text" name="respostaE" value="<?php echo $pergunta[5]; ?>" required><br>

        <label for="respostaCerta">Resposta Correta:</label>
        <input type="text" name="respostaCorreta" value="<?php echo $pergunta[6]; ?>" required><br>

        <input type="submit" value="Atualizar">
    </form>
</section>



<a href="">Voltar à lista de perguntas</a>

</body>
</html>
