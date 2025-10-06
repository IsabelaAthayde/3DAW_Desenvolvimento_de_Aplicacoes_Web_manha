<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nome = $_GET["nome"];
    $email = $_GET["email"];
    $senha = $_GET["senha"];

    $caminhoUsuarios = "../usuarios.txt";

    if (!file_exists($caminhoUsuarios)) {
        $arq = fopen($caminhoUsuarios, "w") or die("Erro ao criar arquivo");
        fwrite($arq, "id;nome;email;senha\n");
        fclose($arq);
    }

    $linhas = file($caminhoUsuarios, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $ultimoId = 0;

    foreach ($linhas as $i => $linha) {
        if ($i == 0) continue;
        $dados = explode(";", $linha);
        if (isset($dados[0]) && is_numeric($dados[0])) {
            $ultimoId = max($ultimoId, (int)$dados[0]);
        }
    }

    $novoId = $ultimoId + 1;

    $idExiste = false;
    foreach ($linhas as $linha) {
        $dados = explode(";", $linha);
        if ($dados[0] == $novoId) {
            $idExiste = true;
            break;
        }
    }

    if ($idExiste) {
        echo "Erro: ID já existente. Tente novamente.";
        exit;
    }

    $arq = fopen($caminhoUsuarios, "a") or die("Erro ao abrir arquivo");
    $linha = $novoId . ";" . $nome . ";" . $email . ";" . $senha . "\n";
    fwrite($arq, $linha);
    fclose($arq);

    echo "Usuário cadastrado com sucesso! (ID: $novoId)";
}
?>
