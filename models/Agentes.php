<?php

/**
* 
*/
class Agentes extends model 
{
	
	private $agentesInfo;
	public function __construct()
	{
		parent::__construct();
	}

	public function agentesList($ativo=1) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM agentes where ativo = :ativo ORDER BY nome");
		$sql->bindValue(':ativo',$ativo);
		$sql->execute();
		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
        return $array;
	}
	public function getAgente($id) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM agentes where id = :id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$array = $sql->fetch();
        return $array;
	}

	public function getAgenteRamal($id) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM agentes where ramal = :id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$array = $sql->fetch();
        return $array;
	}
	
	public function addAgente($nome,$cpf,$ramal,$ativo,$senha,$login,$tiporamal,$localagente) {
		$sql = $this->dbdados->prepare('INSERT INTO agentes (nome,ramal,ativo,password,username,ID_TIPORAMAL,
		                             	ID_LOCALAGENTE, cpupdate,cpf) VALUES 
										(:nome,:ramal,:ativo,:senha,:logar,:tiporamal,:localagente,now(),:cpf)');
		$sql->bindValue(':nome',$nome);
		$sql->bindValue(':ramal',$ramal);
		$sql->bindValue(':ativo',$ativo);
		$sql->bindValue(':senha',$senha);
		$sql->bindValue(':logar',$login);
		$sql->bindValue(':tiporamal',$tiporamal);
		$sql->bindValue(':localagente',$localagente);
                $sql->bindValue(':cpf',$cpf);
		$sql->execute();
	}
	
	public function editAgente($id,$nome,$cpf,$ramal,$ativo,$senha,$login,$tiporamal,$localagente) {
		$sql = $this->dbdados->prepare("UPDATE agentes SET nome=:nome,ramal=:ramal,ativo=:ativo,
										password=:senha,username=:logar,ID_TIPORAMAL=:tiporamal,
										ID_LOCALAGENTE=:localagente, cpupdate=NOW(), cpf=:cpf WHERE id=:id");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':nome',$nome);
		$sql->bindValue(':ramal',$ramal);
		$sql->bindValue(':ativo',$ativo);
		$sql->bindValue(':senha',$senha);
		$sql->bindValue(':logar',$login);
		$sql->bindValue(':tiporamal',$tiporamal);
		$sql->bindValue(':localagente',$localagente);
                $sql->bindValue(':cpf',$cpf);
		$sql->execute();
	}

	public function statusGeral() {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT count(distinct codigo) as logados, 
										count(distinct case id_estado when 7 then codigo end) as ATENDENDO,
										count(distinct case id_estado when 1 then codigo end) as LIVRE,
										count(distinct case id_estado when 9 then codigo end) as PAUSADO,
										count(distinct case id_estado when 6 then codigo end) as TABULANDO
										FROM tb_infousuario");
		$sql->execute();
		$array = $sql->fetch();
        return $array;
	}

	public function gruposAgente($id) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT a.id_grupo,a.descricao,b.id_agente
		FROM grupo a left outer join grupo_agentes b on
										a.id_grupo=b.id_grupo and b.id_agente=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$array = $sql->fetchAll();
		//print_r($array);exit;
		return $array;
	}

	public function saveGruposAgente($id,$grupos) {
//		print_r($grupos);exit;
		$sql = $this->dbdados->prepare("DELETE FROM  grupo_agentes 
										WHERE id_agente=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
        $l = new Logs();
        $i = 0;
        foreach ($grupos as $gr) {
            $sql = $this->dbdados->prepare("INSERT INTO grupo_agentes (id_grupo,id_agente,cpupdate)
											VALUES (:grupo,:id,now())");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':grupo', $gr);
            $sql->execute();
        }
//		return $array;
	}

}