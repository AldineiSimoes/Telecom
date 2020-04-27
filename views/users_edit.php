<div class="container">

<h1>EDITAR</h1>
<?php if(isset($erro) && !empty($erro)): ?>
<div class="warn"><?php echo $erro; ?></div>
<?php endif;?>
<form method="POST">
	<label for="login"><h2>Login: <?php echo $user_info['login']; ?> </h2></label><br/>
	<label for="password">Senha</label><br>
	<input type="password" name="password" class="form-control"><br><br>
	<label for="usermon">Usuario para monitoria</label><br>
	<select name="usermon" id="usermon" class="form-control">
            <?php foreach ($agentes_list as $a): ?>
                <option value="<?php echo $a['username']; ?>"<?php ($a['username']==$user_info['userMon'])?'selected="selected"':''; ?>><?php echo $a['nome']; ?></option>
            <?php endforeach; ?>
	</select><br><br>
	<label for="group">Grupos de permissões</label><br>
	<select name="group" id="group" required class="form-control">
            <?php foreach ($group_list as $g): ?>
                <option value="<?php echo $g['id']; ?>" <?php ($g['id']==$user_info['idgroup'])?'selected="selected"':''; ?>><?php echo $g['name']; ?></option>
            <?php endforeach; ?>
	</select><br><br>
	<input type="submit" value="Salvar" class="btn btn-primary">


</form>
</div>