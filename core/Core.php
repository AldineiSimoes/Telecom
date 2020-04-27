<?php

class Core  {

  private $currentController;
  private $currentAction;
  

  public function run() {
//   Comentada mode antetrior de fazer quando PHP_SELF esta habilitado
//  	$url = explode("index.php", $_SERVER['PHP_SELF']);
//  	$url = end($url);
    $url = '/'.((isset($_GET['q']))?$_GET['q']:'');  //if interno
  	$param = array();
  	if (!empty($url) && $url != '/') {
  		$url = explode('/', $url);
  		array_shift($url);
  		$currentController = $url[0].'Controller';
  		array_shift($url);
  		if (isset($url[0]) && !empty($url[0])) {
  			$currentAction = $url[0];
  			array_shift($url);
  		} else {
  			$currentAction = 'index';
  		}
  		if (count($url)>0) {
  			$param = $url;
  		}
  	} else {
  		$currentController = 'homeController';
  		$currentAction = 'index';
  	}

  	require_once 'core/controller.php';
  	$c = new $currentController();
  	call_user_func_array(array($c,$currentAction), $param);

  }

}

?>