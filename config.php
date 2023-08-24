<?php
	// connection
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'mcdm_pkg';
	$db = mysqli_connect($host,$username,$password);
	if (!$db)
	{
		echo "Tidak dapat terkoneksi dengan server";
		exit();
	}
	if(!mysqli_select_db($db, $database))
	{
		echo "Tidak dapat menemukan database";
		exit();
	}
?>