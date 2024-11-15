<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TRIS</title>
		<link rel="stylesheet" href="indexcss.css">
	</head>

	<body>

		<div class="navbar">
			<a href="/tris/">TRIS</a>
			<a href="/alunnosday/">ALUNNO'S DAY</a>
			<a href="/index.html" class="logo-no-highlight"><img src="/images/logo-endless.png" class="logo-endless"></a>
			<a href="/countdown/">COUNTDOWN</a>
			<a href="/estrazione/">ESTRAZIONE</a>
		</div>

		<center>
		<div class="title">TRIS</div>
		<br><br>
		<table>
		
				<tr>
					<th><input type="button" id="0" onclick="selezione(0)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
					<th><input type="button" id="1" onclick="selezione(1)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
					<th><input type="button" id="2" onclick="selezione(2)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
				</tr>
				
				<tr>
					<th><input type="button" id="3" onclick="selezione(3)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
					<th><input type="button" id="4" onclick="selezione(4)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
					<th><input type="button" id="5" onclick="selezione(5)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
				</tr>
				
				<tr>
					<th><input type="button" id="6" onclick="selezione(6)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
					<th><input type="button" id="7" onclick="selezione(7)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
					<th><input type="button" id="8" onclick="selezione(8)" value="" style="width: 100px; height: 100px; font-size: 90"></th>
				</tr>
		
		</table>
		<br/>
		
		<div id="vincita" class="title"></div>
		<br/>
		<form action="save.php" methon="GET">
			<font class="home-text">Inserire nome: (in caso contrario nessun dato verrà salvato)</font>
			<input type="text" name="nome" value="">
			<input type="hidden" value="" name="vincitore" id="hidden-vincita">
			<input type="submit" value="Rigioca" class="replay">
		</form>
		
		<br/><br/>
		
		<div id="players">
			<font class="title">Ultime partite</font>
			<br/>
			<?php
				$i=0;
				$lines = file('dati.txt');
				foreach ($lines as $line_num => $line) 
				{	
					$parti=explode(";",$line);
					echo "<font class='home-text'>".$parti[0]." | ".$parti[1]."</font><br/>";
					$i++;
					if($i==5) break;
				}
			?>
		</div>
		</center>
		<script>
		
			var player="X";
		
			function controllo()
			{
				var vincitore="";
				
				if(document.getElementById("0").value!="" && document.getElementById("0").value==document.getElementById("1").value && document.getElementById("1").value==document.getElementById("2").value){
					vittoria(document.getElementById("0").value);
					return;
				}
				if(document.getElementById("3").value!="" && document.getElementById("3").value==document.getElementById("4").value && document.getElementById("4").value==document.getElementById("5").value){
					vittoria(document.getElementById("3").value);
					return;
				}
				if(document.getElementById("6").value!="" && document.getElementById("6").value==document.getElementById("7").value && document.getElementById("7").value==document.getElementById("8").value){
					vittoria(document.getElementById("6").value);
					return;
				}
				
				
				if(document.getElementById("0").value!="" && document.getElementById("0").value==document.getElementById("3").value && document.getElementById("3").value==document.getElementById("6").value){
					vittoria(document.getElementById("0").value);
					return;
				}
				if(document.getElementById("1").value!="" && document.getElementById("1").value==document.getElementById("4").value && document.getElementById("4").value==document.getElementById("7").value){
					vittoria(document.getElementById("1").value);
					return;
				}
				
				if(document.getElementById("2").value!="" && document.getElementById("2").value==document.getElementById("5").value && document.getElementById("5").value==document.getElementById("8").value){
					vittoria(document.getElementById("2").value);
					return;
				}
				
				
				if(document.getElementById("0").value!="" && document.getElementById("0").value==document.getElementById("4").value && document.getElementById("4").value==document.getElementById("8").value){
					vittoria(document.getElementById("0").value);
					return;
				}
				if(document.getElementById("2").value!="" && document.getElementById("2").value==document.getElementById("4").value && document.getElementById("4").value==document.getElementById("6").value){
					vittoria(document.getElementById("2").value);
					return;
				}
				
				var i;
				var trovato=0;
				for(i=0; i<9; i++)
				{
					if(document.getElementById(i).value=="") trovato=1;
				}
				
				if(trovato==0) vittoria("nessuno");
				
			}
			
			function reload()
			{
				location.reload();
			}
		
			function selezione(pos)
			{
				document.getElementById(pos).value=player;
				document.getElementById(pos).disabled="true";
				
				if(player=="X") player="O";
				else player="X";
				
				controllo();
			}
			
			function vittoria(vincitore)
			{
			
				if(vincitore=="nessuno")
				{
					document.getElementById("vincita").innerHTML="PAREGGIO";
					document.getElementById("hidden-vincita").value="PAREGGIO";
				}
				else
				{
					var i;
					
					for(i=0; i<9; i++)
					{
						document.getElementById(i).disabled="true";
					}
					
					document.getElementById("vincita").innerHTML="VINCITORE= "+vincitore;
					document.getElementById("hidden-vincita").value="VINCITORE= "+vincitore;
				}
				
				
			}
		
		</script>
	
	</body>

</html>