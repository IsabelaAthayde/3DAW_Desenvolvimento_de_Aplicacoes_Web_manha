<?php
$usuarios = [];
$caminhoUsuarios = "../usuarios.txt";

if (file_exists($caminhoUsuarios)) {
    $arq = fopen($caminhoUsuarios, "r") or die("erro");
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha !== false) {
            $usuarios[] = explode(";", trim($linha));
        }
    }
    fclose($arq);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de usuarios</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
</head>
<body>
     <?php include '../navs/nav.php'; ?>
    <?php include '../navs/nav_usuarios.php'; ?>
    
    <h2>Lista de usuarios</h2>
    
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>email</th>
                <th>senha</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($usuarios) > 1) { 
                for ($i = 1; $i < count($usuarios); $i++) {
                    $usuario = $usuarios[$i];
                    echo "<tr>";
                    echo "<td>" . $usuario[0] . "</td>";
                    echo "<td>" . $usuario[1] . "</td>";
                    echo "<td>" . $usuario[2] . "</td>";
                    echo "<td>
                            <a style='color: green;'  href='/AV1-3DAW/CRUDusuario/alterar.php?id=$i'>Editar</a> | 
                            <a style='color: red;' href='deletar.php?id=$i' onclick=\"return confirm('Tem certeza?')\">Deletar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum usuario adicionado</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
