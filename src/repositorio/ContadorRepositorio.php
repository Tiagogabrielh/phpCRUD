<?php

class ContadorRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {
        return new Contador($dados['ID'],
            $dados['DATA_FUNDACAO_EMPRESA'],
            $dados['NOME_EMPRESA'],
            $dados['NOME_CONTADOR'],
            $dados['DATA_ANIVERSARIO_CONTADOR'],
            $dados['TELEFONE_EMPRESA'],
            $dados['TELEFONE_CONTADOR'],
            $dados['CRC'],
            $dados['EMAIL'],
            $dados['SENHA'],
            $dados['DATA_CADASTRO'],
            $dados['LOGO']
            
        );
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM contador";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        
        $todosOsDados = array_map(function ($contador){
            return $this->formarObjeto($contador);
        },$dados);

        return $todosOsDados;
    }

    public function deletar(string $id)
    {
        $sql = "DELETE FROM contador WHERE ID = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();

    }

    public function salvar(contador $contador)
    {
        $sql = "INSERT INTO contador (data_fundacao_empresa, nome_empresa, nome_contador, data_aniversario_contador, telefone_empresa,
         telefone_contador, crc, email, senha, data_cadastro, logo) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $contador->pegaData_fundacao_empresa_formatada());
        $statement->bindValue(2, $contador->getNome_empresa());
        $statement->bindValue(3, $contador->getNome_contador());
        $statement->bindValue(4, $contador->pegaData_aniversario_contador_formatada());
        $statement->bindValue(5, $contador->getTelefone_empresa());
        $statement->bindValue(6, $contador->getTelefone_contador());
        $statement->bindValue(7, $contador->getCrc());
        $statement->bindValue(8, $contador->getEmail());
        $statement->bindValue(9, $contador->getSenha());
        $statement->bindValue(10, $contador->pegaData_cadastro_formatada());
        $statement->bindValue(11, $contador->getLogo());
        $statement->execute();
    }

    public function buscar(string $id)
    {
        $sql = "SELECT * FROM contador WHERE ID = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        var_dump($dados);
        return $this->formarObjeto($dados);
    }

    public function atualizar(Contador $contador)
    {
        $sql = "UPDATE contador SET data_fundacao_empresa = ?, nome_empresa = ?, nome_contador = ?, data_aniversario_contador = ?,
         telefone_empresa = ?, telefone_contador = ?, crc = ?, email = ?, senha = ?, data_cadastro = ?, logo = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $contador->getData_fundacao_empresa());
        $statement->bindValue(2, $contador->getNome_empresa());
        $statement->bindValue(3, $contador->getNome_contador());
        $statement->bindValue(4,$contador->getData_aniversario_contador());
        $statement->bindValue(5, $contador->getTelefone_empresa());
        $statement->bindValue(6, $contador->getTelefone_contador());
        $statement->bindValue(7, $contador->getCrc());
        $statement->bindValue(8, $contador->getEmail());
        $statement->bindValue(9, $contador->getSenha());
        $statement->bindValue(10, $contador->getData_cadastro());
        $statement->bindValue(11, $contador->getLogo());
        $statement->bindValue(12, $contador->getId());
        $statement->execute();
    }

    public function verCadastro(String $email, String $senha){

        $sql = "SELECT ID, COUNT(EMAIL), COUNT(SENHA) FROM contador WHERE (EMAIL = ? AND SENHA = ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->bindValue(2, $senha);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
              
        
        
        
       
        
       
        if($dados["COUNT(SENHA)"] == 1){
            
            $sql = "DELETE FROM contador WHERE (NOME_EMPRESA = 'padrao' AND EMAIL = ? AND SENHA = ?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $email);
            $statement->bindValue(2, $senha);
            $statement->execute();

            return false;
            
        } else{
            session_start();
            $id_cont = $dados["ID"];
            $_SESSION['id_contr'] =  $id_cont;
            $sql = "DELETE FROM contador WHERE (NOME_EMPRESA = 'padrao' AND EMAIL = ? AND SENHA = ?)";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $email);
            $statement->bindValue(2, $senha);
            $statement->execute();
            
            return true;
        }
        
       // $this->formarObjeto($dados)
        
        
    }
   
}