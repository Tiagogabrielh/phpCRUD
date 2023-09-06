<?php

session_start();    
if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))   {
            
    header('location:Login.php');
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/reset.css">
    <link rel="stylesheet" href="assets/styles/cadastros.css">
    <title>Redirecionamento</title>
</head>
<body class="corpo__texto">
    <header class="cabecalho" >
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </header>
    

    <section class="secao__body">
        <form class="formulario__secao" method="POST">
            <p class="p__secao cadastrar">Transação Mal Sucedida</p>
            <p class="p__secao cadastrar">Verifique todos os campos antes de dar sequência à operação</p>

            <div class="div__inputs">
                <button type="button" class="botao__input" value="Lista"><a href="index.php" class="link">Lista</a></button>  
                <button type="button" class="botao__input" value="Tabela"><a href="index2.php" class="link">Tabela</a></button>   
            </div>
        </form>
    </section>

    

    <root class="rodape">
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </root>

</body>
</html>