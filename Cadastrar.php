<?php

require "src/modelo/Cliente.php";
require "src/repositorio/ClienteRepositorio.php";
require "src/conexao-db.php";
session_start();
if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))   {
            
            header('location:Login.php');
    }

try{   
    if (isset($_POST['cadastro'])){


        
        $cliente = new cliente(null,
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
        

        if (($_FILES['logotipo']['error'] == UPLOAD_ERR_OK)){

            
            $cliente->setLogo(uniqid() . $_FILES['logotipo']['name']);
            move_uploaded_file($_FILES['logotipo']['tmp_name'], $cliente->getLogoDiretorio());
           
         }else{
            var_dump("Logo.png");
         }

        $clienteRepositorio = new clienteRepositorio($pdo);
        $clienteRepositorio->salvar($cliente);

        header("Location: index.php");
        
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
    <title>Cadastro</title>
</head>
<body class="corpo__texto">
    
    <header class="cabecalho" >
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </header>
    

    <section class="secao__body">
        <form class="formulario__secao" method="post" enctype="multipart/form-data" >
            <p class="p__secao cadastrar">Cadastre o Cliente</p>

            <label for="data_fundacao_empresa" class="label__form">Data da Fundação da Empresa:</label>
            <input type="text" id="data_fundacao_empresa" name="data_fundacao_empresa" class="input__label" placeholder="XX/XX/XXXX" required />

            <label for="nome_empresa"  class="label__form">Nome da Empresa:</label>
            <input type="text" id="nome_empresa" name="nome_empresa" class="input__label" placeholder="Digite o nome da empresa" required />

            <label for="nome_contato"  class="label__form">Nome do Contato:</label>
            <input type="text" id="nome_contato" name="nome_contato" class="input__label" placeholder="Digite o nome do contato" required />

            <label for="data_aniversario_contato"  class="label__form">Aniversário do Contato:</label>
            <input type="text" id="data_aniversario_contato"  name="data_aniversario_contato" class="input__label" placeholder="XX/XX/XXXX" required />

            <label for="telefone_empresa"  class="label__form">Telefone da Empresa:</label>
            <input type="tel" id="telefone_empresa" name="telefone_empresa" class="input__label" placeholder="(XX) XXXX-XXXX" required />

            <label for="telefone_contador"  class="label__form">Telefone do Contador:</label>
            <input type="tel" id="telefone_contador" name="telefone_contador" class="input__label" placeholder="(XX) XXXX-XXXX" required />

            <label for="email"  class="label__form">Email do Cliente:</label>
            <input type="email" id="email" name="email" class="input__label" placeholder="Digite o Email do Cliente" required />

            <label for="senha"  class="label__form">Senha do Cliente:</label>
            <input type="password" id="senha" name="senha" class="input__label" placeholder="Digite a Senha do Cliente " required />

            <label for="data_cadastro"  class="label__form">Data do Cadastro:</label>
            <input type="text" id="data_cadastro"  name="data_cadastro" class="input__label" placeholder="XX/XX/XXXX" required />

            <label for="logotipo"  class="label__form">Logotipo:</label>
            <input type="file" id="logotipo"  name="logotipo" class="input__label" >

            <input type="hidden" id="id_cont"  name="id_cont" value="<?= $_SESSION['id_contr'] ?>">

            <div class="div__inputs">
                <input type="submit" name="cadastro" class="botao__input" value="Cadastrar" />
                <button type="button" onclick="" class="botao__input" value="Cancelar"><a href="index.php" class="link">Cancelar</a></button>
            </div>
        </form>
    </section>

    

    <root class="rodape">
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </root>

</body>
</html>