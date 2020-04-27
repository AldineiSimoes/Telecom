<?php

class Tarifas extends model {

    public function __construct() {
        parent::__construct(); //executa o construtor da classe ancestral
    }

    public function listTarifas() {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM tarifas_operadoras a join operadora b on
                                        a.id_operadora=b.ID_OPERADORA
                                        where b.ATIVO=1
                                        ORDER BY Nome_operadora");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getTarifa($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM tarifas_operadoras "
                . " WHERE ID=:id");
        $sql->bindValue(':id',$id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function editar($id,$selcadLocal,$localVrTar,$selLde,$ldeVrTar,$selLdn,
                            $ldnVrTar,$selVc1,$vc1VrTar,$selVc2,$vc2VrTar,$selVc3,$vc3VrTar) {
        $array = array();
        // $sql = $this->dbdados->prepare("UPDATE tarifas_operadoras 
        //                 SET DataAlteracao=now()
        //                 ,kdvc1=:kdvc1
        //                 ,tarvc1=:tarvc1
        //                 ,tarvc2=:tarvc2
        //                 ,kdvc2=:kdvc2
        //                 ,tarvc3=:tarvc3
        //                 ,kdvc3=:kdvc3
        //                 ,tarloc=:tarloc
        //                 ,kdloc=:kdloc
        //                 ,tarldn=:tarldn
        //                 ,kdldn=:kdldn
        //                 ,tarlde=:tarlde
        //                 ,kdlde=:kdlde
        //         WHERE ID=:id");
        // $sql->bindValue(':id',$id);
        // $sql->bindValue(':kdloc',$selcadLocal);
        // $sql->bindValue(':tarloc',$localVrTar);
        // $sql->bindValue(':kdlde',$selLde);
        // $sql->bindValue(':tarlde',$ldeVrTar);
        // $sql->bindValue(':kdldn',$selLdn);
        // $sql->bindValue(':tarldn',$ldnVrTar);
        // $sql->bindValue(':kdvc1',$selVc1);
        // $sql->bindValue(':tarvc1',$vc1VrTar);
        // $sql->bindValue(':kdvc1',$selVc2);
        // $sql->bindValue(':tarvc3',$vc2VrTar);
        // $sql->bindValue(':kdvc3',$selVc3);
        // $sql->bindValue(':tarvc3',$vc3VrTar);
        // $sql->execute();
        $sql = 'UPDATE tarifas_operadoras 
                    SET DataAlteracao=now()
                    ,kdvc1="'.$selVc1.'"
                    ,tarvc1="'.$vc1VrTar.'"
                    ,tarvc2="'.$vc2VrTar.'"
                    ,kdvc2="'.$selVc2.'"
                    ,tarvc3="'.$vc3VrTar.'"
                    ,kdvc3="'.$selVc1.'"
                    ,tarloc="'.$localVrTar.'"
                    ,kdloc="'.$selcadLocal.'"
                    ,tarldn="'.$vc1VrTar.'"
                    ,kdldn="'.$selLdn.'"
                    ,tarlde="'.$ldeVrTar.'"
                    ,kdlde="'.$selLde.'" 
                    WHERE ID='.$id;
        // echo $sql;
        $sql = $this->dbdados->query($sql);
    }

}
