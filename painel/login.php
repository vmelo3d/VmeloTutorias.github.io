<!DOCTYPE html>
<?php
	session_start();
	require '../config/config.php';
	require '../config/fun.php';

	@$email = addslashes($_POST['email']);
	@$senha = addslashes($_POST['senha']);

	if (isset($_POST['entrar'])) {
		
		if ($email == "") {
			aviso("Preencha o campo email!");
		}elseif ($senha == "") {
			aviso("Preencha o campo senha!");
		}else{
			$query = $pdo->prepare("SELECT * FROM user WHERE email = :email AND senha = :senha");
			$query->execute(array(
				':email' => $email,
				':senha' => $senha
				));
			$consult = $query->rowCount();

			if ($consult == 0) {
				aviso("Email ou senha estão incorretos!");
			}else{
				$res = $query->fetch();
				aviso("Bem vindo!");
				$_SESSION['logado'] = true;
				$_SESSION['email'] = $res['email'];
				header("refresh:0; url=painel.php");
			}
		}

	}

?>	
<html>
<head>
	<meta charset="utf-8">
	<title>Admin - Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
<fieldset id="login">
	<form action="" method="post">
		<label><h2>Email</h2></label>
		<input type="email" name="email" size="50">
		<label><h2>Senha</h2></label>
		<input type="password" name="senha" size="50">
		<br><br>
		<input type="submit" name="entrar" value="Entrar">
	</form>
</fieldset>
</body>
</html>