<?php
	session_start();
	require '../config/config.php';
	require '../config/fun.php';

	if (!isset($_SESSION['logado'])) {
		header("location: login.php");
	}

	@$tito = addslashes($_POST['titulo']);
	@$titulo = md5(time($tito)).'-'.$tito;
	@$autor = addslashes($_POST['autor']);
	@$content = $_POST['content'];
	@$tumb = $_FILES['img'];
	@$maxsize = 1024*1024*2;

	if (isset($_POST['publicar'])) {
		
		if ($titulo == "") {
			aviso("Preencha o campo titulo!");
		}elseif ($autor == "") {
			aviso("Preencha o campo autor!");
		}elseif ($tumb == "") {
			aviso("Faça o upload de uma minhatura!");
		}elseif ($content == "") {
			aviso("Nenhum conteudo foi feito!");
		}elseif ($tumb['size'] > $maxsize) {
			aviso("Imagem é muito grande!");
		}else{
			$pasta = '../img/tumb';
			$nome = md5(time($titulo)).'-'.$tumb['name'];

			move_uploaded_file($tumb['tmp_name'], $pasta.'/'.$nome);

			$insert=$pdo->prepare("INSERT INTO artigos (titulo,autor,tumb,content) VALUES (:titulo,:autor,:tumb,:content)");
			$insert->execute(array(
				':titulo' => $titulo,
				':autor' => $autor,
				':tumb' => $nome,
				':content' => $content
				));
		}

	}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Painel - Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../js/script.js"></script>
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
</head>
<body>
<a href="../config/exitsession.php"><button>Sair</button></a>

<div id="addpost">
	<form action="" method="post" enctype="multipart/form-data">
		<label><h2>Titulo</h2></label>
		<input type="text" name="titulo" size="80">
		<label><h2>Autor</h2></label>
		<input type="text" name="autor" size="40">
		<label><h2>Minhatura</h2></label>
		<input type="file" name="img">
		<label><h2>Conteudo</h2></label>
		<textarea name="content" rows="20" cols="100" style="max-width: 100%;"></textarea>
		<br><br>
		<input type="submit" name="publicar" value="Publicar">
	</form>
</div>
</body>
</html>