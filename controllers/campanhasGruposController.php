<?php

class campanhasGruposController extends controller
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
        $data['user_name'] = $u->getName();
        $data['title'] = 'CAMPANHAS';
//  		if($u->hasPermission('supervisor')) {
                $this->loadTemplate('campanhasGrupos',$data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
	}
}
