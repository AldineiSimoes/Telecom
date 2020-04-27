<?php
class Operadoras extends model {

	private $idOperadora;

	public function __construct() {
		parent::__construct(); //executa o construtor da classe ancestral
	}

	public function listOperadoras($ativo=1){
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM operadora where ATIVO=:ativo ORDER BY OPE_DESC");
		$sql->bindValue(':ativo',$ativo);
		$sql->execute();
		$array['ativo']=$ativo;
		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
        return $array;

	}

	public function getOperadora($id){
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM operadora WHERE ID_OPERADORA=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
   		$array = $sql->fetch();
   		$this->idOperadora = $id;
        return $array;

	}

	public function addOperadora($nome,$apelido,$host1,$host2,$tech,$canais,$csp,$cspLocal,$ativo,$ip,$area,$publica,$regraLocal,$regrLdn) {
		$array = array();
		$t = new Tarifas();
		try{
			$sql = $this->dbdados->prepare("INSERT INTO operadora (OPE_DESC,OPE_IP1,OPE_IP2,OPE_TECHPREFIX,
											OPE_CSP,OPE_MAXCANAIS,OPE_APELIDO,ATIVO,OPE_CSPCHAMADASLOCAIS,
											IP_SDP_OPE,PUBLICA_REDE_INTERNA,AREA_PRESTADORA,CPUPDATE) 
											VALUES (:nome,:host1,:host2,:tech,:csp,:canais,:apelido,
											:ativo,:csplocal,:ip,:publica,:areapub,now())");
			$sql->bindValue(':nome',$nome);
			$sql->bindValue(':apelido',$apelido);
			$sql->bindValue(':host1',$host1);
			$sql->bindValue(':host2',$host2);
			$sql->bindValue(':tech',$tech);
			$sql->bindValue(':canais',$canais);
			$sql->bindValue(':csp',$csp);
			$sql->bindValue(':csplocal',$cspLocal);
			$sql->bindValue(':ativo',$ativo);
			$sql->bindValue(':ip',$ip);
			$sql->bindValue(':areapub',$area);
			$sql->bindValue(':publica',$publica);
			$sql->execute();
			$sql = $this->dbdados->prepare("SELECT * from operadora WHERE OPE_DESC=:nome");
			$sql->bindValue(':nome',$nome);
			$sql->execute();
			$array = $sql->fetch();
			if (!empty($array)) {
			 	$sql = $this->dbdados->prepare("INSERT INTO tarifas_operadoras 
											(id_operadora,DataAlteracao,Nome_operadora)
											 VALUES 
											 (:id,now(),:nome)");
	  			$sql->bindValue(':nome',$array['OPE_DESC']);
	  			$sql->bindValue(':id',$array['ID_OPERADORA']);
				$sql->execute();
				$sql = $this->dbdados->prepare("SELECT MAX(ID) as COD from tarifas_operadoras");
				$sql->execute();
				$array = $sql->fetch();
				$t->editar($array['COD'],'','','','','','','','','','','','');
			}
			// echo 'INSERT INTO operadora (OPE_DESC,OPE_IP1,OPE_IP2,OPE_TECHPREFIX,
			//        OPE_CSP,OPE_MAXCANAIS,OPE_APELIDO,ATIVO,OPE_CSPCHAMADASLOCAIS,
			// IP_SDP_OPE,PUBLICA_REDE_INTERNA,AREA_PRESTADORA,CPUPDATE) VALUES ("'.
			// $nome.'","'.$host1.'","'.$host2.'","'.$tech.'","'.$csp.'","'.$canais.'","'.$apelido.'","'
			// .$ativo.'","'.$cspLocal.'","'.$ip.'","'.$publica.'","'.$area.'",now())';
		} catch (Exception $e) {
			echo 'Falha '.$e;
			exit;
		}
	}

	public function editOperadora($id,$nome,$apelido,$host1,$host2,$tech,$canais,$csp,$cspLocal,$ativo,$ip,$area,$publica,$regraLocal,$regrLdn) {
		$array = array();
//		/*
		$sql = $this->dbdados->prepare("UPDATE operadora SET OPE_DESC=:nome,OPE_IP1=:host1,OPE_IP2=:host2,OPE_TECHPREFIX=:tech,OPE_CSP=:csp,OPE_MAXCANAIS=:canais,OPE_APELIDO=:apelido,ATIVO=:ativo,OPE_CSPCHAMADASLOCAIS=:csplocal,IP_SDP_OPE=:ip,PUBLICA_REDE_INTERNA=:publica,AREA_PRESTADORA=:areapub,CPUPDATE=now() where ID_OPERADORA=:id");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':nome',$nome);
		$sql->bindValue(':apelido',$apelido);
		$sql->bindValue(':host1',$host1);
		$sql->bindValue(':host2',$host2);
		$sql->bindValue(':tech',$tech);
		$sql->bindValue(':canais',$canais);
		$sql->bindValue(':csp',$csp);
		$sql->bindValue(':csplocal',$cspLocal);
		$sql->bindValue(':ativo',$ativo);
		$sql->bindValue(':ip',$ip);
		$sql->bindValue(':areapub',$area);
		$sql->bindValue(':publica',$publica);
		$sql->execute();
//		*/
//		$sql = 'UPDATE operadora SET OPE_DESC="'.$nome.'",OPE_IP1="'.$host1.'",OPE_IP2="'.$host2.'",OPE_TECHPREFIX="'.$tech.'",OPE_CSP="'.$csp.			 '",OPE_MAXCANAIS="'.$canais.'",OPE_APELIDO="'.$apelido.'",ATIVO="'.$ativo.'",OPE_CSPCHAMADASLOCAIS="'.$cspLocal.'",IP_SDP_OPE="'.$ip.'",PUBLICA_REDE_INTERNA="'.$publica.'",AREA_PRESTADORA="'.$area.'",CPUPDATE=now() where ID_OPERADORA='.$id;
//		$this->db->query($sql);
//		echo $sql;
//		exit;
	}

	public function delOperadora($id) {
		$array = array();
		$sql = $this->dbdados->prepare("DELETE FROM operadora WHERE ID_OPERADORA=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
	}

	public function usoOperadoras(){
		$array = array();
		$sql = $this->dbdados->prepare("SELECT t.nomeoperadora operadora,
			t.ocupacaocanais ocupacao,
			o.OPE_MAXCANAIS-t.ocupacaocanais livres,
			o.OPE_MAXCANAIS qtdcanais
			FROM tb_infoop t
		         inner join operadora o on
				 o.OPE_DESC=t.nomeoperadora
				 where o.ATIVO=1 ORDER BY OPE_DESC");
		$sql->execute();
		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
        return $array;

	}	

	public function aproveitamentoOperadoras(){
		$array = array();
		$dt = date('Y-m-d');
		$sql = $this->dbdados->prepare("select b.OPE_DESC as OPERADORA, count(a.ID_CDR) as DISPAROS ,
										count(case 
										WHEN (a.ID_STFIM = 1001) or (a.ID_STFIM = 1011) then a.ID_CDR end) as COMPLETAMENTO,
										count(case  
										WHEN (a.ID_STFIM <> 1001) and (a.ID_STFIM <> 1011) then a.ID_CDR end) as NAO
										from cdr a join operadora b on
										a.ID_OPERADORA=b.ID_OPERADORA
										where a.CDR_DH_INICIO>='".$dt."'
										group by b.OPE_DESC");
		
		$sql->execute();
		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
        return $array;

	}	
}