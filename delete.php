<html>
 <head>
  <title>DB & PHP test: DELETE</title>
 </head>
 <body>
  <?php
	$film = $_GET["film"];

	$connection = new mysqli("localhost", "root", "", "cinema");

	if ($connection->connect_error) {
		die("Errore di connessione: " . $connection->connect_error);
	}

	$stmt = $connection->prepare("DELETE FROM film WHERE TITOLO = ?");
	$stmt->bind_param("s", $film);

	if ($stmt->execute()) {
		echo "Il film $film &egrave; stato eliminato dal database.";
	} else {
		echo "Errore nell'eliminazione del film: " . $stmt->error;
	}

	$stmt->close();
	$connection->close();
  ?><br><br>
  <a href="http://localhost/cinema/index.php">
   Visualizza elenco film.
  </a>
 </body>
</html>
