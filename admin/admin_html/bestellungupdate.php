
<?php
include "control/connection2.php";

?>
<table class="table table-hover">

    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">essen Name</th>
        <th scope="col">essen pries</th>
        <th scope="col">kategorie</th>
        <th scope="col">descrition</th>
        <th scope="col"><a href="#">
                <img src="static/images/add.png" style="width: 40px; height: 40px; float: right"></a></th>
    </tr>
    </thead>
    <tbody>
    <?php  $query = $conn->prepare("SELECT e.*,k.kategorie_name FROM essen e 
                                        inner join 
                                        kategorie k on e.kategorie_id=k.kategorie_id");
    $query->execute();
    if(isset($_POST['change_essen'])) {
        $e_id = $_POST['e_id'];
        $e_name = $_POST['essen-Name'];
        $pries = $_POST['essen-pries'];
        $kategorie = $_POST['kategorie'];
        $description = $_POST['description'];
        echo $e_name.$kategorie.$pries.$description.$e_id;
        try {


            $query = $conn->prepare("UPDATE essen SET e_name=:e_name,e_preis=:pries,
                                    kategorie_id=:kategorie,description=:description WHERE e_id=:e_id");


            $query->execute(array("e_id"=>$e_id,"e_name"=>$e_name,"pries"=>$pries,"kategorie"=>$kategorie,"description"=>$description));

        }
        catch(PDOException $e)
        {
            echo "Fehler: " . $e->getMessage();
        }


    }
    foreach ($query as $row) {
        echo '<tr>';
        echo '<td scope="col">' . $row['e_id'] . '</td>';
        echo '<td scope="col">' . $row['e_name'] . '</td>';
        echo '<td scope="col">' . $row['e_preis'] . '</td>';
        echo '<td scope="col">' . $row['kategorie_name'] . '</td>';
        echo '<td scope="col">' . $row['description'] . '</td>';
        echo '<td scope="col"> <form  method="post"> 
                              <input type="hidden" name="e_id" value=' . $row["e_id"] . ' >
                               <input type="submit" name="update_essen" class="btn btn-danger btn-sm" value="update">
                               </form></td>';
        echo '</tr>';

    }
    echo  '</tbody></table>';

    if(isset($_POST['update_essen']))
    {    $name=$_POST['e_id'];
    $query= $conn->prepare("SELECT e.*,k.kategorie_name FROM essen e 
                                        inner join 
                                        kategorie k on e.kategorie_id=k.kategorie_id
                                         where e_id=:name");
    $query->execute(array("name"=>$name));
    $result=$query->fetch();

    ?>
    <div class="container">

        <h2>Essen Update</h2>

        <form class="m-1 p-1"  method="post" >

            <div class="form-group">

                <input type="text" name="essen-Name" class="form-control" value="<?php echo $result['e_name']; ?>">
            </div>
            <div class="form-group">

                <input type="text" name="essen-pries" class="form-control" value="<?php echo $result['e_preis'] ;?>" >
            </div>

            <select name="kategorie" class="form-control" id="exampleFormControlSelect1">
                <option value="<?php echo $result['e_id'] ?>"><?php echo $result['kategorie_name'] ?></option>

                <?php
                try{
                    $query2 = $conn->prepare("SELECT * from kategorie ");
                    $query2->execute();
                    foreach ($query2 as $row2)
                    {
                        echo '<option name="essen-idop" value='.$row2["kategorie_id"].'>'.$row2["kategorie_name"].'</option>';
                    }
                    $cnn = null;

                }catch(PDOException $e)
                {
                    echo "Fehler: " . $e->getMessage();
                }

                ?>

            </select>
            <div class="form-group">

                <input type="text" name="description" class="form-control" value="<?php echo $result['description']; ?>">
            </div>
    </div>
    <div class="form-group">
        <input type="hidden" name="e_id" value="<?php echo $_POST['e_id'] ?>">
        <input type="submit" name="change_essen" class="btn btn-primary" value="change">
    </div>

<?php }

?>