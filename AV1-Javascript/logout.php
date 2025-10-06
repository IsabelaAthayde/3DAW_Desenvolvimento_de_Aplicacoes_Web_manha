<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Logout</title>
        <link rel="stylesheet" href="/AV1-Javascript/style.css">
 

        <script>
            window.location.href = "index.html";
        </script>
    </head>
    <body>
        <p>Você foi deslogado. Caso não seja redirecionado automaticamente, <a href="index.html">clique aqui</a>.</p>
    </body>
</html>
