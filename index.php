<!DOCTYPE html>
<?php
	require 'config/config.php';
	require 'config/fun.php';

	// Puxando categorias

	$categ = $pdo->prepare("SELECT * FROM categ ORDER BY nome ASC");
	$categ->execute();

	// Puxando ultimos Posts

	$ultpost = $pdo->prepare("SELECT * FROM artigos ORDER BY data DESC LIMIT 10");
	$ultpost->execute();
	$consultut = $ultpost->rowCount();

	// puxando posts mais acessados

	$populrpost = $pdo->prepare("SELECT * FROM artigos ORDER BY view DESC LIMIT 15");
	$populrpost->execute();

?>
<html>
<head>
	<meta charset="utf-8">
	<title>Vmelo Tutoriais</title>
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
				<td><button>Home</button></td>
				<td><button>Noticias</button></td>
				<td><button>Artigos</button></td>
				<td><button>Vídeos</button></td>
			</tr>
		</table>
	</header>
	<br><br>
	<div id="geral">

		<div id="contentcentral" style="border-radius: 5px;">
			<div class="container-fluid">
			<div class="row">
			<div class="col-md-12">
			<div class="page-header">
				<h1>
					Destaques
				</h1>
			</div>
			</div>
			</div>
			</div>
			
			<?php include 'slide.php';?>

			<br>
			<div class="container-fluid">
			<div class="row">
			<div class="col-md-12">
			<div class="page-header">
				<h1>
					Ultimos Artigos
				</h1>
			</div>
			</div>
			</div>
			</div>
			<?php
				while ($res = $ultpost->fetch()) {
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
<?php } ?>
		</div>

		<div id="search" style="border-radius: 5px;">
		<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Pesquisar
				</h1>
		</div>

		<div class="form-group" style="text-align: center;">
		<form role="form" action="busca.php">
  		<input type="text" name="busca" class="form-control" id="usr">
  		<br>
  		<button type="submit" class="btn btn-default">Buscar</button>
  		</form>
		</div>
		<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Categorias
				</h1>
			</div>
			<div class="panel panel-default">
			<?php
				while($rescateg = $categ->fetch()){
			?>	
				<div class="panel-body">
					<a href="categ.php?categ=<?= $rescateg['nome'];?>"><?= $rescateg['nome'];?></a>
				</div>
			<?php } ?>	
			</div>
		</div>
	</div>
</div>
		<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					Mais visitados
				</h1>
			</div>
			<div class="panel panel-default">
				<?php
				while ($respop = $populrpost->fetch()) {
				?>
				<div class="panel-body">
					<?= titulo($respop['titulo']);?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>

</body>
</html>