<!DocType html>
<html>
	<head>
		
		<title> Plugghjälp </title>
		<meta http-equiv="Content-Type" Content="text/html;charset=UTF-8"/>
		<link rel="Stylesheet" type="text/css" href="Style.css"/>
		
	</head>
<body>
	<?php

		$host 		= "localhost";
		$dbname 	= "attempttodb";
		$username 	= "Lanke";
		$password	= "lanke";
		$dsn      	= "mysql:host=$host;dbname=$dbname";
		$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
		$pdo = new PDO($dsn, $username, $password, $attr);
	?>

	<form action="summaries.php" method="POST" align="CENTER">
			<p>
				<label for="author_name">Namn: </label>
				<input type="text" name="author_name" />
			</p>
			<p>
				<label for="title">Rubrik: </label>
				<input type="text" name="title" />
			</p>
			<p>
				<label for="content">Sammanfattning: </label>
				<input type="text" name="content" />
			</p>
			<p>
				<p>
				<label for="subject_name">Ämne: </label>
				<select name="subject_id">
					<?php
						foreach($pdo->query("SELECT * FROM subjects ORDER BY name") as $row){
							echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
						}
					?>
				</select>
				</p>
			</p>
			<input type="submit" value="Lägg till" />
	</form>
</body>
</html>