<?php

class homeController extends controller {

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
  	$company = new Company($u->getCompany());
  	$data['company_name'] = $company->getName();
  	$data['user_name'] = $u->getName();
  	$data['title'] = 'DASHBOARD';
  	$this->loadTemplate('home',$data);
  }
}

?>