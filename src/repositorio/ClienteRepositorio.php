<?php

class ClienteRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {   

        $createDate = DateTime::createFromFormat('Y-m-d', $dados['DATA_FUNDACAO_EMPRESA']);
        $newDate =  $createDate->format('d/m/Y');
        $createDate2 = DateTime::createFromFormat('Y-m-d', $dados['DATA_ANIVERSARIO_CONTATO']);
        $newDate2 =  $createDate2->format('d/m/Y');
        $createDate3 = DateTime::createFromFormat('Y-m-d', $dados['DATA_CADASTRO']);
        $newDate3 =  $createDate3->format('d/m/Y');
        return new Cliente($dados['ID'],
            $newDate,
            $dados['NOME_EMPRESA'],
            $dados['NOME_CONTATO'],
            $newDate2,
            $dados['TELEFONE_EMPRESA'],
            $dados['TELEFONE_CONTADOR'],
            $dados['EMAIL'],
            $dados['SENHA'],
            $newDate3,
            $dados['ID_CONTADOR'],
            $dados['LOGO'],
            
        );
    }

    public function buscarTodos(string $id_conta)
    {
        $sql = "SELECT * FROM clientes WHERE ID_CONTADOR = $id_conta";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        
        $todosOsDados = array_map(function ($cliente){
            return $this->formarObjeto($cliente);
        },$dados);

        return $todosOsDados;
    }

    public function deletar(string $id)
    {
        $sql = "DELETE FROM clientes WHERE ID = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();

    }

    public function salvar(Cliente $cliente)
    {
        $sql = "INSERT INTO clientes (data_fundacao_empresa, nome_empresa, nome_contato, data_aniversario_contato, telefone_empresa,
         telefone_contador, email, senha, data_cadastro, id_contador, logo) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $cliente->pegaData_fundacao_empresa_formatada());
        $statement->bindValue(2, $cliente->getNome_empresa());
        $statement->bindValue(3, $cliente->getNome_contato());
        $statement->bindValue(4,$cliente->pegaData_aniversario_contato_formatada());
        $statement->bindValue(5, $cliente->getTelefone_empresa());
        $statement->bindValue(6, $cliente->getTelefone_contador());
        $statement->bindValue(7, $cliente->getEmail());
        $statement->bindValue(8, $cliente->getSenha());
        $statement->bindValue(9, $cliente->pegaData_cadastro_formatada());
        $statement->bindValue(10, $cliente->getId_contador());
        $statement->bindValue(11, $cliente->getLogo());
        $statement->execute();
    }

    public function buscar(string $id)
    {
        $sql = "SELECT * FROM clientes WHERE ID = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $this->formarObjeto($dados);
    }

    public function atualizar(Cliente $cliente)
    {
        $sql = "UPDATE clientes SET data_fundacao_empresa = ?, nome_empresa = ?, nome_contato = ?, data_aniversario_contato = ?,
         telefone_empresa = ?, telefone_contador = ?, email = ?, senha = ?, data_cadastro = ?, id_contador = ?, logo = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $cliente->pegaData_fundacao_empresa_formatada());
        $statement->bindValue(2, $cliente->getNome_empresa());
        $statement->bindValue(3, $cliente->getNome_contato());
        $statement->bindValue(4,$cliente->pegaData_aniversario_contato_formatada());
        $statement->bindValue(5, $cliente->getTelefone_empresa());
        $statement->bindValue(6, $cliente->getTelefone_contador());
        $statement->bindValue(7, $cliente->getEmail());
        $statement->bindValue(8, $cliente->getSenha());
        $statement->bindValue(9, $cliente->pegaData_cadastro_formatada());
        $statement->bindValue(10, $cliente->getId_contador());
        $statement->bindValue(11, $cliente->getLogo());
        $statement->bindValue(12, $cliente->getId());
        $statement->execute();
    }


    
}