<?php

/* 
 */
class Group extends model {
    public function getList($ativo = 1) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT * FROM grupo WHERE ativo=:ativo ORDER BY id_grupo');
        $sql->bindValue(':ativo',$ativo);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getGroup($idgroup,$id_company = 0) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT * FROM grupo WHERE id_grupo=:gr ');
        $sql->bindValue(':gr',$idgroup);
        $sql->execute();
        $array = $sql->fetch();
        return $array;
    }

    public function groupList($ativo=1) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT descricao FROM grupo WHERE ativo=:ativo ORDER BY id_grupo');
        $sql->bindValue(':ativo',$ativo);
        $sql->execute();
        $array = $sql->fetchAll();
        return $array;
    }

    public function add($nome,$campanha,$clerical,$filamax,$ativo) {
        $sql = $this->dbdados->prepare('INSERT INTO grupo (descricao,maxfila,tpclerical,ativo,ID_CAMPANHA) VALUES (:nome,:filamax,:clerical,:ativo,:campanha)');
        $sql->bindValue(':nome',$nome);
        $sql->bindValue(':campanha',$campanha);
        $sql->bindValue(':clerical',$clerical);
        $sql->bindValue(':filamax',$filamax);
        $sql->bindValue(':ativo',$ativo);
        $sql->execute();
    }

    public function edit($id,$nome,$campanha,$clerical,$filamax,$ativo) {
        $sql = $this->dbdados->prepare('UPDATE grupo SET descricao=:nome,maxfila=:filamax,tpclerical=:clerical,ativo=:ativo,ID_CAMPANHA=:campanha WHERE id_grupo=:id');
        $sql->bindValue(':id',$id);
        $sql->bindValue(':nome',$nome);
        $sql->bindValue(':campanha',$campanha);
        $sql->bindValue(':clerical',$clerical);
        $sql->bindValue(':filamax',$filamax);
        $sql->bindValue(':ativo',$ativo);
        $sql->execute();
    }

    public function delete($id) {
        $sql = $this->dbdados->prepare('DELETE FROM grupo WHERE id_grupo=:id ');
        $sql->bindValue(':id',$id);
        $sql->execute();
    }

    public function getGrupoCampanha($idcamp) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT * FROM grupo WHERE ID_CAMPANHA=:idcamp AND ativo=:ativo ORDER BY id_grupo');
        $sql->bindValue(':ativo','1');
        $sql->bindValue(':idcamp',$idcamp);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function agentesGrupo($id) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT a.id,a.nome,b.id_grupo
		FROM agentes a left outer join grupo_agentes b on
										a.id=b.id_agente and b.id_grupo=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$array = $sql->fetchAll();
		//print_r($array);exit;
		return $array;
	}

	public function saveGruposAgente($agentes,$grupo) {
//		print_r($grupos);exit;
		$sql = $this->dbdados->prepare("DELETE FROM  grupo_agentes 
										WHERE id_grupo=:grupo");
		$sql->bindValue(':grupo',$grupo);
		$sql->execute();
        $l = new Logs();
        $i = 0;
        foreach ($agentes as $a) {
            $sql = $this->dbdados->prepare("INSERT INTO grupo_agentes (id_grupo,id_agente,cpupdate)
											VALUES (:grupo,:id,now())");
            $sql->bindValue(':id', $a);
            $sql->bindValue(':grupo', $grupo);
            $sql->execute();
        }
//		return $array;
	}

}
