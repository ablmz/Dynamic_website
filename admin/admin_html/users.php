<?php
if ($_SESSION['rolle_name'] != 'Admin') {
    header('Location:../index.php');
}
include ('control/connection.php');

echo '<div class="container">
        <h1 style="float: left">Benutzer</h1>
        <div style="float: right">
        <form method="post" action="'.$_SERVER['PHP_SELF'].'?rolle_name=admin&page=users'.'" >
         <select name="find_key" id="values">
            <option value="">--Choose for find--</option>
            <option value="name">First Name</option>
            <option value="surname">Last Name</option>
            <option value="user_name">Nick name</option>
            </select>
            <input type="text" name="find_value">
            <input name="find" type="submit" class="btn btn-primary btn-sm" VALUE="Find">
            </form>
</div>
        <table class="table table-hover">
            <thead>
             <tr>
                <th scope="col">ID</th>
                <th scope="col">User Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Rolle Name</th>
                <th scope="col"><a href="?rolle_name=admin&page=user_add">
                <img src="static/images/add.png" style="width: 40px; height: 40px; float: right"></a></th>     
                      
            </tr>
            </thead>
            <tbody>';

if(isset($_POST['find'])){
    try{

        if($_POST['find_key']=='name'){
        $name=$_POST['find_value'];
        $query= $conn->prepare("SELECT * FROM user WHERE name LIKE CONCAT('%', :name, '%')");
        $query->execute(array("name"=>$name));
        }
        elseif($_POST['find_key']=='surname'){
        $surname=$_POST['find_value'];
        $query= $conn->prepare("SELECT * FROM user WHERE surname LIKE CONCAT('%', :surname, '%')");
        $query->execute(array("surname"=>$surname));
        }
        elseif($_POST['find_key']=='user_name'){
        $user_name=$_POST['find_value'];
        $query= $conn->prepare("SELECT * FROM user WHERE user_name LIKE CONCAT('%', :user_name, '%')");
        $query->execute(array("user_name"=>$user_name));
        }

        foreach ($query as $row)
        {
            echo '<tr>';
            echo '<td scope="col">'.$row['user_id'].'</td>';
            echo '<td scope="col">'.$row['user_name'].'</td>';
            echo '<td scope="col">'.$row['name'].'</td>';
            echo '<td scope="col">'.$row['surname'].'</td>';
            echo '<td scope="col">'.$row['rolle_name'].'</td>';
            echo '<td scope="col"><form method="post" action="'.$_SERVER['PHP_SELF'].'?rolle_name=admin&page=user_update" >
                              <input type="submit" name="update_user" class="btn btn-sm badge-primary" value="Update">
                              <input type="submit" name="delete_user" class="btn btn-danger btn-sm" value="Delete">
                              <input type="hidden" name="user_id" value='.$row["user_id"].'></form></td>';

            echo '</tr>';

        }
        echo '</tbody></table></div>';
        $conn=null;
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }
}
else{
    try{
        $query = $conn->prepare("SELECT * FROM user as u left join rolle as r ON u.rolle_id =r.rolle_id");
        $query->execute();
        foreach ($query as $row)
        {
            echo '<tr>';
            echo '<td scope="col">'.$row['user_id'].'</td>';
            echo '<td scope="col">'.$row['user_name'].'</td>';
            echo '<td scope="col">'.$row['name'].'</td>';
            echo '<td scope="col">'.$row['surname'].'</td>';
            echo '<td scope="col">'.$row['rolle_name'].'</td>';
            echo '<td scope="col"><img src="static/images/users/'.$row['image'].'" style="width: 50px; height: 50px;border-radius: 25px"></td>';

            echo '</tr>';

        }
        echo '</tbody></table></div>';
        $conn=null;
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }

}

?>





