<?php
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"Pausas.xls\"" );
        header ("Content-Description: PHP Generated Data" );

$cabecalhoXLS = "Puasas\t\n";
$cabecalhoXLS .=  'Periodo: '.$dti.' A '.$dtf." \t\n";
$cabecalhoXLS .=  " \t\n";
// $cabecalhoXLS .=  "Carteira: ".$carteira."\n";
// $cabecalhoXLS .= "Grupo: ".$grupo."\n\n";
$dadosXLS ='';
$cabecalhoXLS .=  "AGENTE \t";
$i = 0;
foreach ($resumo_pausas as $l) {
    $cabecalhoXLS .=  $l['subcod_evento']." \t";;
    $tipoPausa[$i] = $l['subcod_evento'];
    $i++;
}
$cabecalhoXLS .= "TEMPO TOTAL EM PAUSA \n" ;
$cabecalhoXLS .=  " \t\n";
$reg = $this->relPausasResumoAgentes($dti,$dtf,$agente); 
foreach ($reg as $r) {
    foreach ($r as $v){
        $dadosXLS .=  utf8_decode($v['nome'])." - ".$v['cod_agente'];
        foreach ($tipoPausa as $pausa){
            $reg = $this->relPausasResumoTempoPausa($dti,$dtf,$v['cod_agente'],$pausa); 
            $dadosXLS .= $reg[0]." \t";
            // $dadosXLS .= $v['cod_agente'].'  -  '.$pausa;" \t";
        }
            // $dadosXLS .=  $l['nome']." - ".$l['cod_agente']."\t".utf8_encode($v['subcod_evento'])."\t".
        // date('d/m/Y H:i:s',  strtotime($v['instante']))."\t".
        // $v['tempo']."\n";
        $reg = $this->relPausasTotal($dti,$dtf,$grupo,$v['cod_agente']); 
        $dadosXLS .= $reg[0]."\n";
    }
}

$dadosXLS .="\n";;


$filename = "Puasas Resumo.xls";

// header('Content-type: application/x-msexcel');
// header('Content-Disposition: attachment; filename='.$filename);
echo $cabecalhoXLS.$dadosXLS;




 ?>
