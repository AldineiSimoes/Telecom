<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/operadoras.css'>
<link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/supervisor.css'>
	
	<div class="col-lg-6 bg-primary">
			<form method="POST" id="" data-type="listMonitor" >
				<!--<label for="group">GRUPO MONITORADO - <?php echo $idgroup.' - '.$groupName ?></label>--><br>
				<select name="group"  class="form-control" style="width:300px" required>
				<?php foreach ($group_list as $g): ?>
				  <option id="opgr" value="<?php echo $g['id_grupo']; ?>" <?php ($g['id_grupo']==$idgroup)?'selected="selected"':''; ?>>
						<?php echo $g['id_grupo'].' - '.$g['descricao']; ?>
				  </option>
				<?php endforeach; ?>
				</select>
			</form>
	</div>
	
	<div class="col-lg-6 bg-primary"><br/>
		<form>
			<div class="input-group">
				<span class="input-group-addon"><a href=#>TODOS</a></span>
				<input class="form-control" style="width:300px" placeholder="Digite o nome do Agente para localiza-lo">
			</div>
		</form>
	</div>

<div class="container">
<div  class="listaAgentes">
    <div id="groupsel">
        <br/>
        <br/>
        <?php if(isset($idgroup) && !empty($idgroup)): ?>
            <?php foreach($users as $u): ?>
                <div class="phpmonitor" >
                    <?php if($u['id_estado']=='1'): ?>
                    <img class="pgpimgsup" src="<?php echo BASE_URL; ?>/assets/images/superv_barra_status_livre.png"  width="20">
                    <?php endif;?>    
                    <?php if($u['id_estado']=='6'): ?>
                        <img class="pgpimgsup" src="<?php echo BASE_URL; ?>/assets/images/superv_barra_status_clerical.png" width="20">
                    <?php endif;?>    
                    <?php if($u['id_estado']=='7'): ?>
                        <img class="pgpimgsup" src="<?php echo BASE_URL; ?>/assets/images/superv_barra_status_atendendo.png" width="20">
                    <?php endif;?>    
                    <?php if($u['id_estado']=='9'): ?>
                        <img class="pgpimgsup" src="<?php echo BASE_URL; ?>/assets/images/superv_barra_status_pausa.png" width="20">
                    <?php endif;?>    
                    <?php echo $u['nome']; ?>				
                    <?php echo $u['estado']; ?>
                </div>
          <?php endforeach; ?>
        <script type="text/javascript">
          atualizaMonitor(<?php echo $idgroup ?>)
        </script>
        <?php endif;?>
    </div>
	
</div>
<div class="grafico">
    <div class="TitGraf">Resultado do Grupo</div>
    <div>
        <canvas id="statusgraf" height="230"></canvas>
    </div>
    <div id="logados">
        <table>
            <tr id="detres2">
                <th class="detit logados"></th>
            </tr>
            <tr>
                <th class="cabres logados2">LOGADOS</th>
            </tr>
        </table>
    </div>
    <div id="fila" style="width:50px;rigth:0px;">
        <table>
            <tr id="detres3">
                <th class="detit filas"></th>
            </tr>
            <tr>
                <th class="cabres filas2">FILA</th>
            </tr>
        </table>
    </div>
</div>
<div class="statusAgentes">
    <div id="divgroupit">
        <table id="tbres" align="center" >
            <tr id="detres" align="center" width="100">
                <!--<td class="detit logados"></td>-->
                <td class="detit atendendo"></td>
                <td class="detit livres"></td>
                <td class="detit tabulando"></td>
                <td class="detit pausados"></td>
                <!--<td class="detit filas"></td>-->
            </tr>
            <tr >
                <!--<th class="cabres logados2">LOGADOS</th>-->
                <th class="cabres atendendo2">ATENDENDO</th>
                <th class="cabres livres2">LIVRES</th>
                <th class="cabres tabulando2">TABULANDO</th>
                <th class="cabres pausados2">EM PAUSA</th>
				<!--<th class="cabres filas">FILA</th>-->
            </tr>
            
        </table>
    </div>
</div>
<div id="agenteOptions">
    <div class="divMenuAgenteOptions">
        <a href=# id="escuta"><img src="<?php echo BASE_URL; ?>/assets/images/monitorar.png" class="imgAgentesOptions"> MONITORAR</a><br/>
    </div>
    <div class="divMenuAgenteOptions">
        <a href=# id="apMailing"><img src="<?php echo BASE_URL; ?>/assets/images/pie-chart.png" class="imgAgentesOptions"> AP. MAILING</a>
    </div>
	 <div class="divMenuAgenteOptions">
        <a href=# id="deslogar"><img src="<?php echo BASE_URL; ?>/assets/images/switching-user.png" class="imgAgentesOptions"> TROCAR GRUPO</a>
    </div>
    <div class="divMenuAgenteOptions">
	<a href=# id="despausar"><img src="<?php echo BASE_URL; ?>/assets/images/pauseAgente.png" class="imgAgentesOptions"> PAUSA</a>
    </div>
	
    <div class="divMenuAgenteOptions">
        <a href=# id="deslogar"><img src="<?php echo BASE_URL; ?>/assets/images/logout.png" class="imgAgentesOptions"> DESLOGAR</a>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/super.js"></script>
