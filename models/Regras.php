<?php
class Regras extends model {

	public function __construct() {
		parent::__construct(); //executa o construtor da classe ancestral
	}

	public function listRegras(){
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM regra_operadora a join operadora b on
										a.ID_OPERADORA=b.ID_OPERADORA
										where b.ATIVO=1
										ORDER BY REG_DESC");
		$sql->execute();
		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
        return $array;
	}

	public function getRegra($id){
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM regra_operadora WHERE ID_REGRAOPERADORA=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$array = $sql->fetch();
        return $array;
	}

	public function addRegra($desc,$dti,$dtf,$casas,$ativo,$idoperadora) {
		$array = array();
		$sql = $this->dbdados->prepare("INSERT INTO regra_operadora (REG_DESC,REG_INICIO,REG_FIM,REG_CASADECIMAL,ATIVO,ID_OPERADORA) VALUES (:descr,:dti,:dtf,:casas,:ativo,:idoperadora)");
		$sql->bindValue(':descr',$desc);
		$sql->bindValue(':dti',$dti);
		$sql->bindValue(':dtf',$dtf);
		$sql->bindValue(':casas',$casas);
		$sql->bindValue(':ativo',$ativo);
		$sql->bindValue(':idoperadora',$idoperadora);
		$sql->execute();
	}

	public function editRegra($id,$desc,$dti,$dtf,$casas,$ativo,$idoperadora) {
		$array = array();
		$sql = $this->dbdados->prepare("UPDATE regra_operadora SET REG_DESC=:descr,REG_INICIO=:dti,REG_FIM=dtf,REG_CASADECIMAL=:casas,ATIVO=:ativo,ID_OPERADORA=:idoperadora WHERE ID_REGRAOPERADORA=:id");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':descr',$desc);
		$sql->bindValue(':dti',$dti);
		$sql->bindValue(':dtf',$dtf);
		$sql->bindValue(':casas',$casas);
		$sql->bindValue(':ativo',$ativo);
		$sql->bindValue(':idoperadora',$idoperadora);
		$sql->execute();
	}

}