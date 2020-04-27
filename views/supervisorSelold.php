<div id="box-toggle" class="w-100">

    <?php
    $gr = 0;
    $html = '';
    $i = 0;
    foreach ($grupos as $l) {
        if ($l['id_grupo'] != $gr) {
            if ($html != '') {
                $html .= '</table>';
                $html .= '</div>';
                echo $html;
                $html = '';
            }
            $gr = $l['id_grupo'];
            $html .= '<span class="spanGrupos" id="' . $l['id_grupo'] . '">' . $l['descricao'] . '
                     <div class="resumoGrupo" style="margin-top:5px;padding-top:5px;">
                     <div class="col-md-2"></div>
                     <div class="col-md-2"></div>
                     <div class="col-md-2"></div>
                     <div class="col-md-2"></div>
                     </div></span>';
            
            $html .= '<div class="tgl" > ';
            $html .= '    <table id="tb1" style="text-align: center;font-size:10px;" class="tblistagentes table table-bordered dw-100" >
                            <thead class="theadfundo">
                                <tr class="cabecalho">
                                    <th class="theadfundo">NOME</th>
                                    <th class="theadfundo">STATUS</th>
                                    <th class="theadfundo">TEMPO</th>
                                    <th class="theadfundo">DESCRIÇÃO</th>
                                    <th class="theadfundo">NUMERO</th>
                                    <th class="theadfundo font-weight-bold">OPERADORA</th>
                                </tr>
                            </thead>';
        }
        $i++;
        $html .='<tbody id="A'.$i.'" class="'.$l{'codigo'}.'" >';
        $html .= '<tr onclick="optionsAgentes('.$i.','.$l{'id_grupo'}.')" style="width: 400px;" id="'.$l{'id_grupo'}.$l{'codigo'}.'" class="trhover" >
                        <input type="hidden"  value="'.$l['codigo'].'" name="codigo">
                        <td class="tdhover" > ' . $l['nome'] . '</td>
                        <td >' . $l['estado'] . '</td>
                        <td >' . $l['tempo'] . '</td>
                        <td >' . $l['direcao'] . '</td>
                        <td >(' . substr($l['telefone'], 0, 2) . ') ' . substr($l['telefone'], 2, 10) . '</td>
                        <td >' . $l['operadora'] . '</td>
                        </tr> ';
        $html .='</tbody>';
    }
    if ($html != '') {
        $html .= '</table>';
        $html .= '</div>';
        


        echo $html;
    }
    ?>
</div>
<!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/supervisor.js"></script> -->

