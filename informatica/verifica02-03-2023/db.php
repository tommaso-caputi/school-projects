<?php
echo "<style>td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }</style>";
$conn = new mysqli('localhost', 'root', '', 'my_tommasocaputi');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else { 
    $sql = ["UPDATE Movimenti SET Importo = Importo + (Importo * 20 / 100)",
    		"DELETE FROM Movimenti WHERE Importo < 100"];
    $query = ["Modificare l’ importo di tutti i movimenti, aggiungendone il 20% di essi",
    		  "Eliminare tutti i movimenti con importo inferiore a 100"];
    
    echo "<h3>Prima dell' operazione</h3>";
    show_full_table($conn, "SELECT * FROM Movimenti");
    
    echo "<h4>Query: ";
    switch ($_POST['scelta']) {
      case 0:
      	echo $query[0];
        echo "</h4>";
        update($conn, $sql[0]);
        break;
      case 1:
        echo $query[1];
        echo "</h4>";
        delete($conn, $sql[1]);
        break;
    }
    
    echo "<h3>Dopo l' operazione</h3>";
    show_full_table($conn, "SELECT * FROM Movimenti");
    
    $conn->close();
}






function show_full_table($conn, $query){
	$result = $conn->query($query);
    if ($result->num_rows > 0) {
      echo "<table style='border-collapse: collapse; width: 100%;'>";
      echo "<tr>
                              <th>ID</th>
                              <th>DataRegistrazione</th>
                              <th>C_D</th>
                              <th>Causale</th>
                              <th>Importo</th>
                              <th>NumeroConto</th>
                          </tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['DataRegistrazione'] . "</td>";
        echo "<td>" . $row['C_D'] . "</td>";
        echo "<td>" . $row['Causale'] . "</td>";
        echo "<td>" . $row['Importo'] . "</td>";
        echo "<td>" . $row['NumeroConto'] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }else{
    	echo "Errore: ".$conn->error;
    }
}

function delete($conn, $query){
	if ($conn->query($query) === TRUE) {
      echo "Record eliminato con successo";
    } else {
      echo "Errore: " . $conn->error;
    }
}

function update($conn, $query){
    if ($conn->query($query) === TRUE) {
      echo "Record aggiornato con successo";
    } else {
      echo "Errore: " . $conn->error;
    }
}

?>