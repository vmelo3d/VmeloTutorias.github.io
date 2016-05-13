<?php
	require '../config/config.php';
	require '../config/fun.php';

	$id = addslashes($_GET['id']);

	if (isset($id)) {
		
		// selecionar artigo

		$select=$pdo->prepare("SELECT * FROM artigos WHERE id = :id");
		$select->execute(array(

			':id' => $id

			));
		$consult = $select->rowcount();

		if ($consult == 1) {
			$res = $select->fetch();
			$local = "../img/tumb".'/'.$res['tumb'];

			// Deletar artigo
			unlink($local);
			$delete = $pdo->prepare("DELETE FROM artigos WHERE id = :id");
			$delete->execute(array(

				':id' => $id

				));

			aviso("artigo excluido com sucesso!");
			header("refresh:0; url=painel.php");


		}	

	}




?>