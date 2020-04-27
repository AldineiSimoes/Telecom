<?php

class regrasController extends controller
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
        $data['title'] = 'OPERADORAS';
//  		if($u->hasPermission('supervisor')) {
        	$data['regras_list'] = $r->listRegras();
                $data['operadoras_list'] = $o->listOperadoras();
                $this->loadTemplate('regras',$data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
	}

        public function delete($id){
                header("Location: ".BASE_URL."/regras");

        }
}
