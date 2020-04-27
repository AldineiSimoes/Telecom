<?php

/* 
 */

class Supervisor extends model {

    public function listUsers($user,$camp,$group) {
        $array = array();
        $agora = strtotime('now');
        $desde = date('Y-m-d H:i:s', ($agora)-3600);
        if ($camp==0) {
            $camp = ' >= '.$camp;
        } else {
            $camp = ' = '.$camp;
        }
        // $sql = $this->dbdados->prepare('SELECT a.* FROM tb_infousuario a join grupo b on
        //                                 a.id_grupo=b.id_grupo
        //                                 where a.id_grupo>=:group 
        //                                 and a.id_grupo<=:group1 
        //                                 and b.ID_CAMPANHA=:camp
        //                                 order by a.id_grupo,a.nome');
        $sql = $this->dbdados->prepare('SELECT a.*,b.descricao,c.id,IFNULL(e.LIVRES,0) as LIVRES,
                                        IFNULL(e.AGENDADO,0) as AGENDADO,
                                        IFNULL(e.FINALIZADO,0) as FINALIZADO,
                                        IFNULL(e.ALO,0) as ALO,
                                        IFNULL(e.CPC,0) as CPC,
                                        IFNULL(e.SUCESSO,0) as SUCESSO,
                                        IFNULL((select ID_RESULTADODISCAGEM from resultadodiscagem
                                        where RD_DH_INICIO>="'.$desde.'" AND ID_GRUPO=b.id_grupo 
                                        limit 1),0) as discou
                                        FROM tb_infousuario a join grupo b on
                                        a.id_grupo=b.id_grupo
                                        join agentes c on c.username=a.codigo
                                        left outer join discador d on
                                        b.id_grupo=d.ID_GRUPO
                                        left outer join res_mailing e on
                                        d.ID_DISCADOR=e.ID_DISCADOR
                                        join campanha_usuario f on
                                        b.ID_CAMPANHA=f.ID_CAMPANHA
                                        where b.ID_CAMPANHA '.$camp.'
                                        and f.ID_USUARIO='.$user.'
                                        order by a.id_grupo,a.nome');
        $sql->bindValue(':camp',$camp);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getDial($idgrupo) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT STF_DESC as descricao, count(id_cdr) as qtd FROM cdr a join st_fim b on a.ID_STFIM=b.ID_STFIM where CDR_DH_INICIO>=:dti and CDR_DH_INICIO<=:dtf and ID_GRUPO=:idgrupo group by STF_DESC");
        $dti = date('y-m-d').' 00:00:00';
        $dtf = date('y-m-d').' 23:59:59';
        $sql->bindValue(':dti',$dti);
        $sql->bindValue(':dtf',$dtf);
        $sql->bindValue(':idgrupo',$idgrupo);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;

    }

    public function getMonitoraCampanha($id,$idag,$tipo) {
        $array = array();
        $sel = 'SELECT  d.id_discador,a.id_grupo, g.descricao, count(1) logados,
                    sum(case when a.id_estado=1 then 1 else 0 end ) aglivres,
                    ( select max(B2.tempoagente) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado=1) max_livre,
                    sum(case when a.id_estado=6 then 1 else 0 end ) clerical,
                    ( select max(B2.tempoagente) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado=6) max_clerical,
                    sum(case when a.id_estado=9 then 1 else 0 end ) pausado,
                    sum(case when a.id_estado=7 then 1 else 0 end ) atendendo,
                    res.livres, res.agendado, res.finalizado,res.finalizado_tentativa,res.ALO,res.CPC,res.SUCESSO,res.IMPRODUTIVO,
                    STR_TO_DATE(sec_to_time( sum(case when a.id_estado=1 then time_to_sec(a.tempoagente) else 0 end) /
                    ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                        and B2.id_estado=1) ), "%H:%i:%s" ) TME_ESPERA,

                    STR_TO_DATE(sec_to_time( sum(case when a.id_estado=7 then time_to_sec(a.tempoagente) else 0 end) /
                    ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                        and B2.id_estado=7) ), "%H:%i:%s" )TMC_FALANDO,
                    STR_TO_DATE(sec_to_time( sum(case when a.id_estado IN (6,7) then time_to_sec(a.tempoagente) else 0 end) /
                    ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                        and B2.id_estado IN (6,7) ) ), "%H:%i:%s" ) TMA_ATENDIMENTO,
                        res.LIVRES,res.FINALIZADO,res.EMUSO,res.AGENDADO,res.ALO,res.CPC,res.SUCESSO
                    from tb_infousuario a
                    inner join grupo g on g.id_grupo=a.id_grupo
                    inner join discador d on d.id_grupo=a.id_grupo and d.ativo=1
                    left join res_mailing res on res.id_discador=d.id_discador ';
       if ($tipo=='C') {
            $sel .= 'where g.id_campanha in (SELECT id_campanha FROM campanha_usuario 
                        where id_campanha = '.$id.')
                        group by g.id_campanha';
        };
        if ($tipo=='G') {
            if ($id > 0) {
                $sel .= 'where g.id_grupo = '.$id;
            }
            $sel .= ' group by a.id_grupo';
        };
        if ($tipo=='A') {
            $sel .= 'where g.id_grupo = "'.$id.'" and a.codigo = "'.$idag.'" group by a.codigo';
        };
        $sql = $this->dbdados->prepare($sel);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;

    }

    public function grupoDetalhes($id,$tempo=600) {
        $array = array();
        $agora = strtotime('now');

        if(empty($tempo)){
        
            $tempo = 60;
        }   
        
        $desde = date('Y-m-d H:i:s', ($agora)-($tempo));
        $query = "select b.stf_desc, count(1) total
            from resultadodiscagem a
            left join st_fim b on b.codigo_gennex=a.rd_codresultadoDiscagem
            where a.id_grupo = $id
            and rd_dh_inicio between '$desde' and now()
            group by b.stf_desc";
        
        $sql = $this->dbdados->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function grupoDetalhesLista($id,$tempo=600) {
        $array = array();
        $agora = strtotime('now');

        if(empty($tempo)){
        
            $tempo = 60;
        }   
        
        $desde = date('Y-m-d H:i:s', ($agora)-($tempo));
        $query = "select
                    a.rd_dh_inicio horario,
                    a.rd_ddddiscado ddd,
                    a.rd_fonediscado fone,
                    b.stf_desc estado,
                    ag.nome,
                    a.rd_operadora operadora
                    from resultadodiscagem a
                    inner join grupo g on g.id_grupo=a.id_grupo
                    inner join campanha c on c.id_campanha=g.id_campanha
                    left join st_fim b on b.codigo_gennex=a.rd_codresultadoDiscagem
                    left join agentes ag on ag.username=a.rd_chamadaAgente
                    where a.id_grupo = $id
                    and rd_dh_inicio > '$desde'
                    order by horario desc"; // limit " . $inicio . "," . $limit."";
    
        $sql = $this->dbdados->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getGruposAtivos($user) {
        $array = array();
        $query = " select    d.id_discador,a.id_grupo, g.descricao, count(1) logados,
                sum(case when a.id_estado=1 then 1 else 0 end ) aglivres,
                ( select max(B2.tempoagente) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                and B2.id_estado=1) max_livre,
                sum(case when a.id_estado=6 then 1 else 0 end ) clerical,
                ( select max(B2.tempoagente) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                and B2.id_estado=6) max_clerical,
                sum(case when a.id_estado=9 then 1 else 0 end ) pausado,
                sum(case when a.id_estado=7 then 1 else 0 end ) atendendo,
                res.livres, res.agendado, res.finalizado,res.finalizado_tentativa,res.ALO,res.CPC,res.SUCESSO,res.IMPRODUTIVO,
                STR_TO_DATE(sec_to_time( sum(case when a.id_estado=1 then time_to_sec(a.tempoagente) else 0 end) /
                ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado=1) ), '%H:%i:%s' ) TME_ESPERA,

                STR_TO_DATE(sec_to_time( sum(case when a.id_estado=7 then time_to_sec(a.tempoagente) else 0 end) /
                ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado=7) ), '%H:%i:%s' )TMC_FALANDO,
                STR_TO_DATE(sec_to_time( sum(case when a.id_estado IN (6,7) then time_to_sec(a.tempoagente) else 0 end) /
                ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado IN (6,7) ) ), '%H:%i:%s' ) TMA_ATENDIMENTO
                from tb_infousuario a
                inner join grupo g on g.id_grupo=a.id_grupo
                inner join discador d on d.id_grupo=a.id_grupo and d.ativo=1
                left join res_mailing res on res.id_discador=d.id_discador
                where g.id_campanha in (SELECT id_campanha FROM campanha_usuario where id_usuario = ".$user.")
                group by a.id_grupo, g.descricao ";

        $sql = $this->dbdados->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getGruposReceptivo($user) {
        $array = array();
        $agora = strtotime('now');

        $desde = date('Y-m-d', ($agora));
        $query = "select    d.id_discador,a.id_grupo, g.descricao, count(1) logados,
                sum(case when a.id_estado=1 then 1 else 0 end ) aglivres,
                ( select max(B2.tempoagente) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                and B2.id_estado=1) max_livre,
                sum(case when a.id_estado=6 then 1 else 0 end ) clerical,
                ( select max(B2.tempoagente) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                and B2.id_estado=6) max_clerical,
                sum(case when a.id_estado=9 then 1 else 0 end ) pausado,
                sum(case when a.id_estado=7 then 1 else 0 end ) atendendo,
                res.livres, res.agendado, res.finalizado,res.finalizado_tentativa,res.ALO,res.CPC,res.IMPRODUTIVO,
                STR_TO_DATE(sec_to_time( sum(case when a.id_estado=1 then time_to_sec(a.tempoagente) else 0 end) /
                ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado=1) ), '%H:%i:%s' )  TME_ESPERA,
                STR_TO_DATE(sec_to_time( sum(case when a.id_estado=7 then time_to_sec(a.tempoagente) else 0 end) /
                ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado=7) ), '%H:%i:%s' ) TMC_FALANDO,
                STR_TO_DATE(sec_to_time( sum(case when a.id_estado IN (6,7) then time_to_sec(a.tempoagente) else 0 end) /
                ( select count(1) from tb_infousuario b2 where b2.id_grupo=a.id_grupo
                    and B2.id_estado IN (6,7) ) ), '%H:%i:%s' ) TMA_ATENDIMENTO,
                ( SELECT COUNT(*) FROM relatreceptivo r WHERE r.dh_inicio > '$desde' AND r.codgrupo=a.id_grupo AND r.id_agente = '0') TOTAL_ABANDONADAS,
                ( SELECT COUNT(*) FROM relatreceptivo r WHERE r.dh_inicio > '$desde' AND r.codgrupo=a.id_grupo AND r.id_agente > '0') TOTAL_ATENDIDAS,
                (select count(id_grupo) from fila_ura f where f.id_grupo=a.id_grupo) fila
                from tb_infousuario a
                inner join grupo g on g.id_grupo=a.id_grupo and g.id_tipogrupo = '2'
                left join discador d on d.id_grupo=a.id_grupo and d.ativo=1
                left join res_mailing res on res.id_discador=d.id_discador
                where g.id_campanha in (SELECT id_campanha FROM campanha_usuario where id_usuario = ".$user.")
                group by a.id_grupo, g.descricao ";

        $sql = $this->dbdados->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function zerarRegistros($id_discador,$tipo_registro) {
        $query = "insert into RETORNO_FICHA (RET_DH_INICIO,CPUPDATE,ID_DISCADOR,ID_TIPORETORNO,ID_STRETORNO,ID_USUARIO) values 
                                            (now(),now(),$discador,$tipoRegistro,1,$idUser)";
        $sql = $this->dbdados->prepare($query);
        $sql->execute();
    }

}

