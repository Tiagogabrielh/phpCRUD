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
    <link rel="stylesheet" href="assets/styles/tabela.css">
    <title>Tabela</title>
</head>
<body class="corpo__texto">
    <header class="cabecalho">
    <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </header>
    <p class="texto__bem-vindo">Bem vindo Contador</p>

    <div class="div__tabela">
    <table class="tabela__secao">
      <thead>
        <tr>
          <th>Fundação da Empresa</th>
          <th>Empresa</th>
          <th>Nome do Contato</th>
          <th>Aniversário</th>
          <th>Telefone</th>
          <th>Telefone do Contador</th>
          <th>Email</th>
          <th>Senha</th>
          <th>Data do Cadastro</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($dadosCliente as $dados): ?>
          <tr>
            <td><?= $dados->getData_fundacao_empresa() ?></td>
            <td><?= $dados->getNome_empresa() ?></td>
            <td><?= $dados->getNome_contato() ?></td>
            <td><?= $dados->getData_aniversario_contato() ?></td>
            <td><?= $dados->getTelefone_empresa() ?></td>
            <td><?= $dados->getTelefone_contador() ?></td>
            <td><?= $dados->getEmail() ?></td>
            <td><?= $dados->getSenha() ?></td>
            <td><?= $dados->getData_cadastro() ?></td>
            <td><button class="botao__tabela"><a  href="Edita.php?id=<?= $dados->getId() ?>" class="link">Editar</a></button></td>
            <td>
              <form action="Deleta.php" method="post">
                <input type="hidden" class="botao__tabela"  name="id" value="<?= $dados->getId() ?>">
                <input type="submit" class="botao__tabela" value="Excluir">
              </form>
            </td>
          </tr>
      <?php endforeach; ?>


      </tbody>
    </table>
    </div>


    <form method="POST"  enctype="multipart/form-data" class="formulario" >
    <input type="submit" name="Cadastrar" value="Cadastrar Cliente" class="botao">
    <button class="botao"><a href="index.php" class="link">Lista Abrangente</a></button>
    <button class="botao"><a href="Sair.php" class="link">Sair</a></button>
    </form>
    
    <root class="rodape">
        <img src="assets/img/logo.png" alt="Logo" class="imagem__logo">
    </root>

</body>
</html>