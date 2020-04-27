<?php
class Reports extends model {

    public function __construct() {
        parent::__construct(); //executa o construtor da classe ancestral
    }

    public function listLigacoes(){
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM cadencia ORDER BY CAD_DESC");
        $sql->execute();
        if($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
        }
        return $array;
    }

    public function resCustos($dti,$dtf,$oper,$grupo,$camp,$operadora,$ddd) { 
        $array = array();
        $cond = '';
        if($grupo>0){
            $cond .= ' AND a.ID_GRUPO='.$grupo;
        }
        if($camp>0){
            $cond .= ' AND a.ID_CAMPANHA='.$camp;
        }
        if($operadora>0){
            $cond .= ' AND a.ID_OPERADORA='.$operadora;
        }
        if($ddd!=''){
            $cond .= ' AND ddd='.$ddd;
        }

        $sql = "  select a.nome_operadora, count(a.id) ligacoes,min(a.dh_inicio) primeiro_att,
                    max(a.dh_inicio) ultimo_att, sum(a.valor_ligacao) total
                    from catalogobilhetes a 
                where a.direcao = $oper
                    and a.dh_inicio between '$dti' and '$dtf'
                        $cond
                    group by a.nome_operadora ";
/*        $sql = "  select o.ope_desc, count(a.id_cdr) ligacoes,min(a.cdr_dh_inicio) primeiro_att,
                    max(a.cdr_dh_inicio) ultimo_att, sum(a.tar_valor) total
                    from cdr a
                    inner join operadora o on o.id_operadora=a.id_operadora 
                    where a.id_tipooperacao = $oper
                    and a.CDR_DH_INICIO between '$dti' and '$dtf'
                    $cond "
                . " group by o.ope_desc";
  */      
        try {
            //echo $sql;exit; 
            $sql = $this->dbdados2->query($sql);
            $array = $sql->fetchAll();
        } catch (Exceptin $e) {
                echo 'Erro :'.$e->getMessage(), "\n";
        }
        return $array;
    }

    
    public function analiticoCustos($dti,$dtf,$oper,$grupo,$camp,$operadora,$ddd) { 
        $array = array();
        $cond = '';
        if($grupo>0){
            $cond .= ' AND a.ID_GRUPO='.$grupo;
        }
        if($camp>0){
            $cond .= ' AND a.ID_CAMPANHA='.$camp;
        }
        if($operadora>0){
            $cond .= ' AND a.ID_OPERADORA='.$operadora;
        }
        if($ddd!=''){
            $cond .= ' AND ddd='.$ddd;
        }
        $sql = "select
                a.id as id_cdr,
                a.dh_inicio as cdr_dh_inicio,
                a.nome_operadora as operadora,
                a.ddd as ddd_numero,
                a.telefone as cdr_fone,
                a.nome_direcao as origem_desc,
                a.nome_tipofone as mod_desc,
                a.nome_finalizacao as stf_desc,
                a.cod_agente as ramal,
                a.nome_agente as agente,
                a.nome_grupo as descricao,
                a.contrato as chave,
                a.tempo_tarifado as tar_segundos,
                a.dh_at_publica as cdr_dh_at_publica,
                a.dh_at_ramal,
                a.dh_fim_ligacao as cdr_dh_fimligacao,
                round (a.valor_ligacao, 2) as tar_valor,
                a.valor_tarifa
                from catalogobilhetes a
                where a.direcao = $oper
                and a.dh_inicio between '$dti' and '$dtf'
                    $cond ";
        try {
            //echo $sql;exit; 
            $sql = $this->dbdados2->query($sql);
            $array = $sql->fetchAll();
        } catch (Exceptin $e) {
                echo 'Erro :'.$e->getMessage(), "\n";
        }
        return $array;
    }
    public function resDesempenho($dti,$dtf,$oper,$grupo,$camp) { 
        $array = array();
        $cond = '';
        if($grupo>0){
            $cond .= ' AND r.grupo='.$grupo;
        }
        if($camp>0){
            $cond .= ' AND r.campanha = '.$camp;
        }

        // $sql = "SELECT sub.id_hora,case when sub.hora<>'' then sub.hora else 'Total' end hora,
        //         sub.logados -1 logados,
        //         sub.disparos,
        //         sub.at_ramal,
        //         concat(round(     (sub.at_ramal/sub.disparos)*100 ,2) ,'%') perc_at_ramal,
        //         sub.nao_atendida,
        //         concat(round( (   (sub.nao_atendida/sub.disparos)*100  ),2) ,'%') perc_nao_atendida,
        //         sub.ocupado,
        //         concat(round( (   (sub.ocupado/sub.disparos)*100),2) ,'%') perc_ocupado,
        //         sub.nao_existe,
        //         concat(round( (   (sub.nao_existe/sub.disparos)*100),2) ,'%') perc_naoexiste,
        //         sub.fora_servico,
        //         concat(round( (   (sub.fora_servico/sub.disparos)*100),2) ,'%') perc_foraservico,
        //         sub.caixa_postal,
        //         concat(round( (   (sub.caixa_postal/sub.disparos)*100),2) ,'%') perc_caixapostal,
        //         sub.canceladas,
        //         concat(round( (   (sub.canceladas/sub.disparos)*100),2) ,'%') perc_canceladas,
        //         sub.ringando_ramal,
        //         concat(round( (   (sub.ringando_ramal/sub.disparos)*100),2) ,'%') perc_ring_ramal,
        //         sub.abandono_fila,
        //         concat(round( (   (sub.abandono_fila/sub.disparos)*100),2) ,'%') perc_abandono_fila,
        //         sub.no_agent,
        //         CONCAT(ROUND(((sub.no_agent/sub.disparos)*100),2),'%') perc_no_agent
        //         from (
        //         select h.id_hora,h.hora_desc Hora, count(distinct c1.id_agente) Logados,
        //         sum(case when s.ativo=1 then 1 else 0 end ) Disparos,
        //         sum(case when c1.id_stfim=1001 then 1 else 0 end ) At_Ramal,
        //         sum(case when (c1.id_stfim=1003 or c1.id_stfim = 408) then 1 else 0 end ) Nao_Atendida,
        //         sum(case when (c1.id_stfim=1002 or c1.id_stfim=486)  then 1 else 0 end ) Ocupado,
        //         sum(case when (c1.id_stfim=1005 or c1.id_stfim=404 or c1.id_stfim=480 or c1.id_stfim=410) then 1 else 0 end ) nao_existe,
        //         sum(case when (c1.id_stfim=1008 or c1.id_stfim=480) then 1 else 0 end ) fora_servico,
        //         sum(case when c1.id_stfim=1013 then 1 else 0 end ) Abandono_fila,
        //         sum(case when c1.id_stfim=1004 then 1 else 0 end ) Caixa_Postal,
        //         sum(case when c1.id_stfim=1029 then 1 else 0 end ) Canceladas,
        //         sum(case when c1.id_stfim=1030 then 1 else 0 end ) Ringando_Ramal,
        //         SUM(CASE WHEN (c1.id_stfim=0 or c1.id_stfim=1011) THEN 1 ELSE 0 END) No_Agent
        //         from cdr c1
        //         inner join st_fim s on s.id_stfim=c1.id_stfim
        //         inner join hora h on c1.hora_ini between h.hora_ini and h.hora_fim
        //         where c1.cdr_dh_inicio between '$dti' and '$dtf'
        //         and c1.id_tipooperacao = $oper 
        //         $cond
        //         group by  h.hora_desc
        //         order by h.id_hora
        //         ) sub";
            $sql = " select r.datadia,
            MAX(r.logados) logados,
             SUM(r.disparos) disparos,
            SUM(r.at_ramal) at_ramal,
            concat(round(((r.at_ramal/r.disparos)*100),2)) perc_at_ramal,
            SUM(r.nao_atendidas) nao_atendidas,
                concat(round(((r.nao_atendidas/r.disparos)*100),2)) perc_nao_atendidas,
            SUM(r.ocupado) ocupado,
            concat(round(((r.ocupado/r.disparos)*100),2)) perc_ocupado,
            SUM(r.nao_existe) nao_existe,
            concat(round(((r.nao_existe/r.disparos)*100),2)) perc_nao_existe,
            SUM(r.fora_servico) fora_servico,
             concat(round(((r.fora_servico/r.disparos)*100),2)) perc_fora_servico,
            SUM(r.abandono_fila) abandono_fila,
             SUM(r.caixa_postal) caixa_postal,
               concat(round(((r.caixa_postal/r.disparos)*100),2)) perc_caixa_postal,
               SUM(r.congestionamento_operadora) congestionamento_operadora,
               concat(round(((r.congestionamento_operadora/r.disparos)*100),2)) perc_congestionamento_operadora,
             SUM(r.cancelada) cancelada,
             concat(round(((r.cancelada/r.disparos)*100),2)) perc_cancelada,
              SUM(r.ring_ramal) ring_ramal,
            concat(round(((r.ring_ramal/r.disparos)*100),2)) perc_ring_ramal,
             SUM(r.no_agents) no_agents,
             concat(round(((r.no_agents/r.disparos)*100),2)) perc_no_agents,
             SUM(r.alo) alo,
             concat(round(((r.alo/r.at_ramal)*100),2)) perc_alo,
             SUM(r.cpc) cpc,
            concat(round(((r.cpc/r.alo)*100),2)) perc_cpc,
            SUM(r.sucesso) sucesso,
             concat(round(((r.sucesso/r.cpc)*100),2)) perc_sucesso,
             SUM(r.improdutivas) improdutivas,
             concat(round(((r.improdutivas/r.at_ramal)*100),2)) perc_improdutivas
        from relatdesempenhogrupo r 
        inner join discador d on r.grupo=d.ID_GRUPO	
        where r.datadia  between '$dti' and '$dtf' $cond and r.logados <> '0'  and r.disparos <> '0'
        group by r.datadia";


        try {
            //echo $sql;exit; 
            $sql = $this->dbdados2->query($sql);
            $array = $sql->fetchAll();
        } catch (Exceptin $e) {
                echo 'Erro :'.$e->getMessage(), "\n";
        }
        return $array;
    }
    public function resDesempenhoTotal($dti,$dtf,$oper,$grupo,$camp) { 
        $array = array();
        $cond = '';
        if($grupo>0){
            $cond .= ' AND c1.id_grupo='.$grupo;
        }
        if($camp>0){
            $cond .= ' AND c1.id_campanha='.$camp;
        }

        $sql = "select sub.id_hora,case when sub.hora<>'' then sub.hora else 'Total' end hora,
                sub.logados -1 logados,
                sub.disparos,
                sub.at_ramal,
                concat(round(     (sub.at_ramal/sub.disparos)*100 ,2) ,'%') perc_at_ramal,
                sub.nao_atendida,
                concat(round( (   (sub.nao_atendida/sub.disparos)*100  ),2) ,'%') perc_nao_atendida,
                sub.ocupado,
                concat(round( (   (sub.ocupado/sub.disparos)*100),2) ,'%') perc_ocupado,
                sub.nao_existe,
                concat(round( (   (sub.nao_existe/sub.disparos)*100),2) ,'%') perc_naoexiste,
                sub.fora_servico,
                concat(round( (   (sub.fora_servico/sub.disparos)*100),2) ,'%') perc_foraservico,
                sub.caixa_postal,
                concat(round( (   (sub.caixa_postal/sub.disparos)*100),2) ,'%') perc_caixapostal,
                sub.canceladas,
                concat(round( (   (sub.canceladas/sub.disparos)*100),2) ,'%') perc_canceladas,
                sub.ringando_ramal,
                concat(round( (   (sub.ringando_ramal/sub.disparos)*100),2) ,'%') perc_ring_ramal,
                sub.abandono_fila,
                concat(round( (   (sub.abandono_fila/sub.disparos)*100),2) ,'%') perc_abandono_fila,
                sub.no_agent,
                CONCAT(ROUND(((sub.no_agent/sub.disparos)*100),2),'%') perc_no_agent
                from (
                select h.id_hora,h.hora_desc Hora, count(distinct c1.id_agente) Logados,
                sum(case when s.ativo=1 then 1 else 0 end ) Disparos,
                sum(case when c1.id_stfim=1001 then 1 else 0 end ) At_Ramal,
                sum(case when (c1.id_stfim=1003 or c1.id_stfim = 408) then 1 else 0 end ) Nao_Atendida,
                sum(case when (c1.id_stfim=1002 or c1.id_stfim=486)  then 1 else 0 end ) Ocupado,
                sum(case when (c1.id_stfim=1005 or c1.id_stfim=404 or c1.id_stfim=480 or c1.id_stfim=410) then 1 else 0 end ) nao_existe,
                sum(case when (c1.id_stfim=1008 or c1.id_stfim=480) then 1 else 0 end ) fora_servico,
                sum(case when c1.id_stfim=1013 then 1 else 0 end ) Abandono_fila,
                sum(case when c1.id_stfim=1004 then 1 else 0 end ) Caixa_Postal,
                sum(case when c1.id_stfim=1029 then 1 else 0 end ) Canceladas,
                sum(case when c1.id_stfim=1030 then 1 else 0 end ) Ringando_Ramal,
                SUM(CASE WHEN (c1.id_stfim=0 or c1.id_stfim=1011) THEN 1 ELSE 0 END) No_Agent
                from cdr c1
                inner join st_fim s on s.id_stfim=c1.id_stfim
                inner join hora h on c1.hora_ini between h.hora_ini and h.hora_fim
                where c1.cdr_dh_inicio between '$dti' and '$dtf'
                and c1.id_tipooperacao = $oper 
                $cond
                group by  h.hora_desc
                order by h.id_hora
                ) sub";
        try {
            //echo $sql;exit; 
//            $sql = $this->dbdados->query($sql);
//            $array = $sql->fetchAll();
        } catch (Exceptin $e) {
                echo 'Erro :'.$e->getMessage(), "\n";
        }
        return $array;
    }

    public function agentesLogados($dti, $dtf){
        $array = array();
        $query="select  DATE_FORMAT(C1.CDR_dh_inicio, '%d/%m/%Y') data ,
            h.hora_desc hora, count(distinct c1.id_agente) logados
            from cdr c1
            inner join hora h on c1.hora_ini between h.hora_ini and h.hora_fim
            where c1.cdr_dh_inicio between '$dti' and '$dtf'and H.LOGADO=1 and c1.id_agente > 1
            group by DATE_FORMAT(C1.CDR_dh_inicio, '%d/%m/%Y') , h.hora_desc
            order by 3 desc limit 30";
        $sql = $this->dbdados2->prepare($query);
        // $sql->bindValue(':dti',$dti);
        // $sql->bindValue(':dtf',$dtf);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getDuracaoChamadas($dti, $dtf, $grupo){
        $array = array();
        if ($grupo==0) {
            $grupo = '> 0';
        } else {
            $grupo = '= '.$grupo;
        }
        $query="select d.dur_desc, count(a.id) qtde
                from catalogogravacoes a
                inner join duracao d on a.tempo_segundos between d.dur_ini and d.dur_fim
                where A.DH_INICIO between '$dti' and '$dtf'
                and d.ativo=1
                and a.id_grupo $grupo
                group by d.dur_desc
                order by d.ordem";
        $sql = $this->dbdados2->prepare($query);
        // $sql->bindValue(':dti',$dti);
        // $sql->bindValue(':dtf',$dtf);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function relPausas($dti, $dtf, $grupo,$agente){
        $array = array();
        if ($grupo==0) {
            $grupo ='' ;
        } else {
            $grupo = " and cod_grupo =  ".$grupo;
        };
        if ($agente==0){
            $agente="";
        } else{
            $agente = " and cod_agente = '".$agente."'";
        };
        $query = "select distinct(cod_agente), a.nome  from eventosagentes
            left join agentes a on a.username = cod_agente
            where instante  between '$dti' and '$dtf'
            and id_evento = 3
            $grupo
            $agente
            and TempoEmSegundos > 0
            group by subcod_evento,cod_agente, instante
            order by cod_grupo,cod_agente,instante";        
        $sql = $this->dbdados2->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function relPausasLista($dti, $dtf, $grupo,$agente){
        $array = array();
        if ($grupo==0) {
            $grupo ='' ;
        } else {
            $grupo = " and cod_grupo =  ".$grupo;
        }
        $query ="select cod_grupo,a.nome,cod_agente,subcod_evento,instante, SEC_TO_TIME((TempoEmSegundos)) tempo
                from eventosagentes
                inner join agentes a on a.username = cod_agente
                where instante  between '$dti' and '$dtf'
                $grupo
                and cod_agente = '".$agente."'
                and id_evento = 3
                and TempoEmSegundos > 0
                group by instante, subcod_evento
                order by instante asc";      
        $sql = $this->dbdados2->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function relPausasResumoPausas($dti, $dtf,$agente){
        $array = array();
        $reg = 0;
        if(!$agente){
            $filtroAgente = "";
        }else{
            $filtroAgente = "and cod_agente = '".$agente."'";
        }
        $sql = "SELECT DISTINCT subcod_evento
                FROM eventosagentes
                WHERE id_evento = 3 AND TempoEmSegundos > 0 AND instante BETWEEN '$dti' AND '$dtf' $filtroAgente
                ORDER BY subcod_evento";
        $sql = $this->dbdados2->prepare($sql);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function relPausasResumoAgentes($dti, $dtf,$agente){
        $array = array();
        $reg = 0;
        if(!$agente){
            $filtroAgente = "";
        }else{
            $filtroAgente = "and cod_agente = '".$agente."'";
        }
        $sql = "SELECT DISTINCT cod_agente, a.nome
                FROM eventosagentes
                left join agentes a on a.username = cod_agente
                WHERE id_evento = 3 AND TempoEmSegundos > 0 AND instante BETWEEN '$dti' and '$dtf' $filtroAgente
                ORDER BY a.nome;";
        $sql = $this->dbdados2->prepare($sql);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function relPausasResumoTempoPausa($dti, $dtf,$agente,$pausa){
        $array = array();
        $reg = 0;
        $sql = "SELECT SEC_TO_TIME(SUM(distinct TempoEmSegundos)) tempo
                FROM eventosagentes
                WHERE id_evento = 3
                AND TempoEmSegundos > 0 AND instante BETWEEN '$dti' and '$dtf'
                AND cod_agente = '$agente' 
                AND subcod_evento = '$pausa'";
        $sql = $this->dbdados2->prepare($sql);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $reg = $sql->fetch();
        }
        return $reg;
    }

    public function relPausasResumo($dti, $dtf, $grupo,$agente){
        $sql = "SELECT DISTINCT subcod_evento
                FROM eventosagentes
                WHERE id_evento = 3 AND TempoEmSegundos > 0 AND instante BETWEEN '$de $hrinicio:00' AND '$ate $hrfim:59' $filtroAgente
                ORDER BY subcod_evento";

    }

    public function relPausasTotal($dti, $dtf, $grupo,$agente){
        $reg = 0;
        if ($grupo==0) {
            $grupo ='' ;
        } else {
            $grupo = " and cod_grupo =  ".$grupo;
        }
        $query = "select SEC_TO_TIME(sum(DISTINCT TempoEmSegundos)) tempototal
                    from eventosagentes
                    where instante  between '$dti' and '$dtf'
                    $grupo
                    and cod_agente = '".$agente."'
                    and id_evento = 3
                    and TempoEmSegundos > 0
                    group by cod_agente";        
        $sql = $this->dbdados2->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $reg = $sql->fetch();
        }
        return $reg;
    }

    public function nivelServico($dti, $dtf, $grupo,$camp){
        $array = array();
        if ($grupo==0) {
            $grupo =' > 0' ;
        } else {
            $grupo = " =  ".$grupo;
        }
        if ($camp==0) {
            $camp =' > 0' ;
        } else {
            $camp = " =  ".$camp;
        }
        $query = "  SELECT sub.id_hora, CASE WHEN sub.hora<>'' THEN sub.hora ELSE 'Total' END hora,
        sub.recebidas,
        sub.nao_atendidas,
        sub.atendidas,
        sub.atendidas_ate20,
        sub.atendidas_21_40,
        sub.atendidas_41_60,
        sub.atendidas_61_120,
        sub.atendidas_acima120,
        sub.falado,
        sub.tempo_maximo_fila,
        SEC_TO_TIME(TIME_TO_SEC(sub.falado)/sub.atendidas) TMA,
        SEC_TO_TIME((sub.livre/sub.atendidas)) TME,
        sub.total_abandonadas,
        sub.abandonadas_ate20,
        sub.abandonadas_21_40,
        sub.abandonadas_41_60,
        sub.abandonadas_61_120,
        sub.abandonadas_acima120,
        CONCAT(ROUND(((sub.atendidas_ate20/sub.atendidas)*100),2),'%') nivel_servico
        FROM (
        SELECT h.id_hora,h.hora_desc Hora,
        SUM(CASE WHEN s.ativo in (0,1) THEN 1 ELSE 0 END) Recebidas, 
        SUM(CASE WHEN c1.id_stfim<>1001 THEN 1 ELSE 0 END) Nao_atendidas,
        SUM(CASE WHEN (c1.id_stfim=1001) THEN 1 ELSE 0 END) Atendidas,
        SUM(CASE WHEN (c1.id_stfim=1001 AND c1.CDR_TEMPOFILA_GRUPODAC <= '00:00:20') THEN 1 ELSE 0 END) atendidas_ate20,
        SUM(CASE WHEN (c1.id_stfim=1001 AND c1.CDR_TEMPOFILA_GRUPODAC >= '00:00:21' and c1.CDR_TEMPOFILA_GRUPODAC <= '00:00:40') THEN 1 ELSE 0 END) atendidas_21_40,
        SUM(CASE WHEN (c1.id_stfim=1001 AND c1.CDR_TEMPOFILA_GRUPODAC >= '00:00:41' and c1.CDR_TEMPOFILA_GRUPODAC <= '00:01:00') THEN 1 ELSE 0 END) atendidas_41_60,
        SUM(CASE WHEN (c1.id_stfim=1001 AND c1.CDR_TEMPOFILA_GRUPODAC >= '00:01:01' and c1.CDR_TEMPOFILA_GRUPODAC <= '00:02:00') THEN 1 ELSE 0 END) atendidas_61_120,
        SUM(CASE WHEN (c1.id_stfim=1001 AND c1.CDR_TEMPOFILA_GRUPODAC >= '00:02:01') THEN 1 ELSE 0 END) atendidas_acima120,
        SEC_TO_TIME(SUM(TIME_TO_SEC(CASE WHEN c1.id_stfim=1001 THEN c1.cdr_tempofalado ELSE 0 END))) falado, 
        SEC_TO_TIME(SUM(TIME_TO_SEC(CASE WHEN c1.id_stfim=1001 and c1.cdr_tempolivreagente > 0 THEN c1.cdr_tempolivreAgente ELSE 0 END))) livre,
        SEC_TO_TIME(SUM(TIME_TO_SEC(CASE WHEN  c1.id_stfim=1001 THEN c1.CDR_TEMPOFILA_GRUPODAC ELSE 0 END))) tempo_maximo_fila,
        SUM(CASE WHEN (c1.id_stfim=1015) THEN 1 ELSE 0 END) total_abandonadas,
        SUM(CASE WHEN (c1.id_stfim=1015 AND c1.CDR_TEMPOFILA_URA <= '00:00:20') THEN 1 ELSE 0 END) abandonadas_ate20,
        SUM(CASE WHEN (c1.id_stfim=1015 AND c1.CDR_TEMPOFILA_URA >= '00:00:21' and c1.CDR_TEMPOFILA_URA <= '00:00:40') THEN 1 ELSE 0 END) abandonadas_21_40,
        SUM(CASE WHEN (c1.id_stfim=1015 AND c1.CDR_TEMPOFILA_URA >= '00:00:41' and c1.CDR_TEMPOFILA_URA <= '00:01:00') THEN 1 ELSE 0 END) abandonadas_41_60,
        SUM(CASE WHEN (c1.id_stfim=1015 AND c1.CDR_TEMPOFILA_URA >= '00:01:01' and c1.CDR_TEMPOFILA_URA <= '00:02:00') THEN 1 ELSE 0 END) abandonadas_61_120,
        SUM(CASE WHEN (c1.id_stfim=1015 AND c1.CDR_TEMPOFILA_URA >= '00:02:01') THEN 1 ELSE 0 END) abandonadas_acima120
        FROM cdr c1
        INNER JOIN st_fim s ON s.id_stfim=c1.id_stfim
        INNER JOIN hora h ON c1.hora_ini BETWEEN h.hora_ini AND h.hora_fim
        WHERE c1.cdr_dh_inicio between '$dti' and '$dtf'
        AND c1.id_tipooperacao = 2
        AND c1.id_grupo $grupo
        AND c1.id_campanha $camp 
        GROUP BY h.hora_desc
        ORDER BY h.id_hora
        ) sub";                       
        $sql = $this->dbdados2->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function nivelServicoDetalhe($dti, $dtf, $grupo,$camp){
        $array = array();
        if ($grupo==0) {
            $grupo =' > 0' ;
        } else {
            $grupo = " =  ".$grupo;
        }
        if ($camp==0) {
            $camp =' > 0' ;
        } else {
            $camp = " =  ".$camp;
        }
        $strWhere = null;
        // if(!empty($_REQUEST['ficha']))
        //     $strWhere .= ' AND a.chave  = '.$_REQUEST['ficha'];
        // if(!empty($_REQUEST['ddd']))
        //     $strWhere .= ' AND a.ddd = '.$_REQUEST['ddd'];
        // if(!empty($_REQUEST['fone']))
        //     $strWhere .= ' AND a.fone = '.$_REQUEST['fone'];
        // if(!empty($_REQUEST['idlig']))
        //     $strWhere .= ' AND a.ID = '.$_REQUEST['idlig'];
        // if(!empty($_REQUEST['agente']))
        //     $strWhere .= ' AND a.id_agente = '.$_REQUEST['agente'];
        // if(!empty($_REQUEST['oper']))
        //     $strWhere .= ' AND a.id_operadora = '.$_REQUEST['oper'];
        // if(!empty($_REQUEST['camp']))
        //     $strWhere .= ' AND a.id_campanha = '.$_REQUEST['camp'];
        // if(!empty($_REQUEST['grupo']))
        //     $strWhere .= ' AND a.codgrupo = '.$_REQUEST['grupo'];
        // if(isset($arrPost['10segundos']) && $arrPost['10segundos'] == 1)
        //     $strWhere .= ' tempo_tarifado > 10';
        // if(!empty($ficha)){
        //     $strWhere = " and a.cdr_ficha = $ficha ";
        // }
        $query = "select a.dh_inicio,
                    a.ddr,
                        a.ddd,
                        a.telefone,
                        a.nome_finalizacao,
                    a.codagente,
                    a.nome_agente,
                                a.nome_grupo,
                            a.nome_campanha
                from relatreceptivo a
                WHERE a.DH_INICIO BETWEEN '".$dti."' AND '".$dtf."'
                    AND a.ddr > ''
            $strWhere";                     
        $sql = $this->dbdados2->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function tabulacaoDetalhe($dti, $dtf, $grupo,$camp, $agente, $ddd, $tel,$offset=0,$limit=20){
        $array = array();
        if ($grupo==0) {
            $grupo =' > 0' ;
        } else {
            $grupo = " =  ".$grupo;
        }
        if ($camp==0) {
            $camp =' > 0' ;
        } else {
            $camp = " =  ".$camp;
        }
        if ($tel == ''){
            $tel = '';
        }else{
            $tel = "and a.fone = ".$tel;
        }
        if ($ddd == 0){
            $ddd = '';
        }else{
            $ddd = "and a.ddd = ".$ddd;
        }
        if($agente == 0){
            $agente = "";
        }else{
            $agente = " and a.id_agente = ".$agente;
        }
        $query = "select a.id,
                a.dh_inicio,
                a.nome_operadora operadora,
                a.ddd,
                a.fone,
                a.chave,
                a.nome_direcao,
                a.nome_agente,
                        a.cod_agente,
                a.tempo_segundos,
                a.nome_tabulacao,
                a.nome_tipotabulacao,
                        a.nome_grupo,
                        a.nome_campanha
                from catalogogravacoes a where a.DH_INICIO between '$dti' and '$dtf' 
                and id_tabulacao > 0
                        and a.direcao = '1'
                        and a.id_grupo $grupo $agente $tel and a.id_campanha $camp $ddd 
                        LIMIT  " . $offset . "," . $limit."";

        $sql = $this->dbdados2->prepare($query);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;

    }
}
