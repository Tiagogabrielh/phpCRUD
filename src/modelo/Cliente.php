<?php

class Cliente {

    private ?string $id;
    private string $data_fundacao_empresa;
    private string $nome_empresa;
    private string $nome_contato;
    private string $data_aniversario_contato;
    private string $telefone_empresa;
    private string $telefone_contador;
    private string $email;
    private string $senha;
    private string $data_cadastro;
    private string $id_contador;

    private string $logo;
    

    public function __construct(?string $id, string $data_fundacao_empresa, string $nome_empresa, string $nome_contato,  string $data_aniversario_contato, string $telefone_empresa,
    string $telefone_contador, string $email, string $senha, string $data_cadastro , string $id_contador , string $logo = "logo.png")
    {
        $this->id = $id;
        $this->data_fundacao_empresa = $data_fundacao_empresa; 
        $this->nome_empresa = $nome_empresa;
        $this->nome_contato = $nome_contato;
        $this->data_aniversario_contato = $data_aniversario_contato;
        $this->telefone_empresa = $telefone_empresa;
        $this->telefone_contador = $telefone_contador;
        $this->email = $email;
        $this->senha = $senha;
        $this->data_cadastro = $data_cadastro;
        $this->logo = $logo;
        $this->id_contador = $id_contador;
        
       
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getId_contador(): string
    {
        return $this->id_contador;
    }

    public function getData_fundacao_empresa(): string
    {
        return $this->data_fundacao_empresa;
    }

    public function pegaData_fundacao_empresa_formatada(): string
    {
        $date = $this->data_fundacao_empresa;
        $createDate = DateTime::createFromFormat('d/m/Y', $date);
        $newDate =  $createDate->format('Y-m-d');
        return $newDate;
    }

    public function getNome_empresa(): string
    {
        return $this->nome_empresa;
    }

    public function getNome_contato(): string
    {
        return $this->nome_contato;
    }

    public function getData_aniversario_contato(): string
    {
        return $this->data_aniversario_contato;
    }

    public function pegaData_aniversario_contato_formatada(): string
    {
        $date = $this->data_aniversario_contato;
        $createDate = DateTime::createFromFormat('d/m/Y', $date);
        $newDate =  $createDate->format('Y-m-d');
        return $newDate;
    }

    public function getTelefone_empresa(): string
    {
        return $this->telefone_empresa;
    }

    public function getTelefone_contador(): string
    {
        return $this->telefone_contador;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getData_cadastro(): string
    {
        return $this->data_cadastro;
    }

    public function pegaData_cadastro_formatada(): string
    {
        $date = $this->data_cadastro;
        $createDate = DateTime::createFromFormat('d/m/Y', $date);
        $newDate =  $createDate->format('Y-m-d');
        return $newDate;
    }


    public function getLogo(): string
    {
        return $this->logo;
    }
    

    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }   

    public function setId_contador(string $id_contador): void
    {
        $this->id_contador = $id_contador;
    } 

    public function getLogoDiretorio(): string
    {
        return "assets/img/".$this->logo;
    }


}

?>