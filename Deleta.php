<?php

    require "src/modelo/Cliente.php";
    require "src/repositorio/ClienteRepositorio.php";
    require "src/conexao-db.php";
    session_start();
        if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))   {
                 
                 header('location:Login.php');
           } 
    
    

    
    $clienteRepositorio = new ClienteRepositorio($pdo);
    $clienteRepositorio->deletar($_POST['id']);
    header("Location: index.php");
    
?>
