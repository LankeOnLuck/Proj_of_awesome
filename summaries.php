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

		if(!empty($_POST)){
			if(isset($_POST['author_name']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['subject_id'])){
				if($_POST['author_name'] !== "" && $_POST['title'] !== "" && $_POST['content'] !== "" && $_POST['subject_id'] !== ""){
					$author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
					$title 		 = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
					$content     = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
					$subject_id  = filter_input(INPUT_POST, 'subject_id', FILTER_VALIDATE_INT);
					$statement = $pdo->prepare("INSERT INTO summaries (title, content, author_name, date, subject_id) VALUES (:title, :content, :author_name, NOW(), :subject_id)");
					$statement->bindParam(":title", $title);
					$statement->bindParam(":content", $content);
					$statement->bindParam(":author_name", $author_name);
					$statement->bindParam(":subject_id", $subject_id);
					if(!$statement->execute())
						print_r($statement->errorInfo());
				}
			}
			else if(isset($_POST['summary_id']) && isset($_POST['author_name']) && isset($_POST['content'])){
				if($_POST['summary_id'] !== "" && $_POST['author_name'] !== "" && $_POST['content']){
					$summary_id	 = filter_input(INPUT_POST, 'summary_id', FILTER_VALIDATE_INT);
					$author_name = filter_input(INPUT_POST, 'author_name', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
					$content     = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
					$statement = $pdo->prepare("INSERT INTO comments (date, content, summary_id, author_name) VALUES (NOW(), :content, :summary_id, :author_name)");
					$statement->bindParam(":content", $content);
					$statement->bindParam(":summary_id", $summary_id);
					$statement->bindParam(":author_name", $author_name);
					if(!$statement->execute())
						print_r($statement->errorInfo());
				}
			}
			
		}
		
		if(!empty($_GET) && isset($_GET['summary_id'])){
			if($_GET['summary_id'] !== ""){
				$summary_id = filter_input(INPUT_GET, "summary_id", FILTER_VALIDATE_INT);
				
				$sum_statement = $pdo->prepare("SELECT summaries.*, subjects.name AS 'subject_name' FROM summaries JOIN subjects ON summaries.subject_id=subjects.id WHERE summaries.id=:summary_id");
				$sum_statement->bindParam(":summary_id", $summary_id);
				if($sum_statement->execute()){
					if($row = $sum_statement->fetch()){
						echo "<h1>{$row['title']}</h1>
							<p>{$row['date']}</p>
							<p>{$row['author_name']}</p>
							<p>Ämne: {$row['subject_name']}</p>
							<p>{$row['content']}</p>
							<p><a href=\"summaries.php\">tillbaka</a></p>";
						echo "<form action=\"summaries.php?summary_id={$row['id']}\" method=\"POST\">";
						echo "<input type=\"hidden\" name=\"summary_id\" value=\"{$row['id']}\" />";
						?>
							<p>
								<label for="author_name">Ditt namn: </label>
								<input type="text" name="author_name" />
							</p>
							<p>
								<label for="content">Kommentar: </label>
								<input type="text" name="content" />
							</p>
							<input type="submit" />
						</form>
						
						<?php
						
						$com_statement = $pdo->prepare("SELECT * FROM comments WHERE summary_id=:summary_id ORDER BY date DESC");
						$com_statement->bindParam(":summary_id", $summary_id);
						if($com_statement-> execute()){
							while($comment = $com_statement->fetch()){
								echo "<p>{$comment['author_name']} ({$comment['date']}): {$comment['content']}</p>";
							}
						}
						else
							print_r($com_statement->errorInfo());
					}
				}
				else
					print_r($sum_statement->errorInfo());
					
				
				
				
			}
		}
		else{
			echo "<ul>";
			foreach($pdo->query("SELECT * FROM summaries ORDER BY date DESC") as $row)
			{
				echo "<li><a href=\"?summary_id={$row['id']}\">{$row['title']}, av {$row['author_name']} ({$row['date']})</a></li>";
			}
			echo "</ul>";
		}
		
		

	?>
</body>
</html>