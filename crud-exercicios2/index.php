<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $sigla = $_POST["sigla"];
    $carga = $_POST["carga"];

    $arqDisc = fopen("disciplinas.txt", "a") or die("erro ao criar arquivo");

    $linha = "$nome;$sigla;$carga\n";

    fwrite($arqDisc, $linha);
    fclose($arqDisc);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Criar Disciplinas</title>
    <style>
        .alinhado label {
            display: inline-block;
            width: 120px;
            margin-right: 10px;
            margin-top: 0;
            margin-bottom: 0;
        }
        p {
            margin-top: 0;
            margin-bottom: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: fit-content;
            gap: 20px;
        }
        form input[type="submit"] {
            width: 100px;
            margin-left: 120px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul class="menu-lateral">
                <li><a href="index.php">Criar</a></li>
                <li><a href="listar.php">Listar</a></li>
                <li><a href="buscar.php">Buscar</a></li>
            </ul>
        </nav>
    </header>

    <h1>Crie uma Nova Disciplina</h1>
    <form action="index.php" method="POST">
        <p class="alinhado">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
        </p>

        <p class="alinhado">
            <label for="sigla">Sigla:</label>
            <input type="text" name="sigla" id="sigla">
        </p>

        <p class="alinhado">
            <label for="carga">Carga Horária:</label>
            <input type="text" name="carga" id="carga">
        </p>

        <input type="submit" value="Salvar">
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<p>Disciplina salva com sucesso!</p>";
    }
    ?>
</body>

</html>