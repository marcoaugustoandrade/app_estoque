<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 26/02/2018
 * Time: 13:43
 */

namespace App\DAO;


class ProdutoDAO extends Conexao
{
    public function inserir($produto)
    {
        $sql = "insert into produtos (descricao, quantidade, valor, validade) values (:descricao, :quantidade, :valor, :validade)";
        try{
            $i = $this->conexao->prepare($sql);
            $i->bindValue(":descricao", $produto->getDescricao());
            $i->bindValue(":quantidade", $produto->getQuantidade());
            $i->bindValue(":valor", $produto->getValor());
            $i->bindValue(":validade", $produto->getValidade());
            $i->execute();
            return true;
        } catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
        }
    }

    public function pesquisar($produto = null)
    {
        $sql = "select * from produtos where descricao like :descricao";
        try{
            $p = $this->conexao->prepare($sql);
            $p->bindValue(":descricao", "%".$produto->getDescricao()."%");
            $p->execute();
            return $p->fetchAll(\PDO::FETCH_CLASS, "\App\Model\Produto");
        } catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
        }
    }


    public function excluir($produto)
    {
        $sql = "delete from produtos where id = :id";
        try{
            $i = $this->conexao->prepare($sql);
            $i->bindValue(":id", $produto->getId());
            $i->execute();
            return true;
        } catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
        }
    }


    public function pesquisarUm($produto){
        $sql = "select * from produtos where id = :id";
        try{
            $p = $this->conexao->prepare($sql);
            $p->bindValue(":id", $produto->getId());
            $p->execute();
            return $p->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
        }
    }

    public function alterar($produto){
        $sql = "update produtos set descricao = :descricao, quantidade = :quantidade, valor = :valor, validade = :validade where id = :id";
        try{
            $p = $this->conexao->prepare($sql);
            $p->bindValue(":descricao", $produto->getDescricao());
            $p->bindValue(":quantidade", $produto->getQuantidade());
            $p->bindValue(":valor", $produto->getValor());
            $p->bindValue(":validade", $produto->getValidade());
            $p->bindValue(":id", $produto->getId());
            $p->execute();
            return true;
        } catch (\PDOException $e){
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
        }
    }





}