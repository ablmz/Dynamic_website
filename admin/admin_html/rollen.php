<?php
if($_SESSION['rolle_name']!='Admin'){
    header('Location:../index.php');
}
include ('control/connection.php');

echo '<div class="container">
        <h1>Rollen</h1>
        <table class="table table-hover">
            <thead>
             <tr>
                <th scope="col">ID</th>
                <th scope="col">Rolle Name</th>
                <th scope="col">User Number</th>               
                <th scope="col"><a href="?rolle_name=admin&page=rolle_add">
                <img src="static/images/add.png" style="width: 40px; height: 40px; float: right"></a> </th>     
                      
            </tr>
            </thead>
            <tbody>';
try{
    $query = $conn->prepare("SELECT r.rolle_id,r.rolle_name, COUNT(u.rolle_id) as number from rolle r 
    LEFT JOIN user u ON r.rolle_id=u.rolle_id GROUP BY r.rolle_id");
    $query->execute();
    foreach ($query as $row)
    {
        echo '<tr>';
        echo '<td scope="col">'.$row['rolle_id'].'</td>';
        echo '<td scope="col">'.$row['rolle_name'].'</td>';
        echo '<td scope="col">'.$row['number'].'</td>';
        echo '<td scope="col"><form action="control/operation.php" method="post">
                              <input type="submit" name="update_rolle" class="btn btn-sm badge-primary" value="Update">
                              <input type="submit" name="delete_rolle" class="btn btn-danger btn-sm" value="Delete">
                              <input type="submit" name="rollen_user" class="btn btn-info btn-sm" value="List">
                              <input type="hidden" name="id" value='.$row["rolle_id"].'></form></td>';

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





