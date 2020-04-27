<?php

/**
 * 
 */
class Diversos extends model {

    private $diversosInfo;

    function __construct() {
        parent::__construct();
    }

    public function searchRecords($dti, $dtf, $operacao, $camp, $agente, $ddd, $tel, $offset,$limit) {
        $array = array();
        $r = 0;
        $cond = '';
        if ($operacao > 0) {
            $cond .= ' AND direcao=' . $operacao;
        }
        if ($camp > 0) {
            $cond .= ' AND id_campanha=' . $camp;
        }
        if ($agente > 0) {
            $cond .= ' AND id_agente=' . $agente;
        }
        if ($ddd != '') {
            $cond .= ' AND ddd="' . $ddd.'"';
        }
        if ($tel != '') {
            $cond .= ' AND fone=' . $tel;
        }
        // echo "SELECT COUNT(id) as c FROM catalogogravacoes where dh_inicio >= '".$dti."' and dh_inicio <= '".$dtf."' " . $cond . " ORDER BY dh_inicio ";
        if ($offset == -1) {
            $sql = $this->dbdados2->prepare("SELECT COUNT(id) as c FROM catalogogravacoes where dh_inicio >= :dti and dh_inicio <= :dtf " . $cond . " ORDER BY dh_inicio ");
            $sql->bindValue(':dti', $dti);
            $sql->bindValue(':dtf', $dtf);
            $sql->execute();
            $row = $sql->fetch();
            $r = $row['c'];
            return $r;
        } else {
            $total = $limit;
        // echo "SELECT *," . $r . " as total FROM catalogogravacoes where dh_inicio >= '".$dti."' and dh_inicio <= '".$dtf."' " . $cond . " ORDER BY dh_inicio LIMIT " . $offset . ",".$total;
            $sql = $this->dbdados2->prepare("SELECT *," . $r . " as total FROM catalogogravacoes where dh_inicio >= :dti and dh_inicio <= :dtf " . $cond . " ORDER BY dh_inicio LIMIT " . $offset . ",".$total);
            $sql->bindValue(':dti', $dti);
            $sql->bindValue(':dtf', $dtf);
            $sql->execute();
            //		print_r($sql);exit;
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            // } else {
            //     $array = $sql->fetch();
            }
            // print_r($array);
            return $array;
        }
    }

    public function getRecord($id) {
        $array = array();
        $sql = $this->dbdados2->prepare("SELECT * FROM catalogogravacoes where id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }

    public function listModalidades($ativo = 1) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM modalidade where ATIVO = :ativo");
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function listLocalAgente($ativo = 1) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM local_agente where ATIVO = :ativo");
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function listTipoRamal($ativo = 1) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM tipo_ramal where ATIVO = :ativo");
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function listTipoOperacao($ativo = 1) {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM tipo_operacao where ATIVO = :ativo");
        $sql->bindValue(':ativo', $ativo);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function cdrLigacoesResumo($dti, $dtf, $tpoper, $camp, $agente, $operadora, $ddd, $tel) {
        $array = array();
        $cond = '';
        if ($camp > 0) {
            $cond .= ' AND ID_CAMPANHA=' . $camp;
        }
        if ($agente > 0) {
            $cond .= ' AND ID_AGENTE=' . $agente;
        }
        if ($operadora > 0) {
            $cond .= ' AND ID_OPERADORA=' . $operadora;
        }
        if ($ddd != '') {
            $cond .= ' AND ddd=' . $ddd;
        }
        if ($tel != '') {
            $cond .= " AND CDR_FONE='" . $tel . "'";
        }
        $sql = "SELECT sf.STF_DESC,
                COUNT(a.ID_CDR) as Total,
                a.id_grupo,
                IF(a.TAR_VALOR>0, 1, 0) as NUMERO
                FROM cdr a
                LEFT JOIN st_fim sf ON a.ID_STFIM = sf.ID_STFIM
                WHERE   a.CDR_DH_INICIO BETWEEN '".$dti."' AND '".$dtf."'
                AND a.id_tipooperacao = ".$tpoper."
                AND a.id_stfim <> 1029
                $cond
                GROUP BY sf.STF_DESC, IF(a.TAR_VALOR>0, 1, 0)";
        // echo $sql;exit;
        $sql = $this->dbdados2->query($sql);
        $array = $sql->fetchAll();
        return $array;
    }

    public function cdrLigacoesDetalhe($dti, $dtf, $tpoper, $camp, $agente, $operadora, $ddd, $tel) {
        $array = array();
        $cond = '';
        if ($camp > 0) {
            $cond .= ' AND a.ID_CAMPANHA=' . $camp;
        }
        if ($agente > 0) {
            $cond .= ' AND a.ID_AGENTE=' . $agente;
        }
        if ($operadora > 0) {
            $cond .= ' AND a.ID_OPERADORA=' . $operadora;
        }
        if ($ddd != '') {
            $cond .= ' AND ddd=' . $ddd;
        }
        if ($tel != '') {
            $cond .= " AND a.cdr_fone='" . $tel . "'";
        }
        // $sql = "SELECT
        //         case when a.CDR_DH_AT_RAMAL<>'0000-00-00 00:00:00'
        //             then a.cdr_dh_at_ramal else '-'
        //         end atendimentoramal,
        //         case when a.CDR_DH_AT_PUBLICA<>'0000-00-00 00:00:00'
        //             then a.cdr_dh_at_publica else '-'
        //         end atendimentopublica,
        //         a.id_cdr,a.cdr_dh_inicio,cdr_dh_fimligacao,
        //         o.ope_desc as operadora,d.ddd_numero,a.cdr_fone,a.cdr_chave as chave,ori.origem_desc,
        //         m.mod_desc,s.stf_desc,sip.SIP_CODIGO,ag.ramal as ramal,ag.nome as agente,ag.cpf,
        //         g.descricao,cdr_tempofalado,a.tar_valor
        //         from cdr a
        //         inner join st_fim s on a.id_stfim = s.id_stfim
        //         inner join grupo g on a.id_grupo = g.id_grupo
        //         left outer join agentes ag on a.id_agente = ag.id
        //         inner join modalidade m on a.id_modalidade = m.id_modalidade
        //         inner join operadora o on a.id_operadora = o.id_operadora
        //         inner join origem ori on a.id_origem = ori.id_origem
        //         inner join ddd d on a.id_ddd=d.id_ddd
        //         inner join diacdr di on a.id_diacdr = di.id_diacdr
        //         left outer join st_sip sip on a.ID_STSIP = sip.ID_STSIP
        //         where A.cdr_dh_inicio between '" . $dti . "' and '" . $dtf . "'
        //         and a.id_tipooperacao = " . $tpoper . " and s.ativo=1"
        //         . $cond . " LIMIT 100000";
        $sql = "select
            IFNULL( a.ID_CDR , 'nulo') as ID,
            IFNULL(a.CDR_DH_INICIO, 'nulo') as DATA,
            IFNULL(o.ope_desc,'nulo') as OPERADORA,
            IFNULL(d.ddd_numero , 'nulo') as DDD,
            IFNULL(a.CDR_FONE , 'nulo') as FONE,
            IFNULL(ori.origem_desc , 'nulo') as ORIGEM,
            IFNULL(m.mod_desc , 'nulo') as TIPO,
            IFNULL(s.stf_desc , 'nulo') as FINALIZACAO,
            IFNULL(ag.ramal , 'nulo') as RAMAL,
            IFNULL(ag.nome , 'nulo') as AGENTE,
            IFNULL(ag.cpf , 'nulo') as CPF,
            IFNULL(g.descricao , 'nulo') as GRUPO,
            IFNULL(a.CDR_FICHA , 'nulo') as CONTRATO,
            CASE 
                WHEN a.CDR_CHAVE = '' THEN 'MANUAL' 
                WHEN a.ID_STFIM = '1017' THEN 'MANUAL' 
                ELSE 'DISCADOR' 
            END AS Origem_Ligacao,
            IFNULL(cdr_tempofalado , 'nulo') as DURACAO,
            case 
                when a.CDR_DH_AT_PUBLICA<>'0000-00-00 00:00:00' then a.cdr_dh_at_publica 
                else '-'  
            end as  AT_PUBLICA,
            case 
                when a.CDR_DH_AT_RAMAL<>'0000-00-00 00:00:00' then a.cdr_dh_at_ramal 
                else '-' 
            end as AT_RAMAL,
            IFNULL(a.CDR_DH_FIMLIGACAO , 'nulo') as FIM_LIGACAO,s.STF_CODIGO
            FROM cdr a
            left join st_fim s on a.ID_STFIM = s.ID_STFIM
            left join grupo g on a.id_grupo = g.id_grupo
            left join agentes ag on a.id_agente = ag.id
            left join modalidade m on a.id_modalidade = m.id_modalidade
            left join operadora o on a.id_operadora = o.id_operadora
            left join origem ori on a.id_origem = ori.id_origem
            left join ddd d on a.id_ddd=d.id_ddd
            left join diacdr di on a.id_diacdr = di.id_diacdr
            WHERE a.id_tipooperacao = '".$tpoper."'
            AND a.CDR_DH_INICIO BETWEEN '".$dti."' AND '".$dtf."'
            AND a.id_stfim <> 1029
            $cond";
        try {
            $sql = $this->dbdados2->query($sql);
            $array = $sql->fetchAll();
        } catch (Exceptin $e) {
            echo 'Erro :' . $e->getMessage(), "\n";
        }
        return $array;
    }

    public function resumoLig($dti, $dtf, $grupo, $ddd) {
        $array = array();
        $grupo = ' > 0';
        if ($grupo > 0) {
            $grupo = ' = ' . $camp;
        }
        if ($ddd != '') {
            $cond .= ' AND ddd=' . $ddd;
        }
        // $sql = "SELECT 
        //             a.ddd,
        //             DATE_FORMAT(MIN(a.dh_at_publica), '%d/%m/%Y %H:%i') PRIMEIRO_ATT,
        //             DATE_FORMAT(MAX(a.dh_at_publica), '%d/%m/%Y %H:%i') ULTIMO_ATT,
        //             COUNT(A.id) QTDE,
        //             SEC_TO_TIME(SUM(A.tempo_ligacao)) TEMPO,
        //             CONCAT('R$ ',
        //                     REPLACE(REPLACE(REPLACE(FORMAT(SUM(A.valor_ligacao), 2),
        //                                 '.',
        //                                 '|'),
        //                             ',',
        //                             '.'),
        //                         '|',
        //                         ',')) VALOR
        //         FROM
        //             catalogobilhetes a
        //         WHERE
        //             A.valor_tarifa > 0 AND a.id_grupo $grupo
        //                 AND a.dh_at_publica BETWEEN  '$dti' and '$dtf'
        //                 AND A.DDD > 0
        //         GROUP BY A.DDD";
        $sql = "select
                CASE
                WHEN
                a.DDD  IS NULL THEN 'TOTAL'
                else a.DDD
                END DDD,
                DATE_FORMAT(min(a.dh_at_publica), '%d/%m/%Y %H:%i')  PRIMEIRO_ATT,
                DATE_FORMAT(max(a.dh_at_publica), '%d/%m/%Y %H:%i') ULTIMO_ATT ,
                COUNT(A.ID) QTDE,
                SEC_TO_TIME(SUM(a.tempo_tarifado)) TEMPO,
                Concat('R$ ',Replace(Replace(Replace(Format(SUM(a.valor_ligacao), 2), '.', '|'), ',', '.'), '|', ','))
                VALOR
                from catalogobilhetes a WHERE
                a.DH_INICIO between '$dti' and '$dtf'
                and a.id_grupo $grupo
                GROUP BY A.DDD ";        
        try {
//            echo $sql;exit; 
            $sql = $this->dbdados2->query($sql);
            $array = $sql->fetchAll();
        } catch (Exceptin $e) {
            echo 'Erro :' . $e->getMessage(), "\n";
        }
        return $array;
    }

    public function listServidores() {
        $array = array();
        $sql = $this->dbdados->prepare("SELECT * FROM servidor");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function resumoOperacional($dti, $dtf, $oper, $camp, $agente){
        $array = array();
        $cond = '';
        if ($camp > 0) {
            $cond .= ' AND src.idcampanha=' . $camp;
        } else {
            $cond .= " AND src.CodGrupo = 'DIA' ";
        }
        if ($agente > 0) {
            $cond .= ' AND src.idagente=' . $agente;
        }
        $sql = "select  
                    DATE_FORMAT(src.Datadia, '%d/%m/%Y') dia,
                    src.NomeUsuario as nome,
                    src.Usuario as username,
                    src.LogonInicio as primeiroatt,
                    src.LogonFim as ultimoatt,
                    src.LogonInicio as logon,
                    SEC_TO_TIME(TempoLogado) tplogado,
                    SEC_TO_TIME(src.tempolivre) as livre,
                    src.qtdtotalatendidas as atendidas,
                    SEC_TO_TIME(src.tempofaladonogrupo) as falado,
                    SEC_TO_TIME(TempoMedioAtendimentoGrupo) TMA,
                    SEC_TO_TIME(TMEGeral) TME,
                    src.LogonFim as logout,
                    SEC_TO_TIME(src.TempoPausas) as tempopausas,
                    src.QtdPausas as qtdpausas,
                    src.QtdAtendidasReceptivo as QtdAtendidasReceptivo,
                    src.QtdAtendidasAtivomanual as QtdAtendidasAtivomanual,
                    src.QtdAtendidasAtivoDiscador as QtdAtendidasAtivoDiscador,
                    SEC_TO_TIME(tempoclerical) as tempo_clerical,
                    1 as nop
                from resumooperacional src
                where src.LogonInicio between '" . $dti . "' and '" . $dtf . "' ". $cond .
                " GROUP BY src.Datadia, src.Usuario";
                " ORDER BY src.Datadia, src.Usuario";
        try {
            $sql = $this->dbdados2->query($sql);
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
        } catch (Exceptin $e) {
            echo 'Erro :' . $e->getMessage(), "\n";
        }
        return $array;
    }

}
