<?php

class blackListController extends controller
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
        $data['title'] = 'BLACKLIST';
        $data['title2'] = 'BLACKLIST';
        //        if($u->hasPermission('Logs')) {
            $this->loadTemplate('blackList',$data);
        // } else {
        //     header("Location: ".BASE_URL);
        // }
    }
}
?>    