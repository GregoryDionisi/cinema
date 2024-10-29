<html>
  <head>
    <title>DB & PHP test: INSERT</title>
  </head>
  <body>
   <?php
     $titolo = $_GET["titolo"];
     $anno = $_GET["anno"];
     $regista = $_GET["regista"];
     $nazionalita = $_GET["nazionalita"];
     $produzione = $_GET["produzione"];
     $distribuzione = $_GET["distribuzione"];
     $durata = $_GET["durata"];
     $colore = $_GET["colore"];
     $trama = $_GET["trama"];
     $valutazione = $_GET["valutazione"];
     $id_genere = $_GET["id_genere"];

     $connection = new mysqli("localhost", "root", "", "cinema");


     if ($connection->connect_error) {
       die("Errore di connessione: " . $connection->connect_error);
     }

     $stmt = $connection->prepare("SELECT * FROM film WHERE TITOLO = ?");
     $stmt->bind_param("s", $descrizione);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows != 0) {
       echo "Il film $titolo &egrave; gi&agrave; presente nel database!";
     } else {
       $stmt = $connection->prepare("INSERT INTO film (TITOLO, ANNO, REGISTA, NAZIONALITA, PRODUZIONE, DISTRIBUZIONE, DURATA, COLORE, TRAMA, VALUTAZIONE, ID_GENERE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
       $stmt->bind_param("sissssissdi", $titolo, $anno, $regista, $nazionalita, $produzione, $distribuzione, $durata, $colore, $trama, $valutazione, $id_genere);
       
       if ($stmt->execute()) {
         echo "Il film $titolo &egrave; stato aggiunto al database!";
       } else {
         echo "Errore nell'aggiunta del film: " . $stmt->error;
       }
     }

     $stmt->close();
     $connection->close();
   ?><br><br>
   <a href="http://localhost/cinema/index.php">
    Visualizza elenco film.
   </a>
  </body>
</html>
