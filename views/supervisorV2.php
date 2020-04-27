<div id='divsuptop'>
    <div class="divform">
		<form method="POST" id="formgr" data-type="listMonitor" >
		<br/>
			<label for="group">GRUPO MONITORADO - <?php echo $idgroup.' - '.$groupName ?></label><br>
			<select name="group" id="group" required>
			<?php foreach ($group_list as $g): ?>
			  <option id="opgr" value="<?php echo $g['id_grupo']; ?>"<?php ($g['id_grupo']==$idgroup)?'selected="selected"':''; ?>>
											 <?php echo $g['id_grupo'].' - '.$g['descricao']; ?>
			  </option>
			<?php endforeach; ?>
			</select>
			<input class="buttonSelecionar" type="submit" value="Selecionar">
		</form>
		
	</div>	
    <div class="divgroup">
        <div id="divgroupit">
            <table id="tbres" align="center" >
                <tr >
                    <th class="cabres logados">Logados</th>
                    <th class="cabres atendendo">Atendendo</th>
                    <th class="cabres livres">Livres</th>
                    <th class="cabres tabulando">Tabulando</th>
                    <th class="cabres pausados">Pausados</th>
                    <th class="cabres filas">Fila</th>
                </tr>
                <tr id="detres" align="center" width="100">
                    <td class="detit logados"></td>
                    <td class="detit atendendo"></td>
                    <td class="detit livres"></td>
                    <td class="detit tabulando"></td>
                    <td class="detit pausados"></td>
                    <td class="detit filas"></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id='groupsel'>
    <?php if(isset($idgroup) && !empty($idgroup)): ?>
      <?php foreach($users as $u): ?>
        <div class="phpmonitor">
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
            <?php echo $u['nome']; ?><br>
            <?php echo $u['estado']; ?><br>

        </div>
      <?php endforeach; ?>
      <script type="text/javascript">
          atualizaMonitor(<?php echo $idgroup ?>)
      </script>
    <?php endif;?>
<div>