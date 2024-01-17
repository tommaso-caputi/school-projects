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
	$count = 0;
    $sql = ["SELECT * FROM Movimenti WHERE NumeroConto = ".$_POST['numeroConto']." AND DataRegistrazione BETWEEN '".date("Y-m-d", strtotime($_POST['dataIniziale']))."' AND '".date("Y-m-d", strtotime($_POST['dataFinale']))."'",
    		"SELECT * FROM Movimenti WHERE NumeroConto = ".$_POST['numeroConto']." AND (Causale LIKE '%imposta%' OR Causale LIKE '%imposte%')",
            "SELECT * FROM Movimenti WHERE NumeroConto = ".$_POST['numeroConto']." AND Importo > ".$_POST['cifra'].""];
    $query = ["elenco dei movimenti da data a data",
    		  "elenco dei movimenti che contengono nella causale la parola “imposta” o “imposte”",
              "elenco dei movimenti aventi un importo superiore a una cifra prefissata"];
    
    for($i=1;$i<count($sql)+1;$i++){
    	
    	$result = $conn->query($sql[$i-1]);
      	echo "<h3>Query n.".$i.": ".$query[$i-1]."</h3>";
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
        } else {
        	$count++;
            echo "0 risultati";
        }
    
    }
    if($count==3){
        echo '<script>
        		alert("Numero conto inesistente!");
                window.location.href = "index.html";
        	  </script>';
    }
    
    $conn->close();
}


?>