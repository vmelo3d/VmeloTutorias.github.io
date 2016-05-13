<?php
	require 'config/config.php';
	require 'config/fun.php';

	$busca = addslashes($_GET['busca']);

	$query= $pdo->prepare("SELECT * FROM artigos WHERE titulo LIKE :busca");
	$query->bindValue(':busca','%'.$busca.'%');
	$query->execute();
	$consult = $query->rowCount();


?>
<html>
<head>
	<meta charset="utf-8">
	<title>Vmelo Tutoriais</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/script.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity=sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
				<td><button>Home</button></td>
				<td><button>Noticias</button></td>
				<td><button>Artigos</button></td>
				<td><button>Vídeos</button></td>
			</tr>
		</table>
	</header>
	<br><br>
	<div id="busca">
	<?php
		if ($consult == 0) {
			echo "<h2>Essa categoria não possui nenhum artigo!</h2>";
		}else{
			while ($res = $query->fetch()) {
	?>
		<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				<h2 style="text-transform: uppercase;">
					<?= titulo($res['titulo']);?>
				</h2>
				<p maxlength="10">
					<?= limitaTexto($res['content'],600);?>
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="post.php?nm=<?= $res['titulo'];?>">Ler mais</a>
				</p>
			</div>
		</div>
	</div>
</div>
	<?php }} ?>	
	</div>
	</body>
	</html>