<?php

        require "src/modelo/Contador.php";
        require "src/repositorio/ContadorRepositorio.php";
        require "src/conexao-db.php";
try{
    if (isset($_POST['cadastro'])){
        $contador = new contador(null,
            $_POST['data_fundacao_empresa'],
            $_POST['nome_empresa'],
            $_POST['nome_contador'],
            $_POST['data_aniversario_contador'],
            $_POST['telefone_empresa'],
            $_POST['telefone_contador'],
            $_POST['crc'],
            $_POST['email'],
            $_POST['senha'],
            $_POST['data_cadastro']
           
        );

        if (($_FILES['logotipo']['error'] == UPLOAD_ERR_OK)){

            
            $contador->setLogo(uniqid() . $_FILES['logotipo']['name']);
            
            move_uploaded_file($_FILES['logotipo']['tmp_name'], $contador->getLogoDiretorio());
           
         }else{
            var_dump("Logo.png");
         }

        $contadorRepositorio = new ContadorRepositorio($pdo);
        $contadorRepositorio->salvar($contador);

        header("Location: Login.php");

    }

}catch(Throwable $error){
    echo $error->getMessage();
    
    header("Location: RedirecionaLogin.php");
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
        <form class="formulario__secao" method="post" enctype="multipart/form-data">
            <p class="p__secao">Cadastre-se</p>

            <label for="data_fundacao_empresa" class="label__form">Data da Fundação da Empresa:</label>
            <input type="text" id="data_fundacao_empresa" name="data_fundacao_empresa" class="input__label" placeholder="XX/XX/XXXX" required />

            <label for="nome_empresa"  class="label__form">Nome da Empresa:</label>
            <input type="text" id="nome_empresa" name="nome_empresa" class="input__label" placeholder="Digite o nome da empresa" required />

            <label for="nome_contador"  class="label__form">Nome:</label>
            <input type="text" id="nome_contador" name="nome_contador" class="input__label" placeholder="Digite seu nome" required />

            <label for="data_aniversario_contador"  class="label__form">Aniversário do contador:</label>
            <input type="text" id="data_aniversario_contador"  name="data_aniversario_contador" class="input__label" placeholder="XX/XX/XXXX" required />

            <label for="telefone_empresa"  class="label__form">Telefone da Empresa:</label>
            <input type="tel" id="telefone_empresa" name="telefone_empresa" class="input__label" placeholder="(XX) XXXX-XXXX" required />

            <label for="telefone_contador"  class="label__form">Telefone:</label>
            <input type="tel" id="telefone_contador" name="telefone_contador" class="input__label" placeholder="(XX) XXXX-XXXX" required />

            <label for="crc"  class="label__form">CRC:</label>
            <input type="text" id="crc" name="crc" class="input__label" placeholder="Digite o CRC" required />

            <label for="email"  class="label__form">Email:</label>
            <input type="email" id="email" name="email" class="input__label" placeholder="Digite seu Email" required />

            <label for="senha"  class="label__form">Senha:</label>
            <input type="password" id="senha" name="senha" class="input__label" placeholder="Digite sua Senha" required />

            <label for="data_cadastro"  class="label__form">Data do Cadastro:</label>
            <input type="text" id="data_cadastro"  name="data_cadastro" class="input__label" placeholder="XX/XX/XXXX" required />

            <label for="logotipo"  class="label__form">Logotipo:</label>
            <input type="file" id="logotipo"  name="logotipo" class="input__label" >

            <div class="div__inputs">
                <input type="submit" name="cadastro" class="botao__input" value="Cadastrar">
                <button type="button" onclick="" class="botao__input" value="Cancelar"><a href="Login.php" class="link">Cancelar</a></button>
            </div>
        </form>
    </section>

    

    <root class="rodape">
        <img src="assets/img//logo.png" alt="Logo" class="imagem__logo">
    </root>

</body>
</html>