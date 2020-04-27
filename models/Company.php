<?php
/**
* 
*/
class Company extends model
{
	private $companyInfo;
	function __construct($id)
	{
		parent::__construct();
		$sql = $this->db->prepare("SELECT * FROM companies where id = :id");
		$sql->bindValue(':id',$id);
		$sql->execute();
		if($sql->rowCount() > 0) {
			$this->companyInfo = $sql->fatch();
		}
	}

	public function getName() {
		if(isset($this->companyInfo['name'])) {
			return $this->companyInfo['name'];
		} else {
			return '';
		}
	}
}