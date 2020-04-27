<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Discadores extends model {

    private $discadoresInfo;
    private $idDiscador;

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

    public function getParametrosEspecifico($discador, $id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT VALOR from  config_parametro  "
                . " where ID_DISCADOR = :discador and ID_PARAMETRO=:id ");
        $sql->bindValue(':discador', $discador);
        $sql->bindValue(':id', $id);
        $sql->execute();
        $array = $sql->fetch();
        return $array;
    }

    public function saveParametros($id, $valor, $usuario) {
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
            if ($array['VALOR'] <> $valor[$i]) {
                $l->setParametrosDisc($array['ID_GRUPO'], $array['ID_DISCADOR'], $array['ID_PARAMETRO'], $valor[$i], $array['VALOR'], $usuario);
            }
            $sql = $this->dbdados->prepare("UPDATE config_parametro SET VALOR=:valor
                     WHERE ID_CONFIGPARAMETRO=:id");
            $sql->bindValue(':id', $idp);
            $sql->bindValue(':valor', $valor[$i]);
            $sql->execute();
            $i++;
        }
    }

    public function getPeriodosCadastrados() {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM periododiscador WHERE VISIVEL = 1 AND ATIVO = 1");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function addPeriodoDisc($desc, $inicio, $fim){
        $sql = $this->dbdados->prepare("INSERT INTO periododiscador (PER_DESC, PER_HR_INICIO, PER_HR_FIM, VISIVEL, ATIVO)"
                . " VALUES (:descricao, :hr_inicio, :hr_fim, 1, 1)");
        $sql->bindValue(':descricao', $desc);
        $sql->bindValue(':hr_inicio', $inicio);
        $sql->bindValue(':hr_fim', $fim);
        $sql->execute();
    }
    
    public function delPeriodoDisc($id){
        $sql = $this->dbdados->prepare("DELETE FROM periododiscador WHERE ID_PERIODO = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
                        
    }
    
    public function asocPeriodoDisc($periodo, $dias, $discador, $grupo, $campanha){
        foreach ($dias as $dia) {
            $sql = $this->dbdados->prepare("INSERT INTO "
                ."config_periododiscador (ID_DIASEMANA,ID_PERIODO,ID_GRUPO, ID_CAMPANHA, ID_DISCADOR, ATIVO)"
                ." VALUES (:dias, :periodo, :grupo, :campanha, :discador, 1)");
            $sql->bindValue(':dias', $dia);
            $sql->bindValue(':periodo', $periodo);
            $sql->bindValue(':grupo', $grupo);
            $sql->bindValue(':campanha', $campanha);
            $sql->bindValue(':discador', $discador);
           
            $sql->execute();
        }        
    }
    

    public function getPeriodo($id) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT a.ID_DISCADOR, a.id_configperiododiscador,b.dia,c.per_desc,d.descricao as grupo,e.camp_desc,a.ativo
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
    
    public function delPeriodoDiscador($id){
        $sql = $this->dbdados->prepare('DELETE FROM config_periododiscador WHERE id_configperiododiscador = :id');
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function getMailing($id) {
        $array = array();
        if (MAILING == 'NOVO') {
            $sql = $this->dbdados->prepare("SELECT a.*, b.id_discador as grupo 
                                        FROM controle_mailings a join discador b on
                                        a.grupo=b.ID_GRUPO
                                        where b.ID_DISCADOR = :id and a.visivel = 1 ");
        } else {
            $sql = $this->dbdados->prepare("SELECT a.ID_ARQUIVOMAILING as id,a.ARC_DESC as nome_arquivo,a.QTD,
                                    DT_IMPORTADO as instanteimport,a.ATIVO as estado,b.ID_DISCADOR as grupo
                                        FROM arquivo_mailing a join discador b on
                                        a.ID_DISCADOR=b.ID_GRUPO
                                        where b.ID_DISCADOR = :id and a.visivel = 1 ");
        }
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public Function setMailing($id, $sit) {
        if (MAILING == 'NOVO') {
            $sql = $this->dbdados->prepare("UPDATE controle_mailings set estado=:ativo
                                        where id = :id ");
        } else {
            $sql = $this->dbdados->prepare("UPDATE arquivo_mailing set ATIVO=:ativo
                                        where ID_ARQUIVOMAILING = :id ");
        }
        $sql->bindValue(':id', $id);
        $sql->bindValue(':ativo', $sit);
        $sql->execute();
    }

    public Function delMailing($id,$discador) {
        $tb = $this->getParametrosEspecifico($discador, 19);
        if (MAILING == 'NOVO') {
            $sql = $this->dbdados->prepare("UPDATE controle_mailings SET visivel = 0 WHERE id = :id;
                                        DELETE FROM ". $tb['VALOR'] ." WHERE id_arquivo = :id;");
            
        } else {
            $sql = $this->dbdados->prepare("UPDATE arquivo_mailing SET visivel = 0  where ID_ARQUIVOMAILING = :id;
                                        DELETE FROM ". $tb['VALOR'] ." WHERE id_arquivo = :id;");
                                        
        }
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function regMailing($id, $arq) {
        $array = array();
        if (MAILING == 'NOVO') {
            $sql = $this->dbdados->prepare("INSERT INTO controle_mailings (nome_arquivo,instanteimport,estado,grupo)
                                        VALUES (:arq,NOW(),0,:id) ");
        } else {
            $sql = $this->dbdados->prepare("INSERT INTO arquivo_mailing (ARC_DESC,DT_IMPORTADO,ATIVO,ID_DISCADOR)
                                        VALUES (:arq,NOW(),1,:id) ");
        }
        $sql->bindValue(':id', $id);
        $sql->bindValue(':arq', $arq);
        $sql->execute();
        if (MAILING == 'NOVO') {
            $sql = $this->dbdados->prepare("SELECT max(id) as ID FROM controle_mailings ");
        } else {
            $sql = $this->dbdados->prepare("SELECT max(ID_ARQUIVOMAILING) as ID FROM arquivo_mailing ");
        }
        $sql->execute();
        $array = $sql->fetch();
        return $array['ID'];
    }

    public function getMailingStatus($discador, $id) {
        $array = array();
        //$tb = $this->getParametrosEspecifico($discador,20);
        $sql = $this->dbdados->prepare("SELECT livres,finalizado,emuso,agendado "
                . "FROM res_mailing where id_discador =:id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        //print_r($sql);exit;
        return $array;
    }

    public function getMailingTotalDisc($id) {
        $array = array();
        $tb = $this->getParametrosEspecifico($discador, 19);
        $sql = $this->dbdados->prepare("select numeroramal grupo,a.codfinalizacao, s.stf_desc finalizacao, 
                                        count(id) registros
                                            from " . $tb['VALOR'] . " a
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

    public function getMailingTotal($discador, $id) {
        $array = array();
        $where = ' and d.ID_DISCADOR = ' . $discador;
        if ($id > 0)
            (
                    $where = ' and a.id_arquivo = ' . $id
                    );
        $tb = array();
        $tb = $this->getParametrosEspecifico($discador, 19);
        $sql =  $this->dbdados->prepare("SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED");
        $sql->execute();
        $sql = $this->dbdados->prepare("select d.ID_discador, id_arquivo grupo,a.codfinalizacao, s.stf_desc finalizacao, 
                                        count(id) registros
                                            from " . $tb['VALOR'] . " a
                                            inner join st_fim s on 
                                            s.codigo_gennex=a.codfinalizacao
                                            inner join discador d on
                                            d.ID_grupo = a.numeroramal
                                            where a.estado > 0
                                            " . $where . "
                                            group by a.codfinalizacao 
                                            order by s.stf_desc");
        //$sql->bindValue(':tbdiscador', $tabela);
        //  $sql->bindValue(':id', $id);
        // print_r($sql);exit;
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        $sql =  $this->dbdados->prepare("SET SESSION TRANSACTION ISOLATION LEVEL REPEATABLE READ");
        $sql->execute();
        return $array;
    }

    public function voltaDiscarStfim($codfim, $id_arquivo, $discador) {
        $tb = $this->getParametrosEspecifico($discador, 19);
        if ($id_arquivo <> 0) {
            $sql = $this->dbdados->prepare("update " . $tb['VALOR'] . " a set 
                                            estado=null, codfinalizacao=null, tentativas=0,
                                            instanteupdate=now()
                                            where a.codfinalizacao = :codfim
                                            and a.id_arquivo = :id_arquivo
                                            and a.codfinalizacao<>203
                                            and a.codfinalizacao<>20
                                            and a.codfinalizacao<>60
                                            and a.codfinalizacao<>1034
                                            and a.codfinalizacao<>1033
                                            and a.codfinalizacao<>1001");
            $sql->bindValue(':codfim', $codfim);
            $sql->bindValue(':id_arquivo', $id_arquivo);
        } else {
            $ramal = $this->getParametrosEspecifico($discador, 17);
            $sql = $this->dbdados->prepare("update " . $tb['VALOR'] . " a set 
                                            estado=null, codfinalizacao=null, tentativas=0,
                                            instanteupdate=now()
                                            where a.codfinalizacao<>20
                                            and a.codfinalizacao<>203
                                            and a.codfinalizacao >= :Icodfim
                                            and a.codfinalizacao <= :Fcodfim
                                            and numeroramal=:ramal");
            $sql->bindValue(':ramal', $ramal['VALOR']);
            if ($codfim <> 0) {
                $sql->bindValue(':Icodfim', $codfim);
                $sql->bindValue(':Fcodfim', $codfim);
            } else {
                $sql->bindValue(':Icodfim', 1);
                $sql->bindValue(':Fcodfim', 99999);
            }
        }
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
            $pstm->bindValue(':estado', 0);
                    
            $rs = $pstm->execute();
        } catch (PDOException $e) {
            $rs = 0;
            throw new Exception('errors+' . $e->getMessage());
        }
        return $rs;
    }
    public function inserirMailingNeo($documento,$nome,$contrato,$id_grupo,$id_grupo,$datahoraagendamento,
                            $dddres1,$foneres1,$dddres2,$foneres2,$dddres3,$foneres3,$dddres4,
                            $foneres4,$dddres5,$foneres5,$dddcom1,$fonecom1,$dddcom2,$fonecom2,
                            $dddcom3,$fonecom3,$dddcom4,$fonecom4,$dddcom5,$fonecom5,$dddcel1,
                            $fonecel1,$dddcel2,$fonecel2,$dddcel3,$fonecel3,$dddcel4,$fonecel4,
                            $dddcel5,$fonecel5,$dddout1,$foneout1,$dddout2,$foneout2,$dddout3,
                            $foneout3,$dddout4,$foneout4,$dddout5,$foneout5,$dddpri1,$fonepri1,
                            $dddpri2,$fonepri2,$dddpesq1,$fonepesq1,$dddpesq2,$fonepesq2,$dddpesq3,
                            $fonepesq3,$dddpesq4,$fonepesq4,$dddpesq5,$fonepesq5,$agenteaAgenda,
                            $tipoagenda,$id_arquivo,$fila,$scoreScritorio,$scoreContratante,
                            $valor,$atraso,$carteira, $tabeladiscagem) {
        $array = array();
        try {
            $strSQL = "INSERT INTO ".$tabeladiscagem." (documento,nome,contrato,
            codagente,numeroramal,datahoraagendamento, instanteinsercao,dddres1,
            foneres1,dddres2,foneres2,dddres3,foneres3,dddres4,foneres4,dddres5,
            foneres5,dddcom1,fonecom1,dddcom2,fonecom2,dddcom3,fonecom3,dddcom4,
            fonecom4,dddcom5,fonecom5,dddcel1,fonecel1,dddcel2,fonecel2,dddcel3,
            fonecel3,dddcel4,fonecel4,dddcel5,fonecel5,dddout1,foneout1,dddout2,
            foneout2,dddout3,foneout3,dddout4,foneout4,dddout5, foneout5,dddpri1, 
            fonepri1, dddpri2, fonepri2, dddpesq1, fonepesq1, dddpesq2, fonepesq2,
             dddpesq3, fonepesq3, dddpesq4, fonepesq4, dddpesq5, fonepesq5, 
             agenteagenda,tentativas,tipoagenda,id_arquivo,fila,score_contrato,
             score_contratante,valor,atraso,carteira)
            values ('".$documento."','". utf8_encode($nome)."','".$contrato."','"
            .$id_grupo."','".$id_grupo."','".$datahoraagendamento."',now(),'".$dddres1.
            "','".$foneres1."','".$dddres2."','".$foneres2."','".$dddres3."','"
            .$foneres3."','".$dddres4."','".$foneres4."','".$dddres5."','".$foneres5.
            "','".$dddcom1."','".$fonecom1."','".$dddcom2."','".$fonecom2."','"
            .$dddcom3."','".$fonecom3."','".$dddcom4."','".$fonecom4."','".$dddcom5.
            "','".$fonecom5."','".$dddcel1."','".$fonecel1."','".$dddcel2."','"
            .$fonecel2."','".$dddcel3."','".$fonecel3."','".$dddcel4."','".$fonecel4.
            "','".$dddcel5."','".$fonecel5."','".$dddout1."','".$foneout1."','"
            .$dddout2."','".$foneout2."','".$dddout3."','".$foneout3."','".$dddout4.
            "','".$foneout4."','".$dddout5."','".$foneout5."','".$dddpri1."','"
            .$fonepri1."','".$dddpri2."','".$fonepri2."','".$dddpesq1."','".$fonepesq1.
            "','".$dddpesq2."','".$fonepesq2."','".$dddpesq3."','".$fonepesq3."','"
            .$dddpesq4."','".$fonepesq4."','".$dddpesq5."','".$fonepesq5."','"
            .$agenteaAgenda."','". 0 ."','".$tipoagenda."','".$id_arquivo."','"
            .$fila."','".$scoreScritorio."','".$scoreContratante."','".$valor."','"
            .$atraso."','".$carteira."')";

            $pstm = $this->dbdados->prepare($strSQL);

            $rs = $pstm->execute();
            // if ($rs!=1){
            //     echo $strSQL;echo '<br>';
            // }
        } catch (PDOException $e) {
            $rs = 0;
            throw new Exception('errors+' . $e->getMessage());
        }
        return $rs;
    }

    public function contabilizaMailing($tabela,$id_arquivo) {
        $array = array();
        $sql = 'SELECT count(id) as QTD from '.$tabela.' WHERE id_arquivo='.$id_arquivo;
        $sql = $this->dbdados->prepare($sql);
        $sql->execute();
        $array = $sql->fetch();
        $sql = 'UPDATE arquivo_mailing SET QTD='.$array['QTD'].' WHERE ID_ARQUIVOMAILING='.$id_arquivo;
        $sql = $this->dbdados->prepare($sql);
        $sql->execute();
    }

    public function prioridadeList($gr){
        $array = array();
        $gr1 = $gr;
        $gr2 = $gr;
        if ($gr2==0) {
            $gr2 = 999999;
        }
        $sql = $this->dbdados->prepare("SELECT COD_PRIORIDADE,DSC_PRIORIDADE,TIM_INICIAL,TIM_FINAL,COD_ATIVO,
                                        b.CAMP_DESC as CAMPANHA,c.descricao as GRUPO ,
                                        case IND_TIPO
                                        when 1 then 'Tipo'
                                        when 2 then 'Horario'
                                        when 3 then 'UF'
                                        when 4 then 'Arquivo'
                                        when 5 then 'Campo'
                                        end as TIPO
                                        from prioridadediscador a join campanha b on
                                        a.COD_CAMPANHA=b.ID_CAMPANHA
                                        join grupo c on
                                        a.COD_GRUPO=c.id_grupo
                                        where a.COD_GRUPO>=:gr1
                                        and a.COD_GRUPO<=:gr2");
        $sql->bindValue(':gr1',$gr1);
        $sql->bindValue(':gr2',$gr2);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function setPrioridade($id,$ativo){
        $array = array();
        if ($ativo==1) {
            $ativo=0;
        } else {
            $ativo=1;
        }
        $sql = $this->dbdados->prepare("UPDATE prioridadediscador set COD_ATIVO=:ativo
                                        where COD_PRIORIDADE=:id");
        $sql->bindValue(':ativo',$ativo);
        $sql->bindValue(':id',$id);
        $sql->execute();
    }

    public function prioridadeDiasDaSeaman($id){
        $array = array();
        $sql = $this->dbdados->prepare("SELECT 
                                        case COD_SEMANA
                                        when 1 then 'Dom'
                                        when 2 then 'Seg'
                                        when 3 then 'Ter'
                                        when 4 then 'Qua'
                                        when 5 then 'Qui'
                                        when 6 then 'Sex'
                                        when 7 then 'Sab'
                                        end as semana
                                        from prioridadediscadorsemana
                                        where COD_PRIORIDADE=:id");
        $sql->bindValue(':id',$id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}
