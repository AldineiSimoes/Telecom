<?php

/*
 */

class Tabulacao extends model {

    public function getLista($id = 0) {
        $array = array();
//        $sql = $this->dbdados->prepare("SET NAMES 'utf8';
//                                            SET character_set_connection=utf8;
//                                            SET character_set_client=utf8;
//                                            SET character_set_results=utf8;");
//        $sql->execute();
        $sql = $this->dbdados->prepare('SELECT * from tabulacao where id_campanha=:id');
        $sql->bindValue(':id',$id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function campanhaList($ativo = 1) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM campanha ORDER BY CAMP_DESC");
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function tipoTab() {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM tipo_tabulacao");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function newTabulacao($cod, $descricao, $tipo,$idcampanha) {
        $sql = $this->dbdados->prepare("INSERT INTO tabulacao 
                                    (codtabulacao, descricao,  tipotabulacao,id_campanha,reativadiscagem,
                                    tempo_follow) 
                                    VALUES (:cod,:desc,:tipo, :idcamp, :reat,:tempo)");
        $sql->bindValue(':cod', $cod);
        $sql->bindValue(':desc', $descricao);
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':idcamp', $idcampanha);
        $sql->bindValue(':reat', 0);
        $sql->bindValue(':tempo', '00:00:00');
        $sql->execute();
        // print_r($sql);exit;
    }
    
    public function delTabulacao($id){
        $sql = $this->dbdados->prepare("DELETE FROM tabulacao where codtabulacao = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}
