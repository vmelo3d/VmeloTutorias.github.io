<?php
	session_start();

	unset($_SESSION['usuario']);
	unset($_SESSION['senha']);
	unset($_SESSION['autentico']);

	session_destroy();

	header("location: ../index.php");

?>