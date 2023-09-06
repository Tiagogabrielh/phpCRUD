<?php

class Contador {

    private ?string $id;
    private string $data_fundacao_empresa;
    private string $nome_empresa;
    private string $nome_contador;
    private string $data_aniversario_contador;
    private string $telefone_empresa;
    private string $telefone_contador;
    private string $crc;
    private string $email;
    private string $senha;
    private string $data_cadastro;

    private string $logo;
    

    public function __construct(?string $id, string $data_fundacao_empresa, string $nome_empresa, string $nome_contador,  string $data_aniversario_contador, string $telefone_empresa,
    string $telefone_contador, string $crc, string $email, string $senha, string $data_cadastro  , string $logo = "logo.png")
    {
        $this->id = $id;
        $this->data_fundacao_empresa = $data_fundacao_empresa;
        $this->nome_empresa = $nome_empresa;
        $this->nome_contador = $nome_contador;
        $this->data_aniversario_contador = $data_aniversario_contador;
        $this->telefone_empresa = $telefone_empresa;
        $this->telefone_contador = $telefone_contador;
        $this->crc = $crc;
        $this->email = $email;
        $this->senha = $senha;
        $this->data_cadastro = $data_cadastro;
        $this->logo = $logo;
        
       
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getNome_contador(): string
    {
        return $this->nome_contador;
    }

    public function getData_aniversario_contador(): string
    {
        return $this->data_aniversario_contador;
    }

    public function pegaData_aniversario_contador_formatada(): string
    {
        $date = $this->data_aniversario_contador;
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

    public function getCrc(): string
    {
        return $this->crc;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }   

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
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

    public function getLogoDiretorio(): string
    {
        return "assets/img/".$this->logo;
    }

   



}

?>