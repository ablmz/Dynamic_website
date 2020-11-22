<?php
if($_SESSION['rolle_name']!='Admin'){
    header('Location:../index.php');
}
include ('control/connection.php');

echo '<div class="container">
        <h1>Rechte</h1>
        <table class="table table-hover">
            <thead>
             <tr>
                <th scope="col">ID</th>
                <th scope="col">Rechte Name</th>                
                <th scope="col"><a href="?rolle_name=admin&page=rechte_add">
                <img src="static/images/add.png" style="width: 40px; height: 40px; float: right"></a></th>     
                      
            </tr>
            </thead>
            <tbody>';
try{
    $query = $conn->prepare("SELECT * FROM rechte");
    $query->execute();
    foreach ($query as $row)
    {
        echo '<tr>';
        echo '<td scope="col">'.$row['rechte_id'].'</td>';
        echo '<td scope="col">'.$row['rechte_name'].'</td>';
        echo '<td scope="col"><form action="control/operation.php" method="post">
                              <input type="submit" name="update_rechte" class="btn btn-sm badge-primary" value="Update">
                              <input type="submit" name="delete_rechte" class="btn btn-danger btn-sm" value="Delete">
                              <input type="hidden" name="id" value='.$row["rechte_id"].'></form></td>';

        echo '</tr>';

    }
    echo '</tbody></table></div>';
    $conn=null;
}
catch(PDOException $e)
{
    echo "Fehler: " . $e->getMessage();
}

?>





