<?php
	require 'config/config.php';
	require 'config/fun.php';

	$name = addslashes($_GET['nm']);

	if (!isset($name)) {
		aviso("Error 404");
		header("Refresh:0; url=index.php");
	}

	// pegando dados do artigo

	$query =$pdo->prepare("SELECT * FROM artigos WHERE titulo=:id");
	$query->execute(array(
		':id' => $name
		));
	$consult = $query->rowcount();

	if ($consult == 0) {
		aviso("Error 404");
		header("Refresh:0; url=index.php");
	}else{
		$res = $query->fetch();
	}

?>
<html>
<head>
	<meta charset="utf-8">
	<title><?= titulo($res['titulo']);?> - Vmelo Tutoriais</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/script.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

	<header>
		<table align="left">
			<tr>
				<td><img src="img/avatar.png" width="60px"></td>
			</tr>
		</table>

		<table width="30%" border="0" align="right">
			<tr>
				<td><a href="index.php"><button>Home</button></a></td>
				<td><button>Noticias</button></td>
				<td><button>Artigos</button></td>
				<td><button>Vídeos</button></td>
			</tr>
		</table>
	</header>

	<div id="conteudo">
		<h1><?= titulo($res['titulo']);?></h1>
		<hr>
		<table width="30%" align="center">
			<tr>
				<td><img src="img/icon/data.png" width="20"> <?= data($res['data']);?></td>
				<td><img src="img/icon/relog.png" width="20"> <?= hora($res['data']);?></td>
				<td><img src="img/icon/user.png" width="20"> <?= $res['autor'];?></td>
			</tr>
		</table>

	<?php
			// validar formulário de comentário!

		@$form['email'] = addslashes($_POST['email']);
		@$form['name'] = addslashes($_POST['nome']);
		@$form['text'] = addslashes($_POST['text']);

		if (isset($_POST['comentar'])) {
			
			if ($form['email'] == "") {
				aviso("Preencha o campo email para fazer um comentário!");
			}elseif ($form['name'] == "") {
				aviso("Preencha o campo nome para fazer um comentário!");
			}elseif ($form['text'] == "") {
				aviso("Comentário Esta Vazio!");
			}else{
				$coment = $pdo->prepare("INSERT INTO coments (nome,email,comentario,post) VALUES (:nome,:email,:coment,:post)");
				$coment->execute(array(

				':nome' => $form['name'],
				':email' => $form['email'],
				':coment' => $form['text'],
				':post' => $res['titulo']
					));
			}
		}




	?>

	<?php

		// puxando comentários do post!

	$puxarcoment = $pdo->prepare("SELECT * FROM coments WHERE post = :postagem");
	$puxarcoment->execute(array(':postagem' => $res['titulo']));
	$consultacoment = $puxarcoment->rowcount();

	?>
		<br>
	<div id="contexto">
		<p><?= $res['content'];?></p>
	</div>
		<br>
	</div>

	<br><br>

	<div id="coment">
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<form role="form" class="form-inline" action="" method="post">
				<div class="form-group">
					 
					<label for="exampleInputEmail1">
						Email
					</label>
					<input type="email" class="form-control" name="email" id="exampleInputEmail1" />
				</div>
				<div class="form-group">
					 
					<label for="exampleInputPassword1">
						Nome
					</label>
					<input type="text" class="form-control" name="nome" id="exampleInputPassword1" />
				</div>
				<div class="form-group">
					 
					<label for="exampleInputPassword1">
						Comentário
					</label>
					<textarea class="form-control custom-control" name="text" rows="3" style="resize:none"></textarea> 
				</div>
				<button type="submit" name="comentar" class="btn btn-default">
					Comentar
				</button>
			</form>
		</div>
	</div>
	</div>
	<hr>
	<?php
		if ($consultacoment == 0) {
			echo "<h2>Nenhum comentário encontrado!</h2>";
		}else{
			while ($rescoment = $puxarcoment->fetch()) {
	?>
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="media">
				 <a href="#" class="pull-left"><img alt="Bootstrap Media Preview" src="img/icon/role.png" class="media-object" /></a>
				<div class="media-body">
					<h4 class="media-heading">
						<?= $rescoment['nome'];?>
					</h4> <?= $rescoment['comentario'];?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<?php }} ?>
</div>
</div>
</body>
</html>	