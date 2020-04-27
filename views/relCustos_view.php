<div id="container" class="container w-100" style="position:relative;top:50px;float:rigth;text-align:center;z-index:0;">
    <div class="container" style="font-size: 28;font-weight: bold;">
        <a href="#" onclick="openPopupCustos()">
            <img src="<?php echo BASE_URL; ?>/assets/images/excel_icon_2003_32px.png">
            Detalhado
        </a>
    </div>
    <br>
    <div class="panel panel-primary w-50" style="margin-left:450px" >
        <div class="panel-heading w-100">TABELA DE CUSTOS</div>
        <table id="tb1" class="table w-100">
            <tr class="cabecalho" >
                <td >Operadora</td>
                <td >Ligações</td>
                <td >Primeiro Att.</td>
                <td >Ultimo Att.</td>
                <td>Total</td>
            </tr>
            <?php
                $total = 0;
                $ligacoes = 0;
                foreach ($resumo_list as $l) {
                    $html = "<tr>
                    <td>".$l['nome_operadora']."</td>
                    <td>".$l['ligacoes']."</td>
                    <td>".date('d/m/Y H:i:s',strtotime($l['primeiro_att']))."</td>
                    <td>".date('d/m/Y H:i:s',strtotime($l['ultimo_att']))."</td>
                    <td>  R$ ". utf8_encode(number_format($l['total'],2, ',', '.'))." </td>
                    </tr>";
                    $ligacoes = $ligacoes + $l['ligacoes'];
                    $total = $total + (float) $l['total'];
                    echo $html;
                    $html = '';
                }
                $html = "<tr>
                <td><strong>TOTAL</strong></td>
                <td><strong>".$ligacoes."</strong></td>
                <td></td>
                <td></td>
                <td> <strong> R$ ". utf8_encode(number_format($total,2, ',', '.'))." </strong></td>
                </tr>";
                echo $html;
                $html = '';
            ?>
        </table>
    </div>
</div>