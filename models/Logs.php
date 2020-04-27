<?php

/**
* 
*/
class Logs extends model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getConfigDiscador($dti,$dtf) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT b.descricao as grupo,Horario as data,
                                        Usuario as usuario,
                                        c.PAR_DESC as descricao,
                                        valor_parametroantes as anterior,
                                        valor_parametro as atual 
                                        FROM log_cfgdiscador a 
                                        join grupo b on
                                            a.grupo=b.id_grupo
                                        join parametro c on
                                            a.idparametro=c.ID_PARAMETRO
                                        WHERE Horario>=:dti AND Horario<=:dtf');
        $sql->bindValue(':dti',$dti);
        $sql->bindValue(':dtf',$dtf);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;

	}
	public function getParametros($dti,$dtf) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT c.CONF_DESC as grupo,HORARIO as data,
                                        USUARIO as usuario,
                                        b.PAR_DESC as descricao,
                                        0 as anterior,
                                        VALOR as atual 
                                        FROM log_parametro a join parametro b on
                                            a.ID_PARAMETRO=b.ID_PARAMETRO
                                        join discador c on
                                            a.ID_DISCADOR=c.ID_DISCADOR
                                        WHERE HORARIO>=:dti AND HORARIO<=:dtf');
        $sql->bindValue(':dti',$dti);
        $sql->bindValue(':dtf',$dtf);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
	}
	public function getRotas($dti,$dtf) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT b.descricao as grupo,Horario as data,
                                        Usuario as usuario,
                                        c.MOD_DESC as descricao,
                                        "" as anterior,
                                        OPE_DESC as atual 
                                        FROM log_rotas a
                                        join grupo b on
                                            a.Grupo=b.id_grupo
                                        join modalidade c on
                                            a.ID_Modalidade=c.ID_MODALIDADE
                                        join operadora d on
                                            a.ID_Operadora=d.ID_OPERADORA
                                        WHERE Horario>=:dti AND Horario<=:dtf');
        $sql->bindValue(':dti',$dti);
        $sql->bindValue(':dtf',$dtf);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function setRota($grupo,$modalidade,$oper,$usuario){
        $j = 0;
        foreach ($modalidade as $mod){
            $sql = "INSERT INTO log_rotas (Cliente,Grupo,ID_Modalidade,ID_Operadora, Rota_peso, "
                   . "ID_OPE_Transbordo_1, Rota_peso_1, ID_OPE_Transbordo_2,Rota_peso_2, "
                   . "ID_OPE_Transbordo_3, Rota_peso_3, ID_OPE_Transbordo_4,Rota_peso_4, "
                   . "Usuario,Horario)"            
                   . " VALUES (1,'".$grupo."',".$mod.","
                   . $oper[$j].",100,".$oper[$j+1].",100,".$oper[$j+2].",100,"
                   . $oper[$j+3].",100,".$oper[$j+4].",100,'".$usuario."',now())";
            $this->dbdados->query($sql);
            echo $sql;
            $j=$j+5;
        }
    }
    public function setParametrosDisc($grupo,$iddiscador,$idparametro,$valor_parametro,
                                  $valor_parametroantes,$Usuario) {
        $sql = $this->dbdados->prepare("INSERT INTO log_cfgdiscador (Grupo,iddiscador,idparametro,
                                        valor_parametro,valor_parametroantes,Usuario,Horario)
                                       VALUES
                                       (:grupo,:iddiscador,:idparametro,:valor_parametro,
                                        :valor_parametroantes,:Usuario,now())");
        $sql->bindValue(':grupo', $grupo);
        $sql->bindValue(':iddiscador', $iddiscador);
        $sql->bindValue(':idparametro', $idparametro);
        $sql->bindValue(':valor_parametro', $valor_parametro);
        $sql->bindValue(':valor_parametroantes', $valor_parametroantes);
        $sql->bindValue(':Usuario', $Usuario);
        $sql->execute();
    }
}
?>