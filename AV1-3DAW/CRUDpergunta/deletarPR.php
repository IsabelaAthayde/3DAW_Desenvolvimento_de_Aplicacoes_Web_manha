<?php
$perguntas = [];
$caminhoPerg = __DIR__ . "/../pergRes.txt";

if (!file_exists($caminhoPerg)) {
    die("Arquivo de perguntas não encontrado");
}

$arq = fopen($caminhoPerg, "r") or die("Erro ao abrir arquivo");
$cabecalho = fgets($arq);
while (!feof($arq)) {
    $linha = fgets($arq);
    if ($linha !== false && trim($linha) != "") {
        $campos = explode(";", trim($linha));
        $campos[0] = trim($campos[0]); 
        $perguntas[] = $campos;
    }
}
fclose($arq);

if (!isset($_GET['id'])) {
    die("ID não fornecido");
}

$id = trim($_GET['id']);
$encontrado = false;

$perguntasAtualizadas = [];
foreach ($perguntas as $p) {
    if ($p[0] === $id) {
        $encontrado = true;
        continue; 
    }
    $perguntasAtualizadas[] = $p;
}

if (!$encontrado) {
    die("Pergunta não encontrada");
}

$arq = fopen($caminhoPerg, "w") or die("Erro ao abrir arquivo");
fwrite($arq, $cabecalho); 
foreach ($perguntasAtualizadas as $p) {
    fwrite($arq, implode(";", $p) . "\n");
}
fclose($arq);

echo "<p>Pergunta excluída com sucesso!</p>";
echo '<p><a href="/AV1-3DAW/CRUDpergunta/listar/listarTodasP.php">Voltar à lista de perguntas</a></p>';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Logout</title>
        <link rel="stylesheet" href="/AV1-3DAW/style.css">
        <script>
            window.location.href = "/AV1-3DAW/CRUDpergunta/listar/listarTodasP.php";
        </script>
    </head>
    <body>
        <p>Você foi deslogado. Caso não seja redirecionado automaticamente, <a href="/AV1-3DAW/CRUDpergunta/listar/listarTodasP.php">clique aqui</a>.</p>
    </body>
</html>