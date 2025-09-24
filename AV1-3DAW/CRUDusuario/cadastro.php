<?php
$msg = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $caminhoUsuarios = "../usuarios.txt";

    if (!file_exists($caminhoUsuarios)) {
        $arq = fopen($caminhoUsuarios,"w") or die("erro ao criar arquivo");
        $linha = "nome;email;senha\n";
        fwrite($arq,$linha);
        fclose($arq);
    }

    $arq = fopen($caminhoUsuarios,"a") or die("erro ao abrir arquivo");
    $linha = $nome . ";" . $email . ";" . $senha . "\n";
    fwrite($arq,$linha);
    fclose($arq);

    $msg = "Usuario Adicionado com sucesso!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuario</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
</head>
<body>
    <main class="main-align">
            <h2>Cadastrar Usuario</h2>
            <form action="cadastro.php" method="POST">

                <label for="nome">Nome:</label>
                <input type="text" name="nome" required> 
                <br><br>

                <label for="email">Email:</label>
                <input type="text" name="email" required>
                <br><br>

                <label for="senha">Senha:</label>
                <input type="text" name="senha" required>
                <br><br>

                <input type="submit" value="Cadastrar">
            </form>

            <p><?php echo $msg ?></p>
    </main>

</body>
</html>
