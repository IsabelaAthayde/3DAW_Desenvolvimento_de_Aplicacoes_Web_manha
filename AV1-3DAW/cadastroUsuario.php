<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (!file_exists("usuarios.txt")) {
        $arqUsuarios = fopen("usuarios.txt","w") or die("erro ao criar arquivo");
        $linha = "nome;email;senha\n";
        fwrite($arqUsuarios,$linha);
        fclose($arqUsuarios);
    }

    $arqUsuarios = fopen("usuarios.txt","a") or die("erro ao abrir arquivo");
    $linha = $nome . ";" . $email . ";" . $senha . "\n";
    fwrite($arqUsuarios,$linha);
    fclose($arqUsuarios);

    $msg = "Usuario Adicionado com sucesso!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuario</title>
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
<h1>Cadastrar Usuario</h1>
<form action="cadastroUsuario.php" method="POST">

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
<br>


</body>
</html>
