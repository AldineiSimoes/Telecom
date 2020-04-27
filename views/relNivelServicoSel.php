<div class="container" id="divdetalhe" style="font-size: 28;font-weight: bold;" >
        <a href="#" id="exportaNivel" onclick="openPopupNivel()">
            <img src="<?php echo BASE_URL; ?>/assets/images/excel_icon_2003_32px.png">
            Detalhes
        </a>
    </div>
<div class="panel-heading  text-center">Nivel de Serviç Receptivo</div>
<table id="tb1" style="text-align: center;font-size:12px;" class="table w-100" >
    <tr class="cabecalho"  >
        <td >DATA</td>
        <td >TOTAL RECEBIDAS</td>
        <td >TOTAL NÃO ATENDIDAS</td>
        <td >TOTAL ATENDIDAS</td>
        <td >ATENDIDAS EM AtÉ 20 Seg</td>
        <td >ATENDIDAS ENTRE 21 a 40 Seg</td>
        <td >ATENDIDAS ENTRE 41 a 60 Seg</td>
        <td >ATENDIDAS ENTRE 61 a 120 Seg</td>
        <td >ATENDIDAS ACIMA DE 120 Seg</td>
        <td >TEMPO TOTAL DE ATENDIMENTO</td>
        <td >TEMPO TOTAL DE ESPERA EM FILA</td>
        <td >TMA</td>
        <td >TME</td>
        <td >TOTAL DE ABANDONADAS</td>                                                                
        <td >ABANDONADAS EM ATÉ 20 seg</td>
        <td >ABANDONADAS ENTRE 21 e 40 seg</td>
        <td >ABANDONADAS ENTRE 41 e 60 seg</td>
        <td >ABANDONADAS ENTRE 61 e 120 seg</td>
        <td >ABANDONADAS ACIMA DE 120 seg</td>                
        <td >NIVEL DE SERVIÇO</td>
    </tr>
    <?php

//        if($rs==false){
//            echo "<script>alert(Sem registro para o periodo!)</script>";
//            exit();
//        }else
    ?>
    <?php foreach ($nivel_list as $l): ?>
        <tr style="width: 400px;" >
            <td ><?php echo $l['hora']; ?></td>
            <td ><?php echo $l['recebidas']; ?></td>
            <td ><?php echo $l['nao_atendidas']; ?></td>
            <td ><?php echo $l['atendidas']; ?></td>
            <td ><?php echo $l['atendidas_ate20']; ?></td>
            <td ><?php echo $l['atendidas_21_40']; ?></td>
            <td ><?php echo $l['atendidas_41_60']; ?></td>
            <td ><?php echo $l['atendidas_61_120']; ?></td>
            <td ><?php echo $l['atendidas_acima120']; ?></td>
            <td ><?php echo $l['falado']; ?></td>
            <td ><?php echo $l['tempo_maximo_fila']; ?></td>
            <td ><?php echo (!$l['TMA']) ? '00:00:00' : $l['TMA']; ?></td>
            <td ><?php echo (!$l['TME']) ? '00:00:00' : $l['TME']; ?></td>
            <td ><?php echo $l['total_abandonadas']; ?></td>
            <td ><?php echo $l['abandonadas_ate20']; ?></td>
            <td ><?php echo $l['abandonadas_21_40']; ?></td>
            <td ><?php echo $l['abandonadas_41_60']; ?></td>
            <td ><?php echo $l['abandonadas_61_120']; ?></td>
            <td ><?php echo $l['abandonadas_acima120']; ?></td>
            <td ><?php echo (!$l['nivel_servico']) ? '00:00:00' : $l['nivel_servico']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>
