<?php
class ajaxController extends controller {

	public function __construct() {
//        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
        	header("Location: ".BASE_URL."/login");
        	exit;
        }
    }


    /* Get the port for the WWW service. */
    private $service_port = 22000;

    /* Get the IP address for the target host. */
    private $address = '172.16.0.3';

    public function index(){}

    public function search_clients() {
    	$data = array();
    	$u = new Users();
        $u->setLoggedUser();
    	$c = new Clients();

    	if(isset($_GET['q']) && !empty($_GET['q'])) {
    		$q = addslashes($_GET['q']);

    		$clients = $c->searchClientByName($q, $u->getCompany());

    		foreach($clients as $citem) {
    			$data[] = array(
    				'name' => $citem['name'],
    				'link' => BASE_URL.'/clients/edit/'.$citem['id'],
                    'id'   => $citem['id']
    			);
    		}
    	}

    	echo json_encode($data);
    }

    public function get_city_list() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $c = new Cidade();

        if(isset($_GET['state']) && !empty($_GET['state'])) {
            $state = addslashes($_GET['state']);
            $data['cities'] = $c->getCityList($state);
        }

        foreach($data['cities'] as $cityk => $city) {
            $data['cities'][$cityk]['Nome'] = utf8_encode($city['Nome']);
            $data['cities'][$cityk]['0'] = utf8_encode($city['0']);
        }

        $json = json_encode($data);


        echo $json;
    }

    public function search_products() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $i = new Inventory();

        if(isset($_GET['q']) && !empty($_GET['q'])) {
            $q = addslashes($_GET['q']);
            $data = $i->searchProductsByName($q, $u->getCompany());
        }

        echo json_encode($data);
    }

    public function add_client() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $c = new Clients();

        if(isset($_POST['name']) && !empty($_POST['name'])) {
            $name = addslashes($_POST['name']);

            $data['id'] = $c->add($u->getCompany(), $name);
        }

        echo json_encode($data);
    }

    public function listMonitor(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $s = new Supervisor();
        if(isset($_POST['a'])) {
            $data['idgroup'] = addslashes($_POST['a']);
            $group = addslashes($_POST['a']);
            $data['users'] = $s->listUsers($group);
        }

        echo json_encode($data);
    }

    public function listRecords() {
        $data = array();
        $data1 = array();
        $u = new Users();
        $u->setLoggedUser();
        $g = new Group();
        $a = new Agentes(0);
        $c = new Campanhas(0);
        $d = new Diversos();
        if (isset($_POST['data_inicio']) && !empty($_POST['data_inicio'])){
            $offset = 0;
            $dti = addslashes($_POST['data_inicio']).' 00:00:00';
            $dtf = addslashes($_POST['data_fim']).' 23:59:39';
            $oper = 0;
            $camp =0;
            $agente = 0;
            $ddd = 0;
            $tel = 0;
            if(isset($_POST['oper']) && $_POST['oper']>0){
                $oper = addslashes($_POST['oper']);
            }
            if(isset($_POST['camp']) && $_POST['camp']>0){
                $camp = addslashes($_POST['camp']);
            }
            if(isset($_POST['agents']) && $_POST['agents']>0){
                $agente = addslashes($_POST['agents']);
            }
            if(isset($_POST['ddd']) && $_POST['ddd']!=''){
                $ddd = addslashes($_POST['ddd']);
            }
            if(isset($_POST['fone']) && $_POST['fone']!=''){
                $tel = addslashes($_POST['fone']);
            }
            $data['p'] = 1;
            if(isset($_POST['p']) && !empty($_POST['p'])) {
                $data['p'] = intval($_POST['p']);
                if($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = ( 25 * ($data['p']-1));
            $data['p_count'] = $d->searchRecords($dti,$dtf,$oper,$camp,$agente,$ddd,$tel,-1);
            $data['record_list'] = $d->searchRecords($dti,$dtf,$oper,$camp,$agente,$ddd,$tel,$offset);
            $data['idgrav'] = '1';
        }
//        print_r($data);exit;
        echo json_encode($data);
    }

    public function conectaPlataforma(){
  //       Create a TCP/IP socket.
        $address = SOCKET_SERVER;
        $service_port = SOCKET_PORT;
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
        } else {

        }

        $result = socket_connect($socket, $address, $service_port);
        if ($result === false) {
            echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        $out = socket_read($socket, 2048) ;
    }

    public function monitorarRamal(){
//        conectaPlataforma();
        $address = SOCKET_SERVER;
        $service_port = SOCKET_PORT;
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $u = new Users();
        if ($socket === false) {
            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
        } else {

        }

        $result = socket_connect($socket, $address, $service_port);
        if ($result === false) {
            echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
        }
        $id = '';   
        $out = socket_read($socket, 2048) ;
        $idempresa = $_POST['id_empresa'];
        $agente = $_POST['monitorado'];
        $agente_monitor = $_SERVER['REMOTE_ADDR'];
        $iddac = $_POST['idgrupodac'];
        $tipomon = $_POST['tpmon'];
        if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
            $id = $_SESSION['ccUser'];
        }
        $users = $u->getInfo($id);
        $usermon = $users['userMon'];
        $in = "monitorar(1;$iddac;$idempresa;;$usermon;1)\r\n";
        socket_write($socket, $in, strlen($in));
        echo $in.'<br>';
        $in = "monitorar(1;$iddac;$idempresa;$agente;$usermon;1)\r\n";
//        echo $in;exit;
        socket_write($socket, $in, strlen($in));
        echo $in.'<br>';

        //echo "Reading response:\n\n";
        $read = socket_read($socket, 2048) ;
        echo $read.'<br>';
        //echo "Closing socket...";
        socket_close($socket);

        //echo $out;
        $resposta=explode(';', $read);
        echo $resposta[6];
    }

    public function despausarRamal(){
//        conectaPlataforma();
        $address = SOCKET_SERVER;
        $service_port = SOCKET_PORT;
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
        } else {

        }

        $result = socket_connect($socket, $address, $service_port);
        if ($result === false) {
            echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        $out = socket_read($socket, 2048) ;
        $agente = $_POST['agente'];

        $in = "despausar($agente)\r\n";
        socket_write($socket, $in, strlen($in));

        //echo "Reading response:\n\n";
        $read = socket_read($socket, 2048) ;

        //echo "Closing socket...";
        socket_close($socket);

        //echo $out;
        $resposta=explode(';', $read);
        echo $resposta[6];
    }

    public function deslogarRamal(){
//        conectaPlataforma();
        $address = SOCKET_SERVER;
        $service_port = SOCKET_PORT;
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
        } else {

        }

        $result = socket_connect($socket, $address, $service_port);
        if ($result === false) {
            echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        $out = socket_read($socket, 2048) ;
        $agente = $_POST['agente'];

        $in = "deslogar($agente)\r\n";
        socket_write($socket, $in, strlen($in));

        //echo "Reading response:\n\n";
        $read = socket_read($socket, 2048) ;

        //echo "Closing socket...";
        socket_close($socket);

        //echo $out;
        $resposta=explode(';', $read);
        echo $resposta[6];
    }

    public function playRecord() {
        $data = array();
        $id = $_POST['id'];
        $r = new Diversos();
        $row = $r->getRecord($id);
        $path = $row['caminhoaudio'];
        $path = str_replace('#','/',$path);
        $audio = $row['arquivoaudio'];
        $audio = 'http://'.SOCKET_SERVER.'/gravacao/'.$path.$audio;
        $audioWAV = str_replace('.AGG', '.WAV', strtoupper($audio));
        $audio = $audioWAV;

        echo $audio;
    }

    public function getOperadora(){
    	$data = array();
        if (isset($_POST['id']) && !empty($_POST['id'])){
        	$id = addslashes($_POST['id']);
        	$o = new Operadoras();
        	$data['operadora'] = $o->getOperadora($id);
        }

        echo json_encode($data);
    }

    public function saveOperadora() {
    	$data = array();
    	$id = -1;
    	if(isset($_POST['idoper'])) {
    		$id = addslashes($_POST['idoper']);
    		$nome = addslashes($_POST['nome']);
    		$apelido = addslashes($_POST['apelido']);
    		$host1 = addslashes($_POST['host1']);
    		$host2 = addslashes($_POST['host2']);
    		$tech = addslashes($_POST['tech']);
    		$canais = addslashes($_POST['canais']);
    		$csp = addslashes($_POST['csp']);
    		$cspLocal = addslashes($_POST['csplocal']);
    		$ativo = addslashes($_POST['ativo']);
    		$ip = addslashes($_POST['ip']);
    		$area = addslashes($_POST['area']);
    		$publica = addslashes($_POST['publica']);
    		$regraLocal = addslashes($_POST['regralocal']);
    		$regraLdn = addslashes($_POST['regraldn']);
        	$o = new Operadoras();
        	if($id==0) {
        		$o->addOperadora($nome,$apelido,$host1,$host2,$tech,$canais,$csp,$cspLocal,$ativo,$ip,$area,$publica,$regraLocal,$regraLdn);
        	} else {
         		$o->editOperadora($id,$nome,$apelido,$host1,$host2,$tech,$canais,$csp,$cspLocal,$ativo,$ip,$area,$publica,$regraLocal,$regraLdn);
        	}
    	}

        
    }

    public function getDial(){
    	$data = array();
    	$s = new Supervisor();
        if (isset($_POST['q']) && !empty($_POST['q'])){
        	$idgr = $_POST['q'];
        	$data['resDial'] = $s->getDial($idgr);
        }

        echo json_encode($data);
    }

    public function selOperadoras(){
    	$data = array();
    	$o = new Operadoras();
    	$data['listOperadoras'] = '';
        if (isset($_POST['ativo']) && !empty($_POST['ativo'])){
        	$ativo = $_POST['ativo'];
        	if($ativo=='2'){$ativo='0';}
        	$data['listOperadoras'] = $o->listOperadoras($ativo);
        }

        echo json_encode($data);

    }

	public function selAgents(){
    	$data = array();
    	$a = new Agentes();
    	$data['listAgents'] = '';
        if (isset($_POST['ativo']) && !empty($_POST['ativo'])){
        	$ativo = $_POST['ativo'];
        	if($ativo=='2'){$ativo='0';}
        	$data['listAgents'] = $a->agentesList($ativo);
        }

        echo json_encode($data);

    }

    public function getCadencia(){
    	$data = array();
        if (isset($_POST['id']) && !empty($_POST['id'])){
        	$id = addslashes($_POST['id']);
        	$c = new Cadencia();
        	$data['cadencia'] = $c->getCadencia($id);
        }

        echo json_encode($data);
    }

    public function saveCadencia() {
    	$data = array();
    	$id = -1;
    	if(isset($_POST['idoper'])) {
    		$id = addslashes($_POST['idoper']);
    		$desc = addslashes($_POST['descCadencia']);
    		$ativo = addslashes($_POST['ativoCadencia']);
        	$c = new Cadencia();
        	if($id==0) {
        		$c->addCadencia($desc,$ativo);
        	} else {
         		$c->editCadencia($id,$desc,$ativo);
        	}
    	}

        echo $id;

    }
    public function delCadencia(){

    }
    public function getRegra(){
        $data = array();
        if (isset($_POST['id']) && !empty($_POST['id'])){
            $id = addslashes($_POST['id']);
            $r = new Regras();
            $data['regra'] = $r->getRegra($id);
        }

        echo json_encode($data);
    }

    public function saveRegra() {
        $data = array();
        $id = -1;
        if(isset($_POST['idoper'])) {
            $id = addslashes($_POST['idoper']);
            $desc = addslashes($_POST['descrRegra']);
            $dti = addslashes($_POST['dtiRegra']);
            $dtf = addslashes($_POST['dtfRegra']);
            $casas = addslashes($_POST['casasRegra']);
            $ativo = addslashes($_POST['ativoRegra']);
            $idoperadora = addslashes($_POST['operadoraRegra']);
            $r = new Regras();
            if($id==0) {
                $r->addRegra($desc,$dti,$dtf,$casas,$ativo,$idoperadora);
            } else {
                $r->editRegra($id,$desc,$dti,$dtf,$casas,$ativo,$idoperadora);
            }
        }

        echo $id;

    }
    public function delRegra(){

    }

    public function getTarifas(){
        $data = array();
        if (isset($_POST['id']) && !empty($_POST['id'])){
            $id = addslashes($_POST['id']);
            $t = new Tarifas();
            $data['tarifas'] = $t->getTarifa($id);
        }
        echo json_encode($data);
    }

    public function saveTarifas() {
        $data = array();
        $id = -1;
        if(isset($_POST['idoper'])) {
            $id = addslashes($_POST['idoper']);
            $desc = addslashes($_POST['descCadencia']);
            $ativo = addslashes($_POST['ativoCadencia']);
            $c = new Cadencia();
            if($id==0) {
                $c->addCadencia($desc,$ativo);
            } else {
                $c->editCadencia($id,$desc,$ativo);
            }
        }

        echo $id;

    }
}
















