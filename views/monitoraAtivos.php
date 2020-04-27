<div style="margin-top:10px;position: fixed;left:5px;z-index: 1; height: 1500px;width: 1340px; overflow-x:auto;overflow-y:auto;">
<div id='relResumo' class="w-100">
    <div class="PeriodoSel panel panel-primary" id="idResumo" style="width: 1350px;">
<div class="panel-heading  text-center">Monitoramento Grupos Ativos</div>
    <table class="monitoramento table w-100"  style="text-align: center;font-size:12px;"  >
        <tr class="cabecalho_monitoramento panel-heading  text-center">
            <td colspan="11" align="center">OPERAÇÃO</td>
            <td colspan="4" align="center">MAILING</td>
            <td colspan="4" align="center">TABULAÇÃO OPERACAO</td>
        </tr>
        <tr class="cabecalho tr_monitoramento_icones">
            <td class="td_monitoramento td_monitoramento_descricao" title="NOME, TIPO E CÓDIGO DO GRUPO">DESCRIÇÃO</td>
            <td class="td_monitoramento td_monitoramento_logados" title="TOTAL DE AGENTES LOGADOS">AGENTES<br>LOGADOS</td>
            <td class="td_monitoramento td_monitoramento_livres" title="TOTAL DE AGENTES LIVRES">AGENTES<br>LIVRES</td>
            <td class="td_monitoramento td_monitoramento_clerical" title="TOTAL DE AGENTES EM CLERICAL">AGENTES<br>CLERICAL</td>
            <td class="td_monitoramento td_monitoramento_pausa" title="TOTAL DE AGENTES EM PAUSA">AGENTES<br>PAUSADOS</td>
            <td class="td_monitoramento td_monitoramento_atendendo" title="TOTAL DE AGENTES EM ATENDIMENTO">AGENTES<br>ATENDENDO</td>
            <td class="td_monitoramento td_monitoramento_tempo_livre"title="TEMPO MÁXIMO LIVRE ATINGIDO">TEMPO<br>LIVRE</td>
            <td class="td_monitoramento td_monitoramento_tempo_clerical" title="TEMPO MÁXIMO EM CLERICAL ATINGIDO">TEMPO CLERICAL</td>
            <td class="td_monitoramento td_monitoramento_tempo_medio_espera" title="TEMPO MEDIO EM ESPERA">T.MÉDIO<br>ESPERA</td>
            <td class="td_monitoramento td_monitoramento_tempo_medio_clerical" title="TEMPO MEDIO DOS AGENTES EM CLERICAL">T.MÉDIO<br>CLERICAL</td>
            <td class="td_monitoramento td_monitoramento_tempo_medio_atendimento" title="TEMPO MEDIO DOS AGENTES EM ATENDIMENTO">T.MÉDIO<br>ATENDIM.</td>
            <td class="td_monitoramento td_monitoramento_livre" title="REGISTROS LIVRES NO MAILING">REGISTROS<br>LIVRES</td>
            <td class="td_monitoramento td_monitoramento_agendado" title="REGISTROS AGENDADOS NO MAILING">REGISTROS<br>AGENDADOS</td>
            <td class="td_monitoramento td_monitoramento_fin_limite" title="REGISTROS FINALIZADOS POR ATINGIR O LIMITE DE TENTATIVAS">FIN.LIMITE<br/>TENTATIVA</td>
            <td class="td_monitoramento td_monitoramento_finalizados" title="TOTAL DE REGISTROS FINALIZADOS">FINALIZADOS<br/>GERAL</td>
            <td class="td_monitoramento td_monitoramento_alo" title="ALO">TABULAÇÕES<br/>ALO</td>
            <td class="td_monitoramento td_monitoramento_alo" title="CPC">TABULAÇÕES<br/>CPC</td>
	    <td class="td_monitoramento td_monitoramento_alo" title="Sucesso">TABULAÇÕES<br/>Sucesso</td>
            <td class="td_monitoramento td_monitoramento_alo" title="Insucesso">TABULAÇÕES<br/>Insucesso</td>
        </tr>

        <?php foreach ($gruposAtivos as $row): ?>

            <td><?php echo $row['descricao']; ?></td>
                <td align="center"><?php echo $row['logados']; ?></td>
                <td align="center"><?php echo $row['aglivres']; ?></td>
                <td align="center"><?php echo $row['clerical']; ?></td>
                <td align="center"><?php echo $row['pausado']; ?></td>
                <td align="center"><?php echo $row['atendendo']; ?></td>
                <td align="center"><?php echo ($row['max_livre'] == null) ? '-' : htmlentities($row['max_livre']); ?></td>
                <td align="center"><?php echo ($row['max_clerical'] == null) ? '-' : htmlentities($row['max_clerical']); ?></td>
                <td align="center"><b><?php echo ($row['TME_ESPERA'] == null ) ? '-' : $row['TME_ESPERA']; ?></b></td>
                <td align="center"><b><?php echo ($row['TMC_FALANDO'] == null ) ? '-' : $row['TMC_FALANDO']; ?></b></td>
                <td align="center"><b><?php echo ($row['TMA_ATENDIMENTO'] == null ) ? '-' : $row['TMA_ATENDIMENTO']; ?></b></td>
                <td align="center"><b><?php echo ($row['livres'] == null ) ? '-' : $row['livres']; ?></b></td>
                <td class="monitoramento_animacao_opacity" align="center"><b><?php echo ($row['agendado'] == null) ? '-' : $row['agendado']; ?></b><a href="#" onclick="zerarRegistros(<?php echo $row['id_discador'] ?>,20000);"><img id="agendados" style="width:15px;height:15px;" src="<?php echo BASE_URL; ?>/assets/images/return.png" align="right" alt="Rediscar Agendados " title="Rediscar Agendados <?php echo $row['descricao']; ?>" /><a/></td>
                <td class="monitoramento_animacao_opacity" align="center"><b><?php echo ($row['finalizado_tentativa'] == null) ? '-' : $row['finalizado_tentativa']; ?></b><a href="#" onclick="zerarRegistros(<?php echo $row['id_discador'] ?>,30000);"><img id="finalizados" style="width:15px;height:15px;" src="<?php echo BASE_URL; ?>/assets/images/return.png" align="right" alt="Rediscar Finalizados" title="Rediscar Finalizados <?php echo $row['descricao']; ?>" /><a/></td>
                <td align="center"><b><?php echo ($row['finalizado'] == null) ? '-' : $row['finalizado']; ?></b></td>
                <td align="center"><b><?php echo ($row['ALO'] == null) ? '-' : $row['ALO']; ?></b></td>
                <td align="center"><b><?php echo ($row['CPC'] == null) ? '-' : $row['CPC']; ?></b></td>
        		<td align="center"><b><?php echo ($row['SUCESSO'] == null) ? '-' : $row['SUCESSO']; ?></b></td>
                <td align="center"><b><?php echo ($row['IMPRODUTIVO'] == null) ? '-' : $row['IMPRODUTIVO']; ?></b></td>
            </tr>
        <?php endforeach; ?>
    </table> <br />
</div>
</div>
</div>

