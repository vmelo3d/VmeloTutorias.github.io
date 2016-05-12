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
<table width="100%" border="1" style="border-collapse: collapse;">
	<?php
		if ($consult == 0) {
			echo "<h2>Essa categoria não possui nenhum artigo!</h2>";
		}else{
			while ($res = $query->fetch()) {
	?>
		<tr align="center">
			<td width="90"><img src="img/tumb/<?= $res['tumb'];?>" width="90" height="90"></td>
			<td><h1 style="text-transform: uppercase;color: #333;"><?=titulo($res['titulo']);?></h1><p></p></td>
			<td><img src="img/icon/data.png" width="20"> <?=data($res['data']);?> <img src="img/icon/relog.png" width="20"> <?= hora($res['data']);?></td>
			<td><img src="img/icon/user.png" width="20"> <?=$res['autor'];?></td>
			<td><a title="Abrir Artigo" href="post.php?nm=<?=$res['titulo'];?>"><img src="img/icon/open.png" width="40"></a></td>
		</tr>
	<?php }} ?>	
	</table>
	</div>
	</body>
	</html>