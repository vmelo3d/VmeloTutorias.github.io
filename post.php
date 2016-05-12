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

	<div id="contexto">
		<p><?= $res['content'];?></p>
	</div>

	</div>

	<br><br>

	<div id="coment">

	</div>
</body>
</html>	