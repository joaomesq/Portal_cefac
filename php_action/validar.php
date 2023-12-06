<?php
session_start();

	if (isset($_GET['sair'])) {
		// code...
		session_unset();
	}
	

if( !$_SESSION['logado']):
	header("Location: login.php");
else:
	$id = "Sucesso"; 
endif;

