<?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $pergunta = $_GET['pergunta'];
        $rA = $_GET['rA'];
        $rB = $_GET['rB'];
        $rC = $_GET['rC'];
        $rD = $_GET['rD'];
        $rE = $_GET['rE'];
        $rCerta = $_GET['rCerta'];

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

        $arqA = fopen($caminhoPerg, "a") or die("erro ao criar arquivo");
        $linha = $id . ";" . $pergunta . ";" . $rA . ";" . $rB . ";" . $rC . ";" . $rD . ";" . $rE . ";" . $rCerta . "\n";

        fwrite($arqA, $linha);
        fclose($arqA);
        
        echo "Pergunta cadastrada com sucesso!";
    }
?> 