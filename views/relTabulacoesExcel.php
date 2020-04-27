<?php
    // Configurações header para forçar o download
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename=\"Tabulacoes.xls\"" );
    header ("Content-Description: PHP Generated Data" );
    $html = '<table >
        <tr class="cabecalho"  >
        <td >Id</td>
        <td >Data</td>
        <td >Operadora</td>
        <td >Direção</td>
        <td >Contrato</td>
        <td >DDD</td>
        <td >Telefone</td>
        <td >Tabulação</td>
        <td >Tipo tabulação</td>
        <td >Código Agente</td>
        <td >Nome Agente</td>
        <td >Tempo falado em segundos</td>
        <td >Grupo</td>
        <td >Campanha</td>                                                                
    </tr>'
    foreach ($tab_list as $l) {
        $html .= '<tr style="width: 400px;" >
            <td >'.$l['id'].'</td>
            <td >'. date('d/m/Y H:i:s',strtotime($l['dh_inicio'])).'</td>
            <td >'. $l['operadora'].'</td>
            <td >'. $l['nome_direcao'].'</td>
            <td >'. $l['chave'].'</td>
            <td >'. $l['ddd'].'</td>
            <td >'. $l['fone'].'</td>
            <td >'. $l['nome_tabulacao'].'</td>
            <td >'. $l['nome_tipotabulacao'].'</td>
            <td >'. $l['cod_agente'].'</td>
            <td >'. $l['nome_agente'].'</td>
            <td >'. $l['tempo_segundos'].'</td>
            <td >'. $l['nome_grupo'].'</td>
            <td >'. $l['nome_campanha'].'</td>
        </tr>';
    }

    $html .= '</table>';
    printf($html);
?>
