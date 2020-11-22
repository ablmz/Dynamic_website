<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "horizont_food_order";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Bağlantı başarılı";
}
catch(PDOException $e)
{
    echo "Fehler: " . $e->getMessage();
}
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
foreach ($query as $row) {
    echo '<tr>';
    echo '<td scope="col">' . $row['e_id'] . '</td>';
    echo '<td scope="col">' . $row['e_name'] . '</td>';
    echo '<td scope="col">' . $row['e_preis'] . '</td>';
    echo '<td scope="col">' . $row['kategorie_name'] . '</td>';
    echo '<td scope="col">' . $row['description'] . '</td>';
    echo '<td scope="col"> <form  method="get">
                              <input type="submit" name="update_essen" class="btn btn-danger btn-sm" value="update">
                              <input type="hidden" name="id" value=' . $row["e_id"] . '>
                              <input type="hidden" name="e_id" value=' . $row["e_id"] . ' ></form></td>';
    echo '</tr>';

}
echo  '</tbody></table>';

if($_GET['update_essen'])
    {    $name=$_GET['e_id'];
         $query= $conn->prepare("SELECT e.*,k.kategorie_name FROM essen e 
                                        inner join 
                                        kategorie k on e.kategorie_id=k.kategorie_id
                                         where e_id=:name");
         $query->execute(array("name"=>$name));
         $result=$query->fetch();

?>
    <div class="container">

        <h2>Benutzer Update</h2>

        <form class="m-1 p-1"  method="get" >

            <div class="form-group">

                <input type="text" name="essen Name" class="form-control" value="<?php echo $result['e_name']; ?>">
            </div>
            <div class="form-group">

                <input type="text" name="essen pries" class="form-control" value="<?php echo $result['e_preis'] ;?>" >
            </div>

                <select name="rolleid" class="form-control" id="exampleFormControlSelect1">
                    <option value="<?php echo $result['e_id'] ?>"><?php echo $result['kategorie_name'] ?></option>

                    <?php
                    try{
                        $query2 = $conn->prepare("SELECT * from kategorie ");
                        $query2->execute();
                        foreach ($query2 as $row2)
                        {
                            echo '<option name="essenidop" value='.$row2["kategorie_id"].'>'.$row2["kategorie_name"].'</option>';
                        }
                        $cnn = null;

                    }catch(PDOException $e)
                    {
                        echo "Fehler: " . $e->getMessage();
                    }

                    ?>

                </select>
                <div class="form-group">

                    <input type="text" name="kategorie" class="form-control" value="<?php echo $result['description']; ?>">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="change_essen" class="btn btn-primary" value="change">
                <input type="hidden" name="e_id" value="<?php echo $_GET['e_id'] ;?>">
            </div>
        </form>
    </div>
<?php }
if($_GET['change_essen']) {
    $name = $_GET['e_id'];
    $query = $conn->prepare("DELETE FROM `essen` WHERE e_id=:name");
    $query->execute(array("name"=>$name));
}
?>