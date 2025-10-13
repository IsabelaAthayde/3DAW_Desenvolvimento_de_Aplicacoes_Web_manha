<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET')  {
    $id = $_GET["id"];
    $msg = "";
    $resultado = array();

    $arqPerg = fopen("perguntas.txt","r") or die("Erro ao abrir arquivo");

    while(!feof($arqPerg)) {
        $linha = trim(fgets($arqPerg));
        if ($linha != "") {
            $colunaDados = explode(";", $linha);
            if ($colunaDados[0] == $id) {
                $resultado["id"] = $colunaDados[0];
                $resultado["pergunta"] = $colunaDados[1];
                $resultado["tipo"] = $colunaDados[2];
                break;
            }
        }
    }

    fclose($arqPerg);

    if (count($resultado) > 0) {
        $msg = "Pergunta encontrada com sucesso!";
    } else {
        $msg = "Pergunta não encontrada!";
    }

    $jPergunta = json_encode($resultado, JSON_UNESCAPED_UNICODE);
    echo $jPergunta;
}
?>
