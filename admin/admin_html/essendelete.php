<h1>essen delete</h1>

<?php
include "control/connection2.php";
if (isset($_POST['delete'])) {
    $query1=$conn->prepare("DELETE FROM essen where e_id=:e_id");
    $query1->execute(array('e_id'=>$_POST['essenid']));
}

echo '<table class="table table-hover">
    
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Preis</th>
        <th scope="col">Inhalt</th>
        <th>Löschen</th>

    </tr>
    </thead>
    <tbody>';
try {

    $query = $conn->prepare("SELECT * from essen");
    $query->execute();
    foreach ($query as $row) {

        echo '<tr>
        <td scope="col">' . $row["e_name"] . '</td>
        <td scope="col">' . $row["e_preis"] . '</td>
        <td scope="col">' . $row["description"] . '</td>
        <td><form method="post">
        <input type="hidden" value="'.$row["e_id"].'" name="essenid">
        <input name="delete" type="submit" class="btn btn-danger btn-sm" value="Löschen"></td>
        
        </form> 
    </tr>';
    }
}
catch(PDOException $e)
{
    echo "Fehler: " . $e->getMessage();
}


echo '</tbody></table></div>';

?>
