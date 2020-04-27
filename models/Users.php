<?php
class Users extends model {
    private $userInfo;
    private $permissions;

    public function __construct() {
        parent::__construct(); //executa o construtor da classe ancestral
    }

    public function isLogged() {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            return true;
        } else {
            return false;
        }
    }


    public function setNome($n) {
        $this->nome = $n;
    }

    public function doLogin($user,$pass) {
        $array = array();
        $sql = 'SELECT * FROM users where login="'.$user.'" and password="'.md5($pass).'"';
        //echo $sql;
        //exit;
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $_SESSION['ccUser'] =  $array['id'];
            return true;
        } else {
            return false;
        }
    }

    public function getCompany() {
        if(isset($this->userInfo['id_company'])) {
            return $this->userInfo['id_company'];
        } else {
            return 0;
        }
    }

    public function setLoggedUser() {
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            $id = $_SESSION['ccUser'];
            $sql = $this->db->prepare("SELECT * FROM users where id = :id");
            $sql->bindValue(':id',$id);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $this->userInfo = $sql->fetch();
                $this->permissions = new Permissions();
                $this->permissions->setGroup($this->userInfo['idgroup'],$this->userInfo['id_company']);
            }
        }
    }

    public function hasPermission($name) {
        return  $this->permissions->hasPermission($name);
    }

    public function getName() {
        if(isset($this->userInfo['login'])) {
            return $this->userInfo['login'];
        } else {
            return '';
        }
    }

    public function getId() {
        if(isset($this->userInfo['id'])) {
            return $this->userInfo['id'];
        } else {
            return 0;
        }
    }

    public function getInfo($id) {
        $array = array();
        $sql = $this->db->prepare('SELECT * FROM users where id=:id');
        $sql->bindValue(':id',$id);
        $sql->execute();
        $array = $sql->fetch();
        return $array;
    }

    public function logout() {
        unset($_SESSION['ccUser']);
    }

    public function findUsersinGroup($group) {
        $sql = $this->db->prepare('SELECT * FROM users where idgroup=:group');
        $sql->bindValue(':group',$group);
        $sql->execute();
        if($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function getList($id_company) {
        $array = array();
        $sql = $this->db->prepare("SELECT a.id,a.login,b.name FROM users a join permission_group b on a.idgroup=b.id where a.id_company = :id_company");
        $sql->bindValue(':id_company',$id_company);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function add($login,$password,$group,$usermon,$id_company){
        $sql = $this->db->prepare('SELECT COUNT(ID) as c FROM users WHERE login=:login');
        $sql->bindValue(':login',$login);
        $sql->execute();
        $row = $sql->fetch();
        if ($row['c'] == 0) {
            $sql = $this->db->prepare('INSERT INTO users SET login=:login,password=:pass,idgroup=:gr,userMon=:usermon,id_company=:id_company');
            $sql->bindValue(':login',$login);
            $sql->bindValue(':pass',md5($password));
            $sql->bindValue(':gr',$group);
            $sql->bindValue(':usermon',$usermon);
            $sql->bindValue(':id_company',$id_company);
            $sql->execute();
            return '1';
        } else {
            return '0';
        }
    }

    public function edit($id,$password,$group,$usermon,$id_company){
        $sql = $this->db->prepare('UPDATE users SET  idgroup=:group,userMon=:usermon WHERE id=:id');
        $sql->bindValue(':group',$group);
        $sql->bindValue(':id',$id);
        $sql->bindValue(':usermon',$usermon);
        $sql->execute();
        if (!empty($password)) {
            $sql = $this->db->prepare('UPDATE users SET  password=:password WHERE id=:id');
            $sql->bindValue(':password',md5($password));
            $sql->bindValue(':id',$id);
            $sql->execute();
        }
    }

    public function delete($id){
        $sql = $this->db->prepare('DELETE FROM users WHERE id=:id');
        $sql->bindValue(':id',$id);
        $sql->execute();
    }

    public function userCarteiras($id) {
		$array = array();
		$sql = $this->dbdados->prepare("SELECT a.ID_CAMPANHA,a.CAMP_DESC,b.ID_USUARIO
		FROM campanha a left outer join campanha_usuario b on
                                        a.ID_CAMPANHA=b.ID_CAMPANHA and b.ID_USUARIO=:id
                                    WHERE a.ATIVO=1");
		$sql->bindValue(':id',$id);
		$sql->execute();
		$array = $sql->fetchAll();
		//print_r($array);exit;
		return $array;
	}

	public function saveUserCarteiras($id,$camp) {
//		print_r($grupos);exit;
		$sql = $this->dbdados->prepare("DELETE FROM  campanha_usuario 
										WHERE ID_USUARIO=:id");
		$sql->bindValue(':id',$id);
		$sql->execute();
        $l = new Logs();
        $i = 0;
        foreach ($camp as $cp) {
            $sql = $this->dbdados->prepare("INSERT INTO campanha_usuario (ID_CAMPANHA,ID_USUARIO)
											VALUES (:camp,:id)");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':camp', $cp);
            // print_r($sql);exit;
            $sql->execute();
        }
//		return $array;
	}

}
?>