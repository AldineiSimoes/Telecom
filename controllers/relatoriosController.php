<?php

class relatoriosController extends controller
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
        $g = new Group();
        $s = new Supervisor();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATÓRIOS';
        $data['idgroup'] = '';
//  		if($u->hasPermission('supervisor')) {
                $data['group_list'] = $g->getList($u->getCompany());
                $this->loadTemplate('relatorios',$data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
	}
}