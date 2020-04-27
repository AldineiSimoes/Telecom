<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Discadores extends model {

    private $discadoresInfo;

    function __construct() {
        parent::__construct();
    }

    public function getList($ativo = 1) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT a.*,b.CAMP_DESC as CAMPANHA,"
                . "c.descricao as GRUPO "
                . "FROM discador a join campanha b on "
                . "a.ID_CAMPANHA = b.ID_CAMPANHA"
                . " join grupo c on"
                . " a.ID_GRUPO=c.id_grupo"
                . " where a.ATIVO = :ativo ");
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getDiscador($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT a.*,b.CAMP_DESC as CAMPANHA,
                c.descricao as GRUPO 
                FROM discador a join campanha b on 
                a.ID_CAMPANHA = b.ID_CAMPANHA
                 join grupo c on
                 a.ID_GRUPO=c.id_grupo
                 where a.ID_DISCADOR = :id ");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $array = $sql->fetch();
        return $array;
    }

    public function edit($id, $nome, $camp, $grupo, $tpDisc, $servidor) {
        $sql = $this->dbdados->prepare("UPDATE discador set 
                CONF_DESC=:nome,ATIVO=:ativo,ID_GRUPO=:grupo, 
                ID_CAMPANHA=:camp,ID_SERVIDOR=:servidor, 
                ID_TIPODISCADOR=:tpDisc 
                where a.ID_DISCADOR = :id ");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':ativo', '1');
        $sql->bindValue(':grupo', $grupo);
        $sql->bindValue(':camp', $camp);
        $sql->bindValue(':tpDisc', $tpDisc);
        $sql->bindValue(':servidor', $servidor);
        $sql->execute();
    }

    public function add($nome, $camp, $grupo, $tpDisc, $servidor) {
        $array = array();
        $sql = $this->dbdados->prepare("INSERT INTO discador 
                (CONF_DESC,ATIVO,ID_GRUPO,ID_CAMPANHA,ID_SERVIDOR,ID_TIPODISCADOR) 
                VALUES 
                (:nome,:ativo,:grupo,:camp,:servidor,:tpDisc)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':ativo', '1');
        $sql->bindValue(':grupo', $grupo);
        $sql->bindValue(':camp', $camp);
        $sql->bindValue(':tpDisc', $tpDisc);
        $sql->bindValue(':servidor', $servidor);
        $sql->execute();
        $sql = $this->dbdados->prepare("SELECT MAX(ID_DISCADOR) as ID FROM discador ");
        $sql->execute();
        $array = $sql->fetch();
        $id = $array['ID'];
        $sql = $this->dbdados->prepare("SELECT * FROM parametro");
        $sql->execute();
        $array = $sql->fetchAll();
        foreach ($array as $f) {
            $sql = $this->dbdados->prepare("INSERT INTO config_parametro
            (ID_PARAMETRO,VALOR,ATIVO,ID_DISCADOR) 
            VALUES 
            (:idparam,:valor,:ativo,:iddisc)");
            $sql->bindValue(':idparam', $f['ID_PARAMETRO']);
            $sql->bindValue(':ativo', '1');
            $sql->bindValue(':valor', $f['PAR_VALOR_PADRAO']);
            $sql->bindValue(':iddisc', $id);
            $sql->execute();
        }
    }

    public function del($id) {
        $sql = $this->dbdados->prepare("DELETE FROM discador WHERE ID_DISCADOR = :id ");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function getParametros($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT a.PAR_DESC as PARAMETROS,b.* "
                . "FROM parametro a join config_parametro b on "
                . "a.ID_PARAMETRO = b.ID_PARAMETRO"
                . " where b.ID_DISCADOR = :id ");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function saveParametros($id, $valor,$usuario) {
        $array = array();
        $l = new Logs();
        $i = 0;
        foreach ($id as $idp) {
            $sql = $this->dbdados->prepare("SELECT a.*,b.ID_GRUPO FROM config_parametro a join discador b on
                                           a.ID_DISCADOR=b.ID_DISCADOR
                                            WHERE ID_CONFIGPARAMETRO=:id");
            $sql->bindValue(':id', $idp);
            $sql->execute();
            $array = $sql->fetch();
            if ($array['VALOR']<>$valor[$i]) {
                $l->setParametrosDisc($array['ID_GRUPO'],$array['ID_DISCADOR'],$array['ID_PARAMETRO'],
                                            $valor[$i],$array['VALOR'],$usuario);
            }
            $sql = $this->dbdados->prepare("UPDATE config_parametro SET VALOR=:valor
                     WHERE ID_CONFIGPARAMETRO=:id");
            $sql->bindValue(':id', $idp);
            $sql->bindValue(':valor', $valor[$i]);
            $sql->execute();
            $i++;
        }
    }

    public function getPeriodo($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT a.id_configperiododiscador,b.dia,c.per_desc,d.descricao as grupo,e.camp_desc,a.ativo
                                      FROM config_periododiscador a
                                      inner join diasemana b on a.id_diasemana = b.id_diasemana
                                      inner join periododiscador c on a.id_periodo = c.id_periodo
                                      inner join grupo d on a.id_grupo = d.id_grupo
                                      inner join campanha e on a.id_campanha = e.id_campanha"
                . " where a.ID_DISCADOR = :id ");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getMailing($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT a.* FROM controle_mailings a join discador b on
                                        a.grupo=b.ID_GRUPO
                                        where b.ID_DISCADOR = :id ");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public Function setMailing($id, $sit) {
        $sql = $this->dbdados->prepare("UPDATE controle_mailings set estado=:ativo
                                        where id = :id ");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':ativo', $sit);
        $sql->execute();
    }

    public Function delMailing($id) {
        $sql = $this->dbdados->prepare("DELETE FROM controle_mailings 
                                        where id = :id ");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function regMailing($id, $arq) {
        $array = array();
        $sql = $this->dbdados->prepare("INSERT INTO controle_mailings (nome_arquivo,instanteimport,estado,grupo)
                                        VALUES (:arq,NOW(),0,:id) ");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':arq', $arq);
        $sql->execute();
        $sql = $this->dbdados->prepare("SELECT max(id) as ID FROM controle_mailings ");
        $sql->execute();
        $array = $sql->fetch();
        return $array['ID'];
    }

    public function getMailingStatus($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT livres,finalizado,emuso,agendado "
                . "FROM res_mailing where id_discador =:id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

  public function getMailingTotalDisc($id) {
        $array = array();
        $sql = $this->dbdados->prepare("select numeroramal grupo,a.codfinalizacao, s.stf_desc finalizacao, 
                                        count(id) registros
                                            from tabeladiscagem a
                                            inner join st_fim s on 
                                            s.codigo_gennex=a.codfinalizacao
                                            where a.numeroramal= :id 
                                            group by numeroramal,a.codfinalizacao 
                                            order by s.stf_desc");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getMailingTotal($id) {
        $array = array();
        $sql = $this->dbdados->prepare("select id_arquivo grupo,a.codfinalizacao, s.stf_desc finalizacao, 
                                        count(id) registros
                                            from tabeladiscagem a
                                            inner join st_fim s on 
                                            s.codigo_gennex=a.codfinalizacao
                                            where a.id_arquivo= :id 
                                            and a.estado > 0
                                            group by id_arquivo,a.codfinalizacao 
                                            order by s.stf_desc");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function voltaDiscarStfim($codfim, $id_arquivo){
        $sql = $this->dbdados->prepare("update tabeladiscagem a set estado = 0 
                                        where a.codfinalizacao = :codfim
                                        and a.id_arquivo =  :id_arquivo");
        $sql->bindValue(':codfim', $codfim);
        $sql->bindValue(':id_arquivo', $id_arquivo);
        $sql->execute();
    }
    

    public function inserirMailing(MailingVo $dados, $tabela) {
        $array = array();
        try {
            $pstm = $this->dbdados->prepare("INSERT INTO " . $tabela . " (documento,nome,contrato,numeroramal,
                datahoraagendamento,instanteinsercao,carteira,dddres1,foneres1,dddres2,foneres2,dddres3,foneres3,
                dddres4,foneres4,dddres5,foneres5,dddcom1,fonecom1,dddcom2,fonecom2,dddcom3,fonecom3,dddcom4,fonecom4,
                dddcom5,fonecom5,dddcel1,fonecel1,dddcel2,fonecel2,dddcel3,fonecel3,dddcel4,fonecel4,dddcel5,fonecel5,
                dddout1,foneout1,dddout2,foneout2,dddout3,foneout3,dddout4,foneout4,dddout5,foneout5,agenteagenda,
                tentativas,tipoagenda,id_arquivo,estado)
	            values 
                (:documento,:nome,:contrato,:numeroramal,:datahoraagendamento,now(),:carteira,:dddres1,:foneres1,
                :dddres2,:foneres2,:dddres3,:foneres3,:dddres4,:foneres4,:dddres5,:foneres5,:dddcom1,:fonecom1,
                :dddcom2,:fonecom2,:dddcom3,:fonecom3,:dddcom4,:fonecom4,:dddcom5,:fonecom5,:dddcel1,:fonecel1,
                :dddcel2,:fonecel2,:dddcel3,:fonecel3,:dddcel4,:fonecel4,:dddcel5,:fonecel5,:dddout1,:foneout1,
                :dddout2,:foneout2,:dddout3,:foneout3,:dddout4,:foneout4,:dddout5,:foneout5,:agenteagenda,
                :tentativas,:tipoagenda,:id_arquivo,:estado)");
            $pstm->bindParam(':documento', $dados->getDocumento(), PDO::PARAM_STR);
            $pstm->bindParam(':nome', $dados->getNome(), PDO::PARAM_STR);
            $pstm->bindParam(':contrato', $dados->getContrato(), PDO::PARAM_STR);
            $pstm->bindParam(':numeroramal', $dados->getNumeroramal(), PDO::PARAM_STR);
            $pstm->bindParam(':datahoraagendamento', $dados->getDatahoraagendamento(), PDO::PARAM_STR);
            $pstm->bindParam(':tipoagenda', $dados->getTipoagenda(), PDO::PARAM_INT);
            $pstm->bindParam(':carteira', $dados->getCarteira(), PDO::PARAM_STR);

            $pstm->bindParam(':dddres1', $dados->getDddres1(), PDO::PARAM_STR);
            $pstm->bindParam(':foneres1', $dados->getFoneres1(), PDO::PARAM_STR);
            $pstm->bindParam(':dddres2', $dados->getDddres2(), PDO::PARAM_STR);
            $pstm->bindParam(':foneres2', $dados->getFoneres2(), PDO::PARAM_STR);
            $pstm->bindParam(':dddres3', $dados->getDddres3(), PDO::PARAM_STR);
            $pstm->bindParam(':foneres3', $dados->getFoneres3(), PDO::PARAM_STR);
            $pstm->bindParam(':dddres4', $dados->getDddres4(), PDO::PARAM_STR);
            $pstm->bindParam(':foneres4', $dados->getFoneres4(), PDO::PARAM_STR);
            $pstm->bindParam(':dddres5', $dados->getDddres5(), PDO::PARAM_STR);
            $pstm->bindParam(':foneres5', $dados->getFoneres5(), PDO::PARAM_STR);

            $pstm->bindParam(':dddcom1', $dados->getDddcom1(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecom1', $dados->getFonecom1(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcom2', $dados->getDddcom2(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecom2', $dados->getFonecom2(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcom3', $dados->getDddcom3(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecom3', $dados->getFonecom3(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcom4', $dados->getDddcom4(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecom4', $dados->getFonecom4(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcom5', $dados->getDddcom5(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecom5', $dados->getFonecom5(), PDO::PARAM_STR);

            $pstm->bindParam(':dddcel1', $dados->getDddcel1(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecel1', $dados->getFonecel1(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcel2', $dados->getDddcel2(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecel2', $dados->getFonecel2(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcel3', $dados->getDddcel3(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecel3', $dados->getFonecel3(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcel4', $dados->getDddcel4(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecel4', $dados->getFonecel4(), PDO::PARAM_STR);
            $pstm->bindParam(':dddcel5', $dados->getDddcel5(), PDO::PARAM_STR);
            $pstm->bindParam(':fonecel5', $dados->getFonecel5(), PDO::PARAM_STR);

            $pstm->bindParam(':dddout1', $dados->getDddout1(), PDO::PARAM_STR);
            $pstm->bindParam(':foneout1', $dados->getFoneout1(), PDO::PARAM_STR);
            $pstm->bindParam(':dddout2', $dados->getDddout2(), PDO::PARAM_STR);
            $pstm->bindParam(':foneout2', $dados->getFoneout2(), PDO::PARAM_STR);
            $pstm->bindParam(':dddout3', $dados->getDddout3(), PDO::PARAM_STR);
            $pstm->bindParam(':foneout3', $dados->getFoneout3(), PDO::PARAM_STR);
            $pstm->bindParam(':dddout4', $dados->getDddout4(), PDO::PARAM_STR);
            $pstm->bindParam(':foneout4', $dados->getFoneout4(), PDO::PARAM_STR);
            $pstm->bindParam(':dddout5', $dados->getDddout5(), PDO::PARAM_STR);
            $pstm->bindParam(':foneout5', $dados->getFoneout5(), PDO::PARAM_STR);

            $pstm->bindParam(':agenteagenda', $dados->getAgenteagenda(), PDO::PARAM_STR);
            $pstm->bindParam(':tentativas', $dados->getTentativas(), PDO::PARAM_INT);
            $pstm->bindParam(':id_arquivo', $dados->getId_arquivo(), PDO::PARAM_INT);
            $pstm->bindValue(':estado', 1);

            $rs = $pstm->execute();
        } catch (PDOException $e) {
            $rs = 0;
            throw new Exception('errors+' . $e->getMessage());
        }
        return $rs;
    }

}
