<?php

class campanhasCadastrosController extends controller
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
        $c = new Campanhas();
        $u->setLoggedUser();
        $data['user_name'] = $u->getName();
        $data['title'] = 'CAMPANHAS';
        $data['title2'] = 'CADASTRO';
//  		if($u->hasPermission('supervisor')) {
				$data['campanhas_list'] = $c->campanhaList();
                $this->loadTemplate('campanhasCadastros',$data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
	}
}
