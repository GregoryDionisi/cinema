<html>
  <head>
    <title>DB & PHP test</title>
  </head>
  <body>
    <?php
		$connection = @ new mysqli("localhost","root","","cinema");
		if ($connection->connect_error)
		die ("Errore di connessione con il DBMS.");
		$query = " SELECT * FROM film";
		$result = @ $connection->query($query);
		if ($connection->errno){
			@ $connection->close();
			die ("Errore nell�esecuzione della query");
		}
		if (@ $result->num_rows != 0) {
			echo "<table border>";
			echo "<tr>";
			echo "<th>ID_FILM</th>";
			echo "<th>TITOLO</th>";
            echo "<th>ANNO</th>";
            echo "<th>REGISTA</th>";
            echo "<th>NAZIONALITA</th>";
            echo "<th>PRODUZIONE</th>";
            echo "<th>DISTRIBUZIONE</th>";
            echo "<th>DURATA</th>";
            echo "<th>COLORE</th>";
            echo "<th>TRAMA</th>";
            echo "<th>VALUTAZIONE</th>";
            echo "<th>ID_GENERE</th>";
			echo "</tr>";
			while ($row = @ $result->fetch_array()) {
				echo "<tr>";
				echo "<td>$row[0]</td>";
				echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "<td>$row[5]</td>";
                echo "<td>$row[6]</td>";
                echo "<td>$row[7]</td>";
                echo "<td>$row[8]</td>";
                echo "<td>$row[9]</td>";
                echo "<td>$row[10]</td>";
                echo "<td>$row[11]</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		@ $result->free();
		@ $connection->close();
    ?><br>
     <a href="http://localhost/cinema/add.php">
      Aggiungi un film.
     </a><br>
     <a href="http://localhost/cinema/del.php">
      Elimina un film esistente.
     </a><br>
     <a href="http://localhost/cinema/upload.php">
      Carica film da file.
     </a>
  </body>
</html>

