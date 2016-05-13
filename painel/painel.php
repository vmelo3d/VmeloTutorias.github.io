<?php
	session_start();
	require '../config/config.php';
	require '../config/fun.php';

	if (!isset($_SESSION['logado'])) {
		header("location: login.php");
	}

	// Puxando Posts

	$query=$pdo->prepare("SELECT * FROM artigos ORDER BY data DESC");
	$query->execute();
	$consult = $query->rowCount();
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Painel - Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
<a href="../config/exitsession.php"><button>Sair</button></a>

<div id="container">
<a href="add_post.php"><img src="../img/icon/add.png" width="90" height="90"></a>
<br><br>
<?php
	if ($consult == 0) {
		echo '<h2>Nenhum artigo encontrado!</h2>';
	}else{
		while ($res = $query->fetch()) {
?>
<table width="100%" border="1" style="background-color: #ddd; border-collapse: collapse;">
	<tr align="center">
		<td width="60"><img src="../img/tumb/<?= $res['tumb'];?>" width="60" height="60"></td>
		<td width="300"><h2><?= titulo($res['titulo']);?></h2></td>
		<td><?= data($res['data']);?> <?= hora($res['data']);?></td>
		<td><a href="edit_post.php?id=<?= $res['Id'];?>"><img src="../img/icon/config.png" width="50" height="50"></a></td>
		<td><a href="delete.php?id=<?= $res['Id'];?>"><img src="../img/icon/del.png" width="50" height="50"></a></td>
		<td><a href="../post.php?nm=<?= $res['titulo'];?>"><img src="../img/icon/open.png" width="50" height="50"></a></td>
	</tr>
</table>
<?php }} ?>
</div>
</body>
</html>