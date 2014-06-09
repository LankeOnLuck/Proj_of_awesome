<!DocType html>
<html>
	<head>
		
		<title> Plugghjälp </title>
		<meta http-equiv="Content-Type" Content="text/html;charset=UTF-8"/>
		<link rel="Stylesheet" type="text/css" href="Style.css"/>
		
	</head>
<body>
	<nav>
		<ul>
			<p> 
				<a href="Index.php"><img src="Images/Home.png"> </a>
			</p>
			<p> 
				<a href="add_subject.php"><img src="Images/Lägg_Till_Ämne.png"> </a>
			</p>
			<p> 
				<a href="add_summary.php">	<img src="Images/Lägg_Till_Sammanfattning.png"> </a>
			</p>
			<p> 
				<a href="summaries.php">	<img src="Images/Sammanfattningar.png"> </a>
			</p>
		</ul>
	</nav>
	<ul id="subject_links">

	<?php

		$host 		= "localhost";
		$dbname 	= "attempttodb";
		$username 	= "Lanke";
		$password	= "lanke";
		$dsn      = "mysql:host=$host;dbname=$dbname";
		$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
		$pdo = new PDO($dsn, $username, $password, $attr);

		if(!empty($_POST))
		{
			if($_POST['subject_id'] !== "")
			{
				$_POST = null;
				$subject_name = filter_input(INPUT_POST, 'subject_name');
				$statement = $pdo->prepare("INSERT INTO subjects (name) VALUES (:subject_name)");
				$statement->bindParam(":subject_name", $subject_name);
				if(!$statement->execute())
					print_r($statement->errorInfo());
			}
		}
		echo "\"Ämnen\"";
		foreach($pdo->query("SELECT * FROM subjects ORDER BY name") as $row){	
			echo "<ul><p>{$row['name']}</p></ul>";
		}

	?>
	</ul>
</body>
</html>