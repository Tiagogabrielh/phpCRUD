<?php

require "src/modelo/Cliente.php";
require "src/repositorio/ClienteRepositorio.php";
require "src/conexao-db.php";
session_start();

    
if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))   {
            
            header('location:Login.php');
    }
$clienteRepositorio = new clienteRepositorio($pdo);      
try{
    if (isset($_POST['editar'])){
        $cliente = new cliente(
            $_POST['id'],
            $_POST['data_fundacao_empresa'],
            $_POST['nome_empresa'],
            $_POST['nome_contato'],
            $_POST['data_aniversario_contato'],
            $_POST['telefone_empresa'],
            $_POST['telefone_contador'],
            $_POST['email'],
            $_POST['senha'],
            $_POST['data_cadastro'],
            $_POST['id_cont'],

            
        );

        if (($_FILES['logo']['error'] == UPLOAD_ERR_OK)){
            $cliente->setLogo(uniqid() . $_FILES['logo']['name']);
            move_uploaded_file($_FILES['logo']['tmp_name'], $cliente->getLogoDiretorio());
        }

        
        $clienteRepositorio->atualizar($cliente);
        header("Location: index.php");

        }else{
            $cliente = $clienteRepositorio->buscar($_GET['id']);
        }
}catch(Throwable $error){
    echo $error->getMessage();
    header("Location: Redireciona.php");
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/reset.css">
    <link rel="stylesheet" href="assets/styles/cadastros.css">
    <title>Editar</title>
</head>
<body class="corpo__texto">
    <header class="cabecalho" >
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </header>
    

    <section class="secao__body">
        <form class="formulario__secao" method="post" enctype="multipart/form-data" >
            <p class="p__secao cadastrar">Edite o Cliente</p>

            <label for="data_fundacao_empresa" class="label__form">Fundação:</label>
            <input type="text" id="data_fundacao_empresa" name="data_fundacao_empresa" class="input__label" value="<?= $cliente->getData_fundacao_empresa() ?>" required />

            <label for="nome_empresa"  class="label__form">Nome da Empresa:</label>
            <input type="text" id="nome_empresa" name="nome_empresa" class="input__label" value="<?= $cliente->getNome_empresa() ?>" required />

            <label for="nome_contato"  class="label__form">Nome do Contato:</label>
            <input type="text" id="nome_contato" name="nome_contato" class="input__label" value="<?= $cliente->getNome_contato() ?>" required />

            <label for="data_aniversario_contato"  class="label__form">Aniversário do Contato:</label>
            <input type="text" id="data_aniversario_contato"  name="data_aniversario_contato" class="input__label" value="<?= $cliente->getData_aniversario_contato() ?>" required />

            <label for="telefone_empresa"  class="label__form">Telefone da Empresa:</label>
            <input type="text" id="telefone_empresa" name="telefone_empresa" class="input__label" value="<?= $cliente->getTelefone_empresa() ?>" required />

            <label for="telefone_contador"  class="label__form">Telefone do Contador:</label>
            <input type="text" id="telefone_contador" name="telefone_contador" class="input__label" value="<?= $cliente->getTelefone_contador() ?>" required />

            <label for="email"  class="label__form">Email do Cliente:</label>
            <input type="text" id="email" name="email" class="input__label" value="<?= $cliente->getEmail() ?>" required />

            <label for="senha"  class="label__form">Senha do Cliente:</label>
            <input type="text" id="senha" name="senha" class="input__label" value="<?= $cliente->getSenha() ?>" required />

            <label for="data_cadastro"  class="label__form">Data do Cadastro:</label>
            <input type="text" id="data_cadastro"  name="data_cadastro" class="input__label" value="<?= $cliente->getData_cadastro() ?>" required />

            <input type="hidden" id="id_cont"  name="id_cont" value="<?= $_SESSION['id_contr'] ?>" />

            <label for="logo"  class="label__form">Logo:</label>
            <input type="file" id="logo"  name="logo" class="input__label" value="<?= $cliente->getLogo() ?>" />

            <div class="div__inputs div">
                <input type="hidden" name="id" value="<?= $cliente->getId()?>">
                <input type="submit" name="editar" class="botao__input botao" value="Editar">
                <button type="button" onclick="" class="botao__input botao" value="Cancelar"><a href="index.php" class="link">Cancelar</a></button>
            </div>
        </form>
    </section>

    

    <root class="rodape">
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </root>

</body>
</html>