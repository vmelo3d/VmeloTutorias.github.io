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

		<div id="contentcentral">
			<h2>Destaque!</h2>
			<hr>
			<table align="center">
			<tr align="center">
				<td><iframe width="560" height="315" src="https://www.youtube.com/embed/pZGA9ut77Ao" frameborder="0" allowfullscreen></iframe></td>
			</tr>
			</table>
			<br>
			<h2>Ultimos Posts</h2>
			<hr>
			<table align="center" width="100%">
			<?php

				if ($consultut == 0) {
					echo '<h2>Nenhum artigo encontrado!</h2>';
				}else{
					while ($res = $ultpost->fetch()) {
						$link = '<a href="post.php?nm=$res[titulo]>Ver mais</a>';
			?>
				<tr>
					<td width="90"><img src="img/tumb/<?= $res['tumb'];?>" width="90" height="90"></td>
					<td align="center"><h1><?= titulo($res['titulo']);?></h1><p><?php substr($res['content'],0,10).'...'.$link;?></p></td>
					<td><a href="post.php?nm=<?=$res['titulo'];?>"><img src="img/icon/open.png" width="40" height="40" title="Abrir Artigo!"></a></td>
				</tr>
			<?php }} ?>	
			</table>
		</div>

		<div id="search">
			<h2>Buscar no site!</h2>
			<hr>
			<table align="center">
			<tr>
			<td>
			<form action="busca.php" method="get">
				<input type="text" name="busca"></input>
				<input type="submit" value="Buscar">
			</form>
			</td>
			</tr>
			</table>
			<br>
			<h2>Categorias</h2>
			<hr>
			<?php
				while ($rescateg = $categ->fetch()) {
			?>
			<li><a href="categ.php?categ=<?=$rescateg['nome'];?>"><?= $rescateg['nome'];?></a></li>
			<?php } ?>
			<br>
			<h2>Mais acessadas</h2>
			<hr>
			<fieldset id="top">
			<?php
				while ($respop = $populrpost->fetch()) {
			?>
				<table border="1" style="border-collapse: collapse;" width="100%">
				<tr align="center">
				<td width="40"><img src="img/tumb/<?= $respop['tumb'];?>" width="40" height="40"></td><td><p><?= titulo($respop['titulo']);?></p></td>
				</tr>
				</table>
				<br>
			<?php } ?>		
			</fieldset>
		</div>
	</div>

</body>
</html>