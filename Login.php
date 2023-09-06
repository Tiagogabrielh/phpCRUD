<?php
require "src/modelo/Contador.php";
require "src/repositorio/ContadorRepositorio.php";
require "src/conexao-db.php";
session_start();
session_destroy();

$contador = new Contador(2000,'01/01/1900','padrao','padrao','01/01/1900','padrao','padrao','padrao','padrao','padrao','01/01/1900','Logo.png');
$novoEmail = "";
$novaSenha = "";
try{   
    if (isset($_POST['logar'])){
        $contador->setEmail($_POST['usuario']);
        $contador->setSenha($_POST['senha']);
      
        $contadorRepositorio = new ContadorRepositorio($pdo);
        $contadorRepositorio->salvar($contador);
         
        
        if($contadorRepositorio->verCadastro($contador->getEmail(), $contador->getSenha() )){
            session_start();
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            header("Location: index2.php");

           
        }else{
            header("Location: Login.php");
        }
            
    }else{
        
    }
}catch(Throwable $error){
    echo $error->getMessage();
    header("Location: Login.php");
    
}
    


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/reset.css">
    <link rel="stylesheet" href="assets/styles/cadastros.css">
    <title>Login</title>
</head>
<body class="corpo__texto">
    <header class="cabecalho" >
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </header>
    

    <section class="secao__body">
        <form class="formulario__secao" method="POST">
            <p class="p__secao cadastrar">Login:</p>

            <label for="usuario" class="label__form">Usuário:</label>
            <input type="text" name="usuario" class="input__label" value="<?= $novoEmail ?>" placeholder="Digite o usuário">

            <label for="senha"  class="label__form">Senha:</label>
            <input type="password" name="senha" class="input__label" value="<?= $novaSenha ?>" placeholder="Digite a senha">

            <div class="div__inputs">
                <input type="submit" onclick="" name="logar" class="botao__input" value="Logar">
                <button type="button" onclick="" class="botao__input" value="Cadastrar-se"><a href="PrimeiroLogin.php" class="link">Cadastrar-se</a></button>
            </div>
        </form>
    </section>

    

    <root class="rodape">
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </root>

</body>
</html>
