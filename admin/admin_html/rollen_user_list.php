<?php
if ($_SESSION['rolle_name'] != 'Admin') {
    header('Location:../index.php');
}
include ('control/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $query = $conn->prepare("SELECT * FROM user as u 
                left join rolle as r ON u.rolle_id =r.rolle_id where r.rolle_id=:id ");
        $query->execute(array("id" => $id));


        echo '<div class="container">'.'
        <h1>'.$_SESSION['rolle_name'].'</h1>'.'
        <table class="table table-hover">
            <thead>
             <tr>
                <th scope="col">ID</th>
                <th scope="col">User Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Rolle Name</th>
                <th scope="col"><a href="#">
                <img src="static/images/add.png" style="width: 40px; height: 40px; float: right"></a></th>     
                      
            </tr>
            </thead>
            <tbody>';
        foreach ($query as $row) {
            echo '<tr>';
            echo '<td scope="col">' . $row['user_id'] . '</td>';
            echo '<td scope="col">' . $row['user_name'] . '</td>';
            echo '<td scope="col">' . $row['name'] . '</td>';
            echo '<td scope="col">' . $row['surname'] . '</td>';
            echo '<td scope="col">' . $row['rolle_name'] . '</td>';
            echo '<td scope="col"><form action="control/operation.php" method="post">
                              <input type="submit" name="delete_rolle_user" class="btn btn-danger btn-sm" value="Delete">
                              <input type="hidden" name="id" value=' . $row["user_id"] . '>
                              <input type="hidden" name="rolle_id" value=' . $row["rolle_id"] . ' ></form></td>';
            echo '</tr>';

        }
        echo '</tbody></table></div>';
        $conn = null;
    } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
}
?>






