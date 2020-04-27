<div style="margin-top:10px;position: fixed;left:5px;z-index: 1; height: 1500px;width: 1350 px; overflow-x:auto;overflow-y:auto;">
<div id='relResumo' class="w-100">
    <div class="PeriodoSel panel panel-primary" id="idResumo" style="width: 1360px;">
    <div class="panel-heading  text-center">Monitoramento de Grupos Receptivos</div>
    <table class="monitoramento table w-100"  style="text-align: center;font-size:12px;">
    <tr class="cabecalho_monitoramento panel-heading  text-center">
            <td colspan="10" align="center">OPERAÇÃO</td>
            <td colspan="4" align="center">RECEPTIVO</td>
        </tr>
        <tr class="cabecalho">
            <td class="td_monitoramento td_monitoramento_descricao" title="NOME, TIPO E CÓDIGO DO GRUPO">DESCRIÇÃO<br></td>
            <td class="td_monitoramento td_monitoramento_logados" title="TOTAL DE AGENTES LOGADOS">AGENTES<br>LOGADOS</td>
            <td class="td_monitoramento td_monitoramento_livres" title="TOTAL DE AGENTES LIVRES">AGENTES<br>LIVRES</td>
            <td class="td_monitoramento td_monitoramento_clerical" title="TOTAL DE AGENTES EM CLERICAL">AGENTES<br>CLERICAL</td>
            <td class="td_monitoramento td_monitoramento_pausa" title="TOTAL DE AGENTES EM PAUSA">AGENTES<br>PAUSADOS</td>
            <td class="td_monitoramento td_monitoramento_atendendo" title="TOTAL DE AGENTES EM ATENDIMENTO">AGENTES<br>ATENDENDO</td>
            <td class="td_monitoramento td_monitoramento_tempo_livre"title="TEMPO MÁXIMO LIVRE ATINGIDO">TEMPO<br>LIVRE</td>
            <td class="td_monitoramento td_monitoramento_tempo_clerical" title="TEMPO MÁXIMO EM CLERICAL ATINGIDO">TEMPO<br> CLERICAL</td>
            <td class="td_monitoramento td_monitoramento_tempo_medio_espera" title="TEMPO MEDIO EM ESPERA">T.MÉDIO<br>ESPERA</td>
            <td class="td_monitoramento td_monitoramento_tempo_medio_atendimento" title="TEMPO MEDIO DOS AGENTES EM ATENDIMENTO">T.MÉDIO<br>ATENDIM.</td>
            <td class="td_monitoramento td_monitoramento_livre" title="CHAMADAS EM FILA">CHAMADAS EM<br>FILA</td>
            <td class="td_monitoramento td_monitoramento_livre" title="TOTAL DE CHAMADAS RECEBIDAS">TOTAL<br>RECEBIDAS</td>
            <td class="td_monitoramento td_monitoramento_agendado" title="TOTAL ATENDIDAS">TOTAL<br>ATENDIDAS</td>
            <td class="td_monitoramento td_monitoramento_fin_limite" title="TOTAL ABANDONADAS">TOTAL<br/>ABANDONADAS</td>
        </tr>

        <?php foreach ($gruposRec as $row): ?>
            <td><?php echo $row['descricao']; ?></td>
                <td align="center"><?php echo $row['logados']; ?></td>
                <td align="center"><?php echo $row['aglivres']; ?></td>
                <td align="center"><?php echo $row['clerical']; ?></td>
                <td align="center"><?php echo $row['pausado']; ?></td>
                <td align="center"><?php echo $row['atendendo']; ?></td>
                <td align="center"><?php echo ($row['max_livre'] == null) ? '-' : htmlentities($row['max_livre']); ?></td>
                <td align="center"><?php echo ($row['max_clerical'] == null) ? '-' : htmlentities($row['max_clerical']); ?></td>
                <td align="center"><b><?php echo ($row['TME_ESPERA'] == null ) ? '-' : $row['TME_ESPERA']; ?></b></td>
                <td align="center"><b><?php echo ($row['TMA_ATENDIMENTO'] == null ) ? '-' : $row['TMA_ATENDIMENTO']; ?></b></td>
                <td align="center"><b><?php echo ($row['fila'] == null ) ? '0' : $row['fila']; ?></b></td>
                <td align="center"><b><?php echo ($row['TOTAL_ATENDIDAS'] == null ) + ($row['TOTAL_ABANDONADAS'] == null ) ? '0' : ($row['TOTAL_ATENDIDAS']) + ($row['TOTAL_ABANDONADAS']); ?></b></td>
                <td align="center"><b><?php echo ($row['TOTAL_ATENDIDAS'] == null ) ? '0' : $row['TOTAL_ATENDIDAS']; ?></b></td>
                <td align="center"><b><?php echo ($row['TOTAL_ABANDONADAS'] == null ) ? '0' : $row['TOTAL_ABANDONADAS']; ?></b></td>
            </tr>
        <?php endforeach; ?>
    </table> <br />
</div>
</div>
</div>

