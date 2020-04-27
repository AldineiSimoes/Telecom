<?php
/**
* 
*/
class usersController extends controller
{
	
    public function __construct() {
        //parent::__construct();
        $user = new Users();
        if ($user->isLogged() == false) {
            header("Location: ".BASE_URL."/login");
        }
    }

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Agentes();
        $p = new Permissions();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'USUÁRIOS';
        if($u->hasPermission('users')) {
            $data['group_list'] = $p->getGroupList($u->getCompany());
            $data['agentes_list'] = $a->agentesList();
            $data['users_list'] = $u->getList($u->getCompany());
            $this->loadTemplate('users',$data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function add() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Agentes();
        if(isset($_POST['login']) && !empty($_POST['login'])) {
            $id = addslashes($_POST['usuario']);
            $login = addslashes($_POST['login']);
            $password = addslashes($_POST['password']);
            $group = addslashes($_POST['group']);
            $usermon = addslashes($_POST['usermon']);
            if ($id==0) {
                $m = $u->add($login,$password,$group,$usermon,$u->getCompany());
            } else{
                $m = $u->edit($id,$password,$group,$usermon,$u->getCompany());
            }
            $this->loadTemplate('users',$data);
        }
    }

    public function edit($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Company($u->getCompany());
        $data['user_info'] = $u->getInfo($id);
        echo json_encode($data);
    }

	public function delete($id) {
		$data = array();
	  	$u = new Users();
  		$u->setLoggedUser();
        $u->delete($id);
        $a = new Agentes();
        $p = new Permissions();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'USUÁRIOS';
        $data['group_list'] = $p->getGroupList($u->getCompany());
        $data['agentes_list'] = $a->agentesList();
        $data['users_list'] = $u->getList($u->getCompany());
        $this->loadTemplate('users',$data);
    }

    public function userCarteiras($id){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $c = new Campanhas();
        $data{'camp'} = $c->campanhaList($user);
        $data['user'] = $id;
        $data['userCamp'] =  $u->userCarteiras($id);
        $this->loadView('users_carteiras', $data);
    }

    public function saveUserCarteiras(){
        if (isset($_POST['camp']) && !empty($_POST['camp'])) {
            $u = new Users();
            $user = $_POST['user'];
            $camp = $_POST['camp'];
            $u->saveUserCarteiras($user, $camp);
        }
    }

}