<?php

class relligacoesController extends controller {

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
        $r = new Regras();
        $o = new Operadoras();
        $u->setLoggedUser();
        $user = $u->getId();
        $data['user_name'] = $u->getName();
        $data['title'] = 'RELATORIOS';
        $g = new Group();
        $a = new Agentes(0);
        $c = new Campanhas(0);
        $d = new Diversos();
        $company = new Company($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['p_count'] = 0;
        if ($u->hasPermission('Ligacoes')) {
            $data['group_list'] = $g->getList();
            $data['agents_list'] = $a->agentesList();
            $data['campanha_list'] = $c->campanhaList($user);
            $data['operadoras_list'] = $o->listOperadoras();
            $data['operacao_list'] = $d->listTipoOperacao();
            $this->loadTemplate('relligacoes', $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function relligacoesDetalhe($tipo) {
        $data = array();
        $d = new Diversos();
        $dti = addslashes($_GET['data_inicio']) .' '. addslashes($_GET['hora_inicio']);
        $dtf = addslashes($_GET['data_fim']) . ' '.addslashes($_GET['hora_fim']);
        $camp = 0;
        $agente = 0;
        $ddd = 0;
        $tel = 0;
        $operadora = 0;
        $oper = addslashes($_GET['oper']);
        if (isset($_GET['camp']) && $_GET['camp'] > 0) {
            $camp = addslashes($_GET['camp']);
        }
        if (isset($_GET['agents']) && $_GET['agents'] > 0) {
            $agente = addslashes($_GET['agents']);
        }
        if (isset($_GET['OperadoraLig']) && $_GET['OperadoraLig'] > 0) {
            $operadora = addslashes($_GET['OperadoraLig']);
        }
        if (isset($_GET['ddd']) && $_GET['ddd'] != '') {
            $ddd = addslashes($_GET['ddd']);
        }
        if (isset($_GET['fone']) && $_GET['fone'] != '') {
            $tel = addslashes($_GET['fone']);
        }
        $data['relligDetalhe'] = $d->cdrLigacoesDetalhe($dti, $dtf, $oper, $camp, $agente, $operadora, $ddd, $tel);
        $data['tipo'] = $tipo;
        if ($tipo == 2) {
            $this->loadLibrary('mpdf60/mpdf');
            ob_start();
        }
        $this->loadView("relligacoes_view", $data);
        if ($tipo == 2) {
            $html = ob_get_contents();
            ob_end_clean();
            $mpdf = new mPDF();
            //        $mpdf->charset_in='windows-1252';
            $html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1');
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
    }

    public function relligacoesExcel() {
        $data = array();
//        $data['relligDetalhe'] = $d->cdrLigacoesDetalhe($dti,$dtf,$oper,$camp,$agente,$ddd,$tel);
    }

    public function relligacoessel() {
        $data = array();
        $d = new Diversos();
        $dti = addslashes($_POST['data_inicio']) .' '. addslashes($_POST['hora_inicio']);
        $dtf = addslashes($_POST['data_fim']) . ' '.addslashes($_POST['hora_fim']);
        $camp = 0;
        $agente = 0;
        $ddd = 0;
        $tel = 0;
        $operadora = 0;
        $oper = addslashes($_POST['oper']);
        if (isset($_POST['camp']) && $_POST['camp'] > 0) {
            $camp = addslashes($_POST['camp']);
        }
        if (isset($_POST['agents']) && $_POST['agents'] > 0) {
            $agente = addslashes($_POST['agents']);
        }
        if (isset($_POST['OperadoraLig']) && $_POST['OperadoraLig'] > 0) {
            $operadora = addslashes($_POST['OperadoraLig']);
        }
        if (isset($_POST['ddd']) && $_POST['ddd'] != '') {
            $ddd = addslashes($_POST['ddd']);
        }
        if (isset($_POST['fone']) && $_POST['fone'] != '') {
            $tel = addslashes($_POST['fone']);
        }
        $data['rellig'] = $d->cdrLigacoesResumo($dti, $dtf, $oper, $camp, $agente, $operadora, $ddd, $tel);

        echo json_encode($data);
    }

}
