<?php

class Cadencia extends model {

    public function __construct() {
        parent::__construct(); //executa o construtor da classe ancestral
    }

    public function listCadencias() {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM cadencia ORDER BY CAD_DESC");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getCadencia($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM cadencia WHERE ID_CADENCIA=:id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $array = $sql->fetch();
        return $array;
    }

    public function addCadencia($desc, $ativo) {
        $array = array();
        $sql = $this->dbdados->prepare("INSERT INTO cadencia (CAD_DESC,ATIVO) VALUES (:descr,:ativo)");
        $sql->bindValue(':descr', $desc);
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
    }

    public function editCadencia($id, $desc, $ativo) {
        $array = array();
        $sql = $this->dbdados->prepare("UPDATE cadencia SET CAD_DESC=:descr,ATIVO=:ativo WHERE ID_CADENCIA=:id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':descr', $desc);
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
    }

}
