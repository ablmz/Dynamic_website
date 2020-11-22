<h1>bestellung delete</h1>

<?php include "control/connection2.php";

if(isset($_POST['Delete'])) {

    $id = $_POST['deleteid'];
    $query = $conn->prepare("UPDATE bestellung SET active=0 WHERE b_id=:id ");
    $query->execute(array("id" => $id));

}
//*********  ASIM BESTELLUNG DELETE ************

echo '<div class="container" >
      
        <table class="table table-hover"  >
            <thead>
             <tr>  
                <th scope="col">Bestellung ID</th>
                <th scope="col">Vorname</th>
                <th scope="col">Nachname</th>
                <th scope="col">Gesamtpreis</th>
                <th scope="col"><a href="#">
            </tr>
            </thead>
            <tbody>';

try {
    $query = $conn->prepare("SELECT b.b_id,k.k_vorname,k.k_nachname,b.gesamtpreis FROM bestellung as b INNER join kunden as k on b.k_id=k.K_id WHERE active=1");
    $query->execute();
    foreach ($query as $row) {


        echo '<tr>';
        echo '<td scope="col">' .$row['b_id'] . '</td>';
        echo '<td scope="col">' . $row['k_vorname'] . '</td>';
        echo '<td scope="col">' . $row['k_nachname'] . '</td>';
        echo '<td scope="col">' . $row['gesamtpreis'] . '</td>';

        echo '<td scope="col"><form method="post" action="#">
           <input type="hidden" name="deleteid" value="' .$row['b_id'] . '"> 
           <input type="submit" name="Delete" class="btn btn-danger btn-sm" value="Delete">
                             
            </form></td>';
        echo '</tr>';

    }
    echo '</tbody></table></div>';

}

catch(PDOException $e)
{
    echo "Fehler: " . $e->getMessage();
}

?>
