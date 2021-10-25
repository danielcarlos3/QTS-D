<?php
include_once 'Conexao.class.php';
include_once 'Crud.class.php';

class Pessoa extends Crud
{
    private string $nome_fansia;
    private string $sobrenome_razao;
    private string $cpf_cnpj;
    private string $rg_ie;
    private string $nascimento_fundacao;
    protected $tabela = 'pessoa';
    /**
     *SAVAREMOS TODOS OS VALORES DOS ATRIBUTOS NO BANCO DE DADOS 
     *
     * @return void
     */
    public function insert()
    {
        $sql = "INSERT INTO $this->tabela (nome_fatasia, sobrenome_razao, cpf_cnpj, rg_ie, nascimento_fundacao) VALUES (:nome_fatasia, :sobrenome_razao, :cpf_cnpj, :rg_ie, :nascimento_fundacao);";
        $stmt = Conexao::prepare($sql);
        $stmt->bindValue(':nome_fatasia', $this->nome_fansia, PDO::PARAM_STR);
        $stmt->bindValue(':sobrenome_razao', $this->sobrenome_razao, PDO::PARAM_STR);
        $stmt->bindValue(':cpf_cnpj', $this->cpf_cnpj, PDO::PARAM_STR);
        $stmt->bindValue(':rg_ie', $this->rg_ie, PDO::PARAM_STR);
        $stmt->bindValue(':nascimento_fundacao', $this->nascimento_fundacao, PDO::PARAM_STR);
        if ($stmt->execute()) :
            return true;
        else :
            return false;
        endif;
    }
    public function deleta($id)
    {
    }
    public function update($campo, $id)
    {
    }
    /**
     * Selecionamos o valor que esta armazenado no atributo nome.
     */
    public function getNome_fansia()
    {
        return $this->nome_fansia;
    }
    /**
     * Inserimos um valor no atributo nome.
     *
     * @return  self
     */
    public function setNome_fansia($nome_fansia)
    {
        $this->nome_fansia = $nome_fansia;

        return $this;
    }

    /**
     * Get the value of sobrenome_razao
     */
    public function getSobrenome_razao()
    {
        return $this->sobrenome_razao;
    }

    /**
     * Set the value of sobrenome_razao
     *
     * @return  self
     */
    public function setSobrenome_razao($sobrenome_razao)
    {
        $this->sobrenome_razao = $sobrenome_razao;

        return $this;
    }

    /**
     * Get the value of cpf_cnpj
     */
    public function getCpf_cnpj()
    {
        return $this->cpf_cnpj;
    }

    /**
     * Set the value of cpf_cnpj
     *
     * @return  self
     */
    public function setCpf_cnpj($cpf_cnpj)
    {
        $this->cpf_cnpj = $cpf_cnpj;

        return $this;
    }

    /**
     * Get the value of rg_ie
     */
    public function getRg_ie()
    {
        return $this->rg_ie;
    }

    /**
     * Set the value of rg_ie
     *
     * @return  self
     */
    public function setRg_ie($rg_ie)
    {
        $this->rg_ie = $rg_ie;

        return $this;
    }

    /**
     * Get the value of nascimento_fundacao
     */
    public function getNascimento_fundacao()
    {
        return $this->nascimento_fundacao;
    }

    /**
     * Set the value of nascimento_fundacao
     *
     * @return  self
     */
    public function setNascimento_fundacao($nascimento_fundacao)
    {
        $this->nascimento_fundacao = $nascimento_fundacao;

        return $this;
    }

}
