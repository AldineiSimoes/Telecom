<?php

class resumoController extends controller
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
        $r = new Regras();
        $o = new Operadoras();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATORIOS';
//  		if($u->hasPermission('supervisor')) {
                $this->loadTemplate('resumo',$data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
	}
}
