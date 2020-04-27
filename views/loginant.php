<!DOCTYPE html>
<html>
    <head>
        <title> Portal Gennex</title>
        <link href="<?php echo BASE_URL; ?>/assets/css/login.css" rel="stylesheet" />
    </head>
    <body>
        <div class="topo">
            <div class="logo">
                <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" >
            </div>
            <div class="topoint">
            </div>
        </div>
		<div class="login"> 
			<form method="POST"><h2>Bem vindo </h2>
				<input type="text" name="user" placeholder="Usuário">
				<input type="password" name="password" placeholder="Senha">
				<input type="submit" value="Entrar"><br/>
				<?php if(isset($error) && !empty($error)): ?>
				<div class="warnig"><?php echo $error; ?></div>
				<?php endif; ?>
			</form>
		</div>
    </body>
</html>

