<?php
    require "src/modelo/Cliente.php";
    require "src/repositorio/ClienteRepositorio.php";
    require "src/conexao-db.php";
    session_start();
    $i = $_SESSION['id_contr'];
    
    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))   {
            
             header('location:Login.php');
       }
    $clienteRepositorio = new ClienteRepositorio($pdo);
    $dadosCliente = $clienteRepositorio->buscarTodos($i);

    if (isset($_POST['Cadastrar'])){
              
        header("Location: Cadastrar.php");
       
    }else{
        
    }

    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/reset.css">
    <link rel="stylesheet" href="assets/styles/lista.css">
    <title>Lista</title>
</head>
<body class="corpo__texto">
    <header class="cabecalho">
    <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </header>

    <p class="texto__bem-vindo">Bem vindo</p>

    <section class="secao__body">

    <?php foreach($dadosCliente as $dados):?>
        <div class="div__secao">
            <div class="div__img">
                <img src="<?= $dados->getLogoDiretorio()?>" alt="" class="img__div">
            </div>
            <div class="div__texto" >
                <p class="p__div"> Fundação:   <?=  $dados->getData_fundacao_empresa() ?> </p>
                <p class="p__div"> Empresa:  <?=  $dados->getNome_empresa() ?> </p>
                <p class="p__div"> Nome do Contato:   <?=  $dados->getNome_contato() ?> </p>
                <p class="p__div"> Aniversário:  <?=  $dados->getData_aniversario_contato() ?> </p>
                <p class="p__div"> Telefone:    <?=  $dados->getTelefone_empresa() ?> </p>
                <p class="p__div"> Email:    <?=  $dados->getEmail() ?> </p>
                <p class="p__div"> Senha:    <?=  $dados->getSenha() ?> </p>
                <p class="p__div"> Telefone Contador:   <?=  $dados->getTelefone_contador() ?> </p>
                <p class="p__div"> Id do Contador:    <?=  $dados->getId_contador() ?> </p>
                <p class="p__div"> Data do Cadastro:    <?=  $dados->getData_cadastro() ?> </p>
            </div>
            <div class="div__inputs">
                 <form action="Deleta.php" method="POST">
                    <input type="hidden" name="id" value="<?= $dados->getId() ?>">
                    <input type="submit" class="botao__input" value="Deletar">
                </form>
                <button class="botao__input"><a class="link" href="Edita.php?id=<?= $dados->getId() ?>">Editar</a></button>
            </div>
        </div>

    <?php endforeach; ?>  
    </section>
    <form method="POST"  enctype="multipart/form-data" class="formulario">
    <input type="submit" name="Cadastrar" value="Cadastrar Cliente" class="botao__adicionar">
    <button class="botao__adicionar"><a href="index2.php" class="link">Tabela</a></button>
    <button class="botao__adicionar"><a href="Sair.php" class="link">Sair</a></button>
    </form>
    
    <root class="rodape">
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </root>

</body>
</html>
