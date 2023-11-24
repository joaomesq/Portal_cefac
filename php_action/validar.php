<?php
session_start();

try {
	if (isset($_GET['sair'])) {
		// code...
		session_unset();
	}
	
} catch (Exception $e) {
	echo "Erro";
}

if( !$_SESSION['logado']):
	header("Location: login.php");
else:
	$id = "Sucesso"; 
endif;

