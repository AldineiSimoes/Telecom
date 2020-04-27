<?php

/**
*
*/
class Campanhas extends model
{

	private $campanhaInfo;
	function __construct($id=0)
	{
		parent::__construct();
		$sql = $this->dbdados->prepare("SELECT * FROM campanha where id = :id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		if($sql->rowCount() > 0) {
			$this->campanhaInfo = $sql->fatch();
		}
	}

	public function campanhaList($user,$ativo=1) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM campanha a join campanha_usuario b on
		                                a.ID_CAMPANHA=b.ID_CAMPANHA
		                                where b.ID_USUARIO = :user
		                                and ATIVO = :ativo 
										ORDER BY CAMP_DESC");
		$sql->bindValue(':user',$user);
		$sql->bindValue(':ativo',$ativo);
		$sql->execute();
		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
        return $array;
	}
	public function getCampanha($id) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT * FROM campanha where ID_CAMPANHA=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$array = $sql->fetch();
        return $array;
	}
	public function addCampanha($desc,$dti,$dtf,$hri,$hrf,$ativo) {
		$array = array();
		$sql = $this->dbdados->prepare("INSERT INTO campanha (CAMP_DESC,CAMP_DT_INICIO,CAMP_DT_FIM,CAMP_HR_INICIO,CAMP_HR_FIM,ATIVO) VALUES (:descr,:dti,:dtf,:hri,:hrf,:ativo)");
		$sql->bindValue(':descr',$desc);
		$sql->bindValue(':dti',$dti);
		$sql->bindValue(':dtf',$dtf);
		$sql->bindValue(':hri',$hri);
		$sql->bindValue(':hrf',$hrf);
		$sql->bindValue(':ativo',$ativo);
		$sql->execute();
	}
	public function editCampanha($id,$desc,$dti,$dtf,$hri,$hrf,$ativo) {
		$array = array();
		$sql = $this->dbdados->prepare("UPDATE campanha SET CAMP_DESC=:descr,CAMP_DT_INICIO=:dti,CAMP_DT_FIM=:dtf,CAMP_HR_INICIO=:hri,CAMP_HR_FIM=:hrf,ATIVO=:ativo WHERE ID_CAMPANHA=:id");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':descr',$desc);
		$sql->bindValue(':dti',$dti);
		$sql->bindValue(':dtf',$dtf);
		$sql->bindValue(':hri',$hri);
		$sql->bindValue(':hrf',$hrf);
		$sql->bindValue(':ativo',$ativo);
		$sql->execute();
	}

	public function delete($id) {
		$array = array();
		$sql = $this->dbdados->prepare("DELETE FROM campanha where ID_CAMPANHA=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
	}

}