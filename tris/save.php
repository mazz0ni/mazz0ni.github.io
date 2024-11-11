<?php

	$vincitore=$_GET['vincitore'];
	$nome=$_GET['nome'];
	
	if($nome!="" && $vincitore!=""){
		$lines = file('dati.txt');
		$txt="";
		foreach ($lines as $line_num => $line) 
		{
			$txt=$txt.$line;
		}
		
		$file = fopen("dati.txt", "w") or die("Unable to open file!");
		$txt = $nome.";".$vincitore."\n".$txt;
		fwrite($file, $txt);
		fclose($file);
	}

	header("Location: /php/tris/");

?>