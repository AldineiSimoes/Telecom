<html>
	<head>
		<title>Gennex Portal</title>
        <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet" />
		<meta charset='utf8'>
		<meta name="viewport" content="width=device-width">
		
	</head>
	<body>
            <div class="container">
<!--		<div class='divimglogin'>
			<img class='imglogin' src='<?php echo BASE_URL; ?>/assets/images/fundo.jpg'>
		</div>-->
		<div class='boxlogin'>
			<div class='divlogo'>
			<img class='logotop' src='<?php echo BASE_URL; ?>/assets/images/logoold.png'>
			</div>
		<form id="Login" name="login" method="post">
			<table border-size='10px'>
				<tr>
					<td><input name="user" type="text" id="usuario" size="30"  maxlength="60" placeholder='usuario' required />
				</tr>
				<tr>
					<td><input name="password" type="password" id="senha" size="30"  maxlength="60" placeholder="senha" required />
				</tr>
<!--				<tr >
					<td class="mc"><input name="keeplive" type="checkbox" value="keeplive" /> Manter-me Conectado
				</tr>-->
				<tr>
					<td><br>
				</tr>
				<tr>
					<td class=""><input name="ENTRAR" type="submit" id="entrar" value="ENTRAR" />
	 				<?php if(isset($error) && !empty($error)): ?>
					<div class="warnig"><?php echo $error; ?></div>
					<?php endif; ?>
				</tr>
<!--				<tr>
					<td class="tdnca"><br><a href="#">Não consegue acessar?</a>
				</tr>-->
			</table>	
		</form>	
		
		</div>
		
		
	</div>	
	</body>
</html>