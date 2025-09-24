<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit;
    }
    if (isset($_GET['reset_quiz']) && $_GET['reset_quiz'] == 1) {
        unset($_SESSION['indice']);
        unset($_SESSION['respostas']);
    }
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
    } else {
        $id = $_SESSION['usuario'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
    
    <style>
        .faq-section {
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            text-align: center;
            line-height: 1;
        }

        .faq-section h3 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .faq-section p {
            color: var(--primary-grey);
            font-size: 1em;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .faq-section a {
            display: block;
            font-weight: bold;
        }
    </style>
    </head>
    <body>
        <?php include 'navs/nav.php'; ?>
            
        <h1>Bem-vindo, <span><?php echo $_SESSION['usuario_nome']; ?></span></h1>
            <section class="faq-section">
                <h3>FAQ</h3>
                <p>Alterar e deletar perguntas em:<br> <a href="#outros"> &gt; Listar Todas as Perguntas na &gt; seção Outros</a></p>
                <p>Deletar usuários está em:<br> <a href="#outros"> &gt; Listar todos os Usuários na &gt; seção Outros</a></p>
            </section>
        <main>
            

            <section>
                <h3>Perguntas e Respostas</h3>
                <a href="/AV1-3DAW/CRUDpergunta/criar/criarmulti.php">Criar Múltipla Escolha</a><br>
                <a href="/AV1-3DAW/CRUDpergunta/criar/criarDisc.php">Criar Discursiva</a><br>
                <a href="/AV1-3DAW/CRUDpergunta/listar/listarPR.php?reset=1.php">Quiz Perguntas e Respostas</a><br>
                <a href="/AV1-3DAW/CRUDpergunta/listar/listarUmaPerg.php">Listar Uma Pergunta</a><br>

            </section>

            <div class="separator"></div>
            
            <section>
                <h3>Usuários</h3>
                <a href="/AV1-3DAW/CRUDusuario/alterar.php?id=<?php echo $id; ?>">Alterar meu Perfil</a><br>
            </section>
            <div class="separator"></div>

            <section id="outros">
                <h3>Outros (por razões educacionais)</h3>
                <a href="/AV1-3DAW/CRUDpergunta/listar/listarTodasP.php">Listar Todas as Perguntas</a><br>
                <a href="/AV1-3DAW/CRUDusuario/listar.php">Listar todos os Usuários</a><br>
                <a href="/AV1-3DAW/CRUDusuario/buscar.php">Buscar Usuários</a><br>
            </section>

        </main>

    </body>
</html>
