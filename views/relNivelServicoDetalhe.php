<?php
    // Configurações header para forçar o download
    // header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    // header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    // header ("Cache-Control: no-cache, must-revalidate");
    // header ("Pragma: no-cache");
    // header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"NivelServico.xls\"" );
    header ("Content-Description: PHP Generated Data" );

    $html = '<table  >
            <tr class="cabecalho"  >
                <th >DATA</th>
                <th >DDR</th>
                <th >DDD</th>
                <th >TELEFONE</th>
                <th >FINALIZAÇÃO</th>
                <th >OPERADOR</th>
                <th >NOME OPERADOR</th>
                <th >GRUPO</th>
                <th >CAMPNHA</th>
            </tr>';
    foreach ($nivel_list as $l) {
        $html .= '<tr class="cabecalho"  >
                <td >'.$l["dh_inicio"].'</td>
                <td >'.$l["ddr"].'</td>
                <td >'.$l["ddd"].'</td>
                <td >'.$l["telefone"].'</td>
                <td >'.$l["nome_finalizacao"].'</td>
                <td >'.$l["codagente"].'</td>
                <td >'.$l["nome_agente"].'</td>
                <td >'.$l["nome_grupo"].'</td>
                <td >'.$l["nome_campanha"].'</td>
            </tr>';
    }
    $html .= '</table>';
    echo $html;

?>
