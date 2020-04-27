<?php
class Rotas extends model {

    private $idRota;

    public function __construct() {
        parent::__construct(); //executa o construtor da classe ancestral
    }

    public function listRotas($idgrupo=1){
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM rotacusto where ID_GRUPO=:idgrupo");
        $sql->bindValue(':idgrupo',$idgrupo);
        $sql->execute();
        if($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
        }
        return $array;
    }

    public function saveRotas($grupo,$modalidade,$oper) {
        $sql = $this->dbdados->prepare("DELETE FROM rotacusto where ID_GRUPO = :grupo");
        $sql->bindValue(':grupo',$grupo);
        $sql->execute();
        $j = 0;
        foreach ($modalidade as $mod){
            $sql = "INSERT INTO rotacusto (ID_CLIENTE,ID_GRUPO,ID_MODALIDADE,ID_OPERADORA, ROTA_PESO, "
                   . "ID_OPE_TRANSBORDO_1, ROTA_PESO_1, ID_OPE_TRANSBORDO_2,ROTA_PESO_2, "
                   . "ID_OPE_TRANSBORDO_3, ROTA_PESO_3, ID_OPE_TRANSBORDO_4,ROTA_PESO_4, "
                   . "CPUPDATE)"            
                   . " VALUES (1,'".$grupo."',".$mod.","
                   . $oper[$j].",100,".$oper[$j+1].",100,".$oper[$j+2].",100,"
                   . $oper[$j+3].",100,".$oper[$j+4].",100,now())";
            $this->dbdados->query($sql);
            $j=$j+5;
        }
    }
}