<html>
  <head>
    <title>DB & PHP test: UPLOAD</title>
  </head>
  <body>
   <?php
	if ($_FILES["film"]["error"] == UPLOAD_ERR_OK) {
		$connection = new mysqli("localhost", "root", "", "cinema");
		if ($connection->connect_error) {
			die("Errore di connessione con il DBMS: " . $connection->connect_error);
		}

		$command = $connection->prepare("INSERT INTO film (TITOLO, ANNO, REGISTA, NAZIONALITA, PRODUZIONE, DISTRIBUZIONE, DURATA, COLORE, TRAMA, VALUTAZIONE, ID_GENERE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$command) {
			die("Errore nella preparazione della query: " . $connection->error);
		}

		$personaggi = file($_FILES["film"]["tmp_name"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

		foreach ($personaggi as $linea) {
			$dati = explode(",", $linea);

			if (count($dati) !== 11) {
				echo "Errore nel formato del file: ogni riga deve contenere esattamente 11 valori.<br>";
				continue;
			}

			$titolo = trim($dati[0]);
			$anno = intval(trim($dati[1]));
            $regista = trim($dati[2]);  
            $nazionalita = trim($dati[3]);  
            $produzione = trim($dati[4]);  
            $distribuzione = trim($dati[5]);  
			$durata = intval(trim($dati[6])); 
            $colore = trim($dati[7]); 
            $trama = trim($dati[8]); 
            $valutazione = doubleval(trim($dati[9])); 
            $id_genere= intval(trim($dati[6])); 

			if (!$command->bind_param("sissssissdi", $titolo, $anno, $regista, $nazionalita, $produzione, $distribuzione, $durata, $colore, $trama, $valutazione, $id_genere)) {
				echo "Errore nel binding dei parametri: " . $command->error . "<br>";
				continue;
			}

			if ($command->execute()) {
				echo "Il film $titolo &egrave; stato aggiunto al database.<br>";
			} else {
				echo "Errore: il film $titolo NON &egrave; stato aggiunto al database: " . $command->error . "<br>";
			}
		}

		unlink($_FILES["film"]["tmp_name"]);
		$command->close();
		$connection->close();
	} else {
		echo "Errore di caricamento del file.";
	}
    ?><br>
    
    <a href="http://localhost/cinema/index.php">Visualizza elenco film.</a>
  </body>
</html>
