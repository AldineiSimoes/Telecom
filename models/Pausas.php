<?php
class Pausas extends model {

	private $idPausa;

	public function __construct() {
		parent::__construct(); //executa o construtor da classe ancestral
    }

    public function getLista() {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT * FROM motivo_pausa');
        $sql->execute();
        // echo $sql->rowCount();exit;
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getPausa($id) {
        $array = array();
        $sql = $this->dbdados->prepare('SELECT * FROM motivo_pausa where id_motivopausa=:id');
		$sql->bindValue(':id',$id);
        $sql->execute();
        $array = $sql->fetch();
        return $array;
    }

    public function incluir($desc,$ativo) {
		$array = array();
		$sql = $this->dbdados->prepare("INSERT INTO motivo_pausa (mp_desc,ativo,cpupdate)
                                VALUES (:desc,:ativo,now())");
		$sql->bindValue(':desc',$desc);
		$sql->bindValue(':ativo',$ativo);
		$sql->execute();
	}
    
    public function editar($id,$desc,$ativo) {
		$array = array();
		$sql = $this->dbdados->prepare("UPDATE motivo_pausa 
                                        SET mp_desc=:desc
                                        ,ativo=:ativo
                                        ,cpupdate=now()
                                        WHERE id_motivopausa=:id");
		$sql->bindValue(':id',$id);
		$sql->bindValue(':desc',$desc);
		$sql->bindValue(':ativo',$ativo);
		$sql->execute();
	}
    public function delete($id) {
		$array = array();
		$sql = $this->dbdados->prepare("DELETE FROM motivo_pausa WHERE id_motivopausa=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
	}
}