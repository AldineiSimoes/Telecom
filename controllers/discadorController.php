<?php

class discadorController extends controller {

    public $idDiscador;

    public function __construct() {
        //parent::__construct();
        $user = new Users();
        if ($user->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
        }
    }
    

    public function index() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $g = new Group();
        $s = new Supervisor();
        $d = new Diversos();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = '';
        $data['idgroup'] = '';
        if ($u->hasPermission('Discadores')) {
            $data['group_list'] = $g->getList($u->getCompany());
            $data['server_list'] = $d->listServidores();
            $this->loadTemplate('discador', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function discadores() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $d = new Discadores();
        $c = new Campanhas();
        $e = new Diversos();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'CADASTRO';
//  		if($u->hasPermission('supervisor')) {
        $data['discadores_list'] = $d->getList();
        $data['campanha_list'] = $c->campanhaList($user);
        $data['server_list'] = $e->listServidores();
        $this->loadTemplate('discadores', $data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }

    public function getDiscador($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $data['discador'] = $d->getDiscador($id);
        echo json_encode($data);
    }

    public function uploading() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'ENVIAR MAILING';
//  		if($u->hasPermission('supervisor')) {
        $data['discadores_list'] = $d->getList();
        $this->loadTemplate('uploading_discador', $data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }

    public function discadoresList() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $company = new Company($u->getCompany());
        $ativo = $_POST['param'];
        $data['discadores_list'] = $d->getList($ativo);
        $this->loadView('discadoresLista', $data);
    }

    public function parametrosDisacador() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'PARÂMETROS';
//  		if($u->hasPermission('supervisor')) {
        $data['discadores_list'] = $d->getList();
        $this->loadTemplate('parametrosDiscador', $data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }

    public function saveParametros() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $id = $_POST['parametro'];
        $valor = $_POST['valor'];
        $d->saveParametros($id, $valor,$u->getName());
    }

    public function periodoDiscador() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'PERÍODO';
//  		if($u->hasPermission('supervisor')) {
        $data['discadores_list'] = $d->getList();
        $data['lista_periodos'] = $d->getPeriodosCadastrados();
        $this->loadTemplate('periodoDiscador', $data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }
    
    
    public function savePeriodoDiscador(){
        $dias = $_POST['dias'];
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $d->asocPeriodoDisc($_POST['periodosel'], $dias, $_POST['idDiscadorPeriodo'], $_POST['grupo'], $_POST['campanha']);
    }
    
    public function periodoDiscAdd(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        if((isset($_POST['descPeriodo'])) && (!empty($_POST['descPeriodo']))){
            $descricao = addslashes($_POST['descPeriodo']);
            $inicio = addslashes($_POST['inicioPeriodo']);
            $fim = addslashes($_POST['fimPeriodo']);
            $d->addPeriodoDisc($descricao, $inicio, $fim);
        }
    }
    
    public function periodoDiscDel($id){
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $d->delPeriodoDisc($id);
        
    }

    public function saveDiscador($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        if ((isset($_POST['nome'])) && (!empty($_POST['nome']))) {
            $id = addslashes($_POST['iddiscador']);
            $nome = addslashes($_POST['nome']);
            $camp = addslashes($_POST['camp']);
            $grupo = addslashes($_POST['grupo']);
            $tpDisc = addslashes($_POST['tpDisc']);
            $servidor = addslashes($_POST['servidor']);
            if ($id == 0) {
                $d->add($nome, $camp, $grupo, $tpDisc, $servidor);
            } else {
                $d->edit($id, $nome, $camp, $grupo, $tpDisc, $servidor);
            }
        }
    }

    public function param_sel($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $data['param_list'] = $d->getParametros($id);
        $this->loadView("parametrosDiscadorSel", $data);
    }
    
    public function delPeriodoDisc($id){
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $d->delPeriodoDiscador($id);
    }

    public function periodo_sel($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $data['periodo_list'] = $d->getPeriodo($id);
        $data['lista_periodos'] = $d->getPeriodosCadastrados();
        $this->loadView("periodoDiscadorSel", $data);
    }

    public function mailing_sel($id) {
        $this->idDiscador = $id;
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $data['mailing_list'] = $d->getMailing($id);
        $this->loadView("uploadDiscadorSel", $data);
    }

    public function setMailing($sit) {
        $d = new Discadores();
        $id = $_POST['id'];
        $d->setMailing($id, $sit);
    }

    public function delMailing($id, $grupo) {
        $d = new Discadores();
        $d->delMailing($id, $grupo);
    }

    public function regMailing() {
        $array = array();
        $d = new Discadores();
        $this->verificaArquivo();
        $tb = $d->getParametrosEspecifico($_REQUEST['layout'],19);
        $array = $d->getDiscador($_REQUEST['layout']);
        $nomeArquivo = str_replace(" ", "_", $_FILES['arquivo']['name']);
        $id = $d->regMailing($array['ID_GRUPO'], $nomeArquivo);
        if ($tb['VALOR']=='tabeladiscagem_neo'){
            $res = $this->importaMalingNeo(BASE_URL . '/temp/', $nomeArquivo, $array['ID_GRUPO'], 
                             $id, $tb['VALOR']);
        } else {
            $res = $this->importaMaling(BASE_URL . '/temp/', $nomeArquivo, $array['ID_GRUPO'], 
                            $id, $tb['VALOR']);
        }
        echo $res;
        // sleep(3);
        header("Location: " . BASE_URL . "/discador/uploading");
    }

    public function resumoMailingDiscador($discador,$id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $data['mailing_status'] = $d->getMailingStatus($discador,$discador);
        $this->loadView("uploadDiscadorResumo", $data);
    }

    public function resumoMailing($discador,$id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $data['mailing_total'] = $d->getMailingTotal($discador,$id);
        $this->loadView("uploadDiscadorMailing", $data);
    }
    
    public function voltaDiscarStfim($codfim, $id_arquivo, $discador){
        $d = new Discadores();
        //if(isset($_POST['codfim']) && !empty($_POST['codfim'])){
        //$codfim = $_POST['codfim'];
        $d->voltaDiscarStfim($codfim, $id_arquivo, $discador);
        //}
    }

    public function verificaArquivo() {
        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = BASE_LOCAL . '/temp/';

        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 10; // 16Mb
        // Array com as extensões permitidas
        $_UP['extensoes'] = array('txt', 'csv');

        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = false;

        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';



        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
            die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
            exit; // Para a execução do script
        }

        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
        // Faz a verificação da extensão do arquivo
        $extensao = true; //strtolower(end(explode('.', $_FILES['arquivo']['name'])));
        if (array_search($extensao, $_UP['extensoes']) === false) {
            echo "Por favor, envie arquivos com as seguintes extensões: txt ou csv";


            // Faz a verificação do tamanho do arquivo
            #else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
            #echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
            #}
            // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
        } else {
            // Primeiro verifica se deve trocar o nome do arquivo
            if ($_UP['renomeia'] == true) {
                // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                $nome_final = time() . '.jpg';
            } else {
                // Mantém o nome original do arquivo
                $nome_final = str_replace(" ","_",$_FILES['arquivo']['name']);
                // $_FILES['arquivo']['name'];
            }

            // Depois verifica se é possível mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
//                echo $_UP['pasta'] . $nome_final;exit;
                // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
                //echo "Upload efetuado com sucesso!";
                //echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo '.$nome_final.'</a><br />';
                //$leituta = leituraArquivomailing($_UP['pasta'], $nome_final,$id_discador);
//                $reg = $discador->registraArquivoMailing($nome_final, $rs->getID_GRUPO());
//                if(!$reg){
//                    echo "Não foi possivel registrar arquivo!";
//                }else{
//                    echo "<script>window.location.href='importmailing.php?discador=".$id_discador."'</script>";
//                }
            } else {
                // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                echo "Não foi possível enviar o arquivo , tente novamente" . $_UP['pasta'];
            }
        }
    }

    public function importaMaling($caminho, $arquivo, $id_grupo, $id_arquivo, $tabeladiscagem) {
        $mVo = new MailingVo();
        $d = new Discadores();

        ob_start();
        set_time_limit(0);
        $i = 0;
        $rs = 0;
        $fp = @fopen($caminho . $arquivo, 'r');
        if ($fp) {
            while (!feof($fp)) {
                $buffer = fgets($fp, 4096);
                $linha[] = $buffer;
                switch ($i) {
                    case 0:
                        break;
                    case $i > 0:
                        $subVal = array("(", ")", "-", " ", "'","+");
                        if ($linha[$i] != '') {
                            $registros = explode(";", $linha[$i]);
                            $contrato = str_replace($subVal, "", trim($registros[1]));
                            $documento = $registros[0];
                            $nome = utf8_encode($registros[2]);
                            $carteira = utf8_encode($registros[4]);

                            $dddres1 = substr(str_replace($subVal, "", trim($registros[6])), 2, 2);
                            $foneres1 = substr(str_replace($subVal, "", trim($registros[6])), 4);
                            $dddres2 = substr(str_replace($subVal, "", trim($registros[7])), 2, 2);
                            $foneres2 = substr(str_replace($subVal, "", trim($registros[7])), 4);
                            $dddres3 = substr(str_replace($subVal, "", trim($registros[8])), 2, 2);
                            $foneres3 = substr(str_replace($subVal, "", trim($registros[8])), 4);
                            $dddres4 = substr(str_replace($subVal, "", trim($registros[9])), 2, 2);
                            $foneres4 = substr(str_replace($subVal, "", trim($registros[9])), 4);
                            $dddres5 = substr(str_replace($subVal, "", trim($registros[10])), 2, 2);
                            $foneres5 = substr(str_replace($subVal, "", trim($registros[10])), 4);

                            $mVo->setDocumento($documento);
                            $mVo->setNome($nome);
                            $mVo->setContrato($contrato);
                            $mVo->setDddres1($dddres1);
                            $mVo->setFoneres1($foneres1);
                            $mVo->setDddres2($dddres2);
                            $mVo->setFoneres2($foneres2);
                            $mVo->setDddres3($dddres3);
                            $mVo->setFoneres3($foneres3);
                            $mVo->setDddres4($dddres4);
                            $mVo->setFoneres4($foneres4);
                            $mVo->setDddres5($dddres5);
                            $mVo->setFoneres5($foneres5);
                            $mVo->setNumeroramal($id_grupo);
                            $mVo->setTentativas(0);
                            $mVo->setCarteira($carteira);
                            $mVo->setId_arquivo($id_arquivo);
                            $d->inserirMailing($mVo, $tabeladiscagem);
                            if ($grav) {
                                $rs = 1;
                            } else {
                                $rs = 0;
                            }
                        }
                        break;

                    default:
                        break;
                }

                $i++;
            }
            fclose($fp);
            $d->contabilizaMailing($tabeladiscagem,$id_arquivo);
            return $rs;
        } else {
            return $rs;
        }
    }

    /*
      $db = new Connection();
      $conn = $db->getConnection();
      $disc = new DiscadorDao();
      $id_discador = $_POST['discador'];
      $arr = $disc->listArquivosMalingIdArquivoMailing($_POST['idarquivomailing'])->fetch(PDO::FETCH_OBJ);
      $arquivo = $arr->ARC_DESC;
      $select = "select valor from config_parametro where id_parametro = 19 and id_discador = " . $id_discador;
      $rs = $conn->query($select)->fetch(PDO::FETCH_OBJ);
      $tabeladiscagem = $rs->valor;



      $caminho = DIR . TEMP;
      $id_grupo = $_POST['id_grupo'];
      $id_arquivo = $_POST['idarquivomailing'];
      $rs = leituraArquivomailing($caminho, $arquivo, $id_grupo, $id_arquivo, $tabeladiscagem);


      if (!$rs) {
      $disc->arquivoProcessado($_POST['idarquivomailing'], 2);
      } else {
      $disc->arquivoProcessado($_POST['idarquivomailing'], 1);
      }
      $db->closeCon();
      echo $rs;
      }
     */
    
    public function importaMalingNeo($caminho, $arquivo, $id_grupo, $id_arquivo, $tabeladiscagem) {
        $d = new Discadores();
        $linha = array();
        $foneres = array();
        $fonecom = array();
        $fonecel = array();
        $foneout = array();
    
        $gravados  = 0;
        $ngravados = 0;
        ob_start();
        set_time_limit(0);
        $i=0;
        $fp = fopen($caminho.'/'.$arquivo, 'r');
        if($fp){
            while (!feof($fp)){
                $buffer = fgets($fp, 4096);
                $linha[$i] = $buffer;
                $i++;
            }
            fclose($fp);
            $j=0;
    
            while($j<$i){
                //vazio;Código do cliente;Nome do Cliente;Fila;Data Hora da agenda;Usuario agenda;tipo telefone 1;ddd 1;telefone 1;tipo telefone 2;ddd 2;telefone 2;tipo telefone 3;ddd 3;telefone 3;tipo telefone 4;ddd 4;telefone 4;tipo telefone 5;ddd 5;telefone 5;tipo telefone 6;ddd 6;telefone 6;tipo telefone 7;ddd 7;telefone 7;tipo telefone 8;ddd 8;telefone 8;tipo telefone 9;ddd 9;telefone 9;tipo telefone 10;ddd 10;telefone 10;tipo telefone 11;ddd 11;telefone 11;tipo telefone 12;ddd 12;telefone 12;tipo telefone 13;ddd 13;telefone 13;tipo telefone 14;ddd 14;telefone 14;tipo telefone 15;ddd 15;telefone 15;tipo telefone 16;ddd 16;telefone 16;tipo telefone 17;ddd 17;telefone 17;tipo telefone 18;ddd 18;telefone 18;tipo telefone 19;ddd 19;telefone 19;tipo telefone 20;ddd 20;telefone 20;vazio
                //$subVal = array("(",")","-"," ");
                if($linha[$j] != ''){
                    //separa dados em array
                    $registros = explode("|",preg_replace('/(\'|")/','', $linha[$j]));
    
                    //atribuindo valor das posições do array em variaveis
                    $contrato = $registros[1];
                    $documento = $registros[44];
                    $carteira = ''; //$registros[46];
                    $nome = $registros[2];
                    $fila = $registros[39];
                    $scoreScritorio = $registros[37];
                    $scoreContratante = $registros[36];
                    $valor = $registros[33];
                    $atraso = $registros[34];
                    if(!empty($registros[41])){
                        if(strpos(' ', $registros[41])){
                            $hragenda = explode(" ", $registros[41]);
                            $data = $hragenda[0];
                            $hr   = $hragenda[1];
                        }else{
                            $data = $registros[41];
                            $hr = '00:00:00';
                        }
                        $datacheia = explode("/", $data);
                        $ano = substr($data, 6,4);
                        $mes = substr($data, 3,2);
                        $dia = substr($data, 0,2);
                        $datahoraagendamento = $ano."-".$mes."-".$dia." ".$hr;
                    }else{
                        $datahoraagendamento = null;
                    }
                    $agenteaAgenda = $id_grupo;
                    if($agenteaAgenda == '' ){
                        $tipoagenda = 2;
                    }else{
                        $tipoagenda = 3;
                    }
                    $dddFone = trim($registros[6]);
                    if(!empty($dddFone)) {
                        $dddres1 = substr($dddFone, 4, 2);
                        $foneres1 = substr($dddFone, 7, 15);
                    }else{
                        $dddres1 = "";
                        $foneres1 = "";
                    }
    
                    $dddFone = trim($registros[7]);
                    if(!empty($dddFone)) {
                        $dddres2 = substr($dddFone, 4, 2);
                        $foneres2 = substr($dddFone, 7, 15);
                    }else{
                        $dddres2 = "";
                        $foneres2 = "";
                    }

                    $dddFone = trim($registros[8]);
                    if(!empty($dddFone)) {
                        $dddres3 = substr($dddFone, 4, 2);
                        $foneres3 = substr($dddFone, 7, 15);
                    }else{
                        $dddres3 = "";
                        $foneres3 = "";
                    }

                    $dddFone = trim($registros[9]);
                    if(!empty($dddFone)) {
                        $dddres4 = substr($dddFone, 4, 2);
                        $foneres4 = substr($dddFone, 7, 15);
                    }else{
                        $dddres4 = "";
                        $foneres4 = "";
                    }

                    $dddFone = trim($registros[10]);
                    if(!empty($dddFone)) {
                        $dddres5 = substr($dddFone, 4, 2);
                        $foneres5 = substr($dddFone, 7, 15);
                    }else{
                        $dddres5 = "";
                        $foneres5 = "";
                    }

                    $dddFone = trim($registros[11]);
                    if(!empty($dddFone)) {
                        $dddcom1 = substr($dddFone, 4, 2);
                        $fonecom1 = substr($dddFone, 7, 15);
                    }else{
                        $dddcom1 = "";
                        $fonecom1 = "";
                    }

                    $dddFone = trim($registros[12]);
                    if(!empty($dddFone)) {
                        $dddcom2 = substr($dddFone, 4, 2);
                        $fonecom2 = substr($dddFone, 7, 15);
                    }else{
                        $dddcom2 = "";
                        $fonecom2 = "";
                    }
    
                    $dddFone = trim($registros[13]);
                    if(!empty($dddFone)) {
                        $dddcom3 = substr($dddFone, 4, 2);
                        $fonecom3 = substr($dddFone, 7, 15);
                    }else{
                        $dddcom3 = "";
                        $fonecom3 = "";
                    }

                    $dddFone = trim($registros[14]);
                    if(!empty($dddFone)) {
                        $dddcom4 = substr($dddFone, 4, 2);
                        $fonecom4 = substr($dddFone, 7, 15);
                    }else{
                        $dddcom4 = "";
                        $fonecom4 = "";
                    }

                    $dddFone = trim($registros[15]);
                    if(!empty($dddFone)) {
                        $dddcom5 = substr($dddFone, 4, 2);
                        $fonecom5 = substr($dddFone, 7, 15);
                    }else{
                        $dddcom5 = "";
                        $fonecom5 = "";
                    }

                    $dddFone = trim($registros[16]);
                    if(!empty($dddFone)) {
                        $dddcel1 = substr($dddFone, 4, 2);
                        $fonecel1 = substr($dddFone, 7, 15);
                    }else{
                        $dddcel1 = "";
                        $fonecel1 = "";
                    }

                    $dddFone = trim($registros[17]);
                    if(!empty($dddFone)) {
                        $dddcel2 = substr($dddFone, 4, 2);
                        $fonecel2 = substr($dddFone, 7, 15);
                    }else{
                        $dddcel2 = "";
                        $fonecel2 = "";
                    }

                    $dddFone = trim($registros[18]);
                    if(!empty($dddFone)) {
                        $dddcel3 = substr($dddFone, 4, 2);
                        $fonecel3 = substr($dddFone, 7, 15);
                    }else{
                        $dddcel3 = "";
                        $fonecel3 = "";
                    }
    
                    $dddFone = trim($registros[19]);
                    if(!empty($dddFone)) {
                        $dddcel4 = substr($dddFone, 4, 2);
                        $fonecel4 = substr($dddFone, 7, 15);
                    }else{
                        $dddcel4 = "";
                        $fonecel4 = "";
                    }

                    $dddFone = trim($registros[20]);
                    if(!empty($dddFone)) {
                        $dddcel5 = substr($dddFone, 4, 2);
                        $fonecel5 = substr($dddFone, 7, 15);
                    }else{
                        $dddcel5 = "";
                        $fonecel5 = "";
                    }

                    $dddFone = trim($registros[21]);
                    if(!empty($dddFone)) {
                        $dddout1 = substr($dddFone, 4, 2);
                        $foneout1 = substr($dddFone, 7, 15);
                    }else{
                        $dddout1 = "";
                        $foneout1 = "";
                    }
    
                    $dddFone = trim($registros[22]);
                    if(!empty($dddFone)) {
                        $dddout2 = substr($dddFone, 4, 2);
                        $foneout2 = substr($dddFone, 7, 15);
                    }else{
                        $dddout2 = "";
                        $foneout2 = "";
                    }

                    $dddFone = trim($registros[23]);
                    if(!empty($dddFone)) {
                        $dddout3 = substr($dddFone, 4, 2);
                        $foneout3 = substr($dddFone, 7, 15);
                    }else{
                        $dddout3 = "";
                        $foneout3 = "";
                    }

                    $dddFone = trim($registros[24]);
                    if(!empty($dddFone)) {
                        $dddout4 = substr($dddFone, 4, 2);
                        $foneout4 = substr($dddFone, 7, 15);
                    }else{
                        $dddout4 = "";
                        $foneout4 = "";
                    }
    
                    $dddFone = trim($registros[25]);
                    if(!empty($dddFone)) {
                        $dddout5 = substr($dddFone, 4, 2);
                        $foneout5 = substr($dddFone, 7, 15);
                    }else{
                        $dddout5 = "";
                        $foneout5 = "";
                    }

                    $dddFone = trim($registros[26]);
                    if(!empty($dddFone)) {
                        $dddpri1 = substr($dddFone, 4, 2);
                        $fonepri1 = substr($dddFone, 7, 15);
                    }else{
                        $dddpri1 = "";
                        $fonepri1 = "";
                    }

                    $dddFone = trim($registros[27]);
                    if(!empty($dddFone)) {
                        $dddpri2 = substr($dddFone, 4, 2);
                        $fonepri2 = substr($dddFone, 7, 15);
                    }else{
                        $dddpri2 = "";
                        $fonepri2 = "";
                    }

                    $dddFone = trim($registros[28]);
                    if(!empty($dddFone)) {
                        $dddpesq1 = substr($dddFone, 4, 2);
                        $fonepesq1 = substr($dddFone, 7, 15);
                    }else{
                        $dddpesq1 = "";
                        $fonepesq1 = "";
                    }

                    $dddFone = trim($registros[29]);
                    if(!empty($dddFone)) {
                        $dddpesq2 = substr($dddFone, 4, 2);
                        $fonepesq2 = substr($dddFone, 7, 15);
                    }else{
                        $dddpesq2 = "";
                        $fonepesq2 = "";
                    }

                    $dddFone = trim($registros[30]);
                    if(!empty($dddFone)) {
                        $dddpesq3 = substr($dddFone, 4, 2);
                        $fonepesq3 = substr($dddFone, 7, 15);
                    }else{
                        $dddpesq3 = "";
                        $fonepesq3 = "";
                    }
    
                    $dddFone = trim($registros[31]);
                    if(!empty($dddFone)) {
                        $dddpesq4 = substr($dddFone, 4, 2);
                        $fonepesq4 = substr($dddFone, 7, 15);
                    }else{
                        $dddpesq4= "";
                        $fonepesq4 = "";
                    }


                    $dddFone = trim($registros[32]);
                    if(!empty($dddFone)) {
                        $dddpesq5 = substr($dddFone, 4, 2);
                        $fonepesq5 = substr($dddFone, 7, 15);
                    }else{
                        $dddpesq5 = "";
                        $fonepesq5 = "";
                    }
    
                     /*
                    * switch nos tipos de telefones e atribução de valores às variaveis para vada caso
                    * cada caso corresponde a um novo array contendo somentes valores para o caso em questao
                    */
    
                    if(empty($contrato) || $contrato=='' || $contrato==null){
                        // $disc = new DiscadorDao($conn);
                        // $disc->arquivoProcessado($id_arquivo,2);
                        exit;
                    }else {
                        $rs = $d->inserirMailingNeo($documento,$nome,$contrato,$id_grupo,$id_grupo,$datahoraagendamento,
                            $dddres1,$foneres1,$dddres2,$foneres2,$dddres3,$foneres3,$dddres4,
                            $foneres4,$dddres5,$foneres5,$dddcom1,$fonecom1,$dddcom2,$fonecom2,
                            $dddcom3,$fonecom3,$dddcom4,$fonecom4,$dddcom5,$fonecom5,$dddcel1,
                            $fonecel1,$dddcel2,$fonecel2,$dddcel3,$fonecel3,$dddcel4,$fonecel4,
                            $dddcel5,$fonecel5,$dddout1,$foneout1,$dddout2,$foneout2,$dddout3,
                            $foneout3,$dddout4,$foneout4,$dddout5,$foneout5,$dddpri1,$fonepri1,
                            $dddpri2,$fonepri2,$dddpesq1,$fonepesq1,$dddpesq2,$fonepesq2,$dddpesq3,
                            $fonepesq3,$dddpesq4,$fonepesq4,$dddpesq5,$fonepesq5,$agenteaAgenda,
                            $tipoagenda,$id_arquivo,$fila,$scoreScritorio,$scoreContratante,
                            $valor,$atraso,$carteira, $tabeladiscagem);
                        if ($rs!=0){
                            $gravados +=1;
                        };
                            // if ($grav) {
                            //     $rs = 1;
                            // } else {
                            //     $rs = 0;
                            // }
        
                    }
                    $j++;
                }else{
                    $j++;
                }
                
            }

        }
        $retorno = 'De um total de '.$i.' linhas do arquivo, foram inseridos '.$gravados.' registros.';
        $d->contabilizaMailing($tabeladiscagem,$id_arquivo);
        return $retorno;
    }

    public function prioridade($gr=0) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $g = new Group();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'PRIORIDADE';
//  		if($u->hasPermission('supervisor')) {
        $data['group_list'] = $g->getList();
        $data['prioridadeList'] = $d->prioridadeList($gr);
        $this->loadTemplate('prioridadeDiscador', $data);
//		} else {
//			header("Location: ".BASE_URL);
//		}
    }
    public function prioridadeList($gr=0) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $g = new Group();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'PRIORIDADE';
        $data['group_list'] = $g->getList();
        $data['prioridadeList'] = $d->prioridadeList($gr);
        $this->loadView('prioridadeDiscadorLista', $data);
    }

    function setPrioridade($id,$gr,$ativo){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $d = new Discadores();
        $g = new Group();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'PRIORIDADE';
        $data['group_list'] = $g->getList();
        $d->setPrioridade($id,$ativo);
        $data['prioridadeList'] = $d->prioridadeList($gr);
        $this->loadView('prioridadeDiscadorLista', $data);
    }

    function semana($id){
        $data = array();
        $d = new Discadores();
        $semana = '';
        $data = $d->prioridadeDiasDaSeaman($id);
        return $data;
    }

    public function cadastroPrioridade(){
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $user = $u->getId();
        $d = new Discadores();
        $g = new Group();
        $c = new Campanhas();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_name'] = $u->getName();
        $data['title'] = 'DISCADOR';
        $data['title2'] = 'PRIORIDADE';
        // $data['group_list'] = $g->getList();
        $data['campanha_list'] = $c->campanhaList($user);
        // $data['prioridadeList'] = $d->prioridadeList($gr);
        $this->loadView('prioridadeDiscadorCadastro', $data);
    }
}
