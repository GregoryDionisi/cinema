<html>
  <head>
   <title>DB & PHP test: DELETE</title>
  </head>
  <body>
	<?php
		$connection = new mysqli("localhost", "root", "", "cinema");

		if ($connection->connect_error) {
			die("Errore di connessione: " . $connection->connect_error);
		}

		$query = "SELECT TITOLO FROM film ORDER BY TITOLO";
		$result = $connection->query($query);

		if ($result->num_rows != 0) {
	?>
		<form action="delete.php" method="GET" ><br>
		Film da eliminare<br>
		<select name="film">
	<?php
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				echo "<option value=\"{$row['TITOLO']}\">{$row['TITOLO']}</option>";
			}
	?>
		</select><br><br>
		<input type="submit" value="Elimina">
		</form>
	<?php
		} else {
			echo "Nessun film &egrave; presente nel database.";
		}

		$connection->close();
	?>
  </body>
</html>
