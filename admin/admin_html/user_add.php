<?php
if ($_SESSION['rolle_name'] != 'Admin') {
    header('Location:../index.php');
}
include ('control/connection.php');
try{
$query = $conn->prepare("SELECT * FROM rolle");
$query->execute();

}catch(PDOException $e)
{
    echo "Fehler: " . $e->getMessage();
}

?>

<div class="container">

<h2>Benutzer Hinzufügen</h2>

<form class="m-1 p-1"  method="post" action="control/operation.php">

    <div class="form-group">

            <input type="text" name="usernickname" class="form-control" placeholder="User Nick Name">
        </div>
    <div class="form-group">

            <input type="password" name="password" class="form-control" placeholder="Password" >
        </div>
    <div class="form-group">

        <input type="text" name="username" class="form-control" placeholder="User Name">
    </div>
    <div class="form-group">

        <input type="text" name="usersurname" class="form-control" placeholder="User Surname">
    </div>
    <div class="form-group">

        <input type="text" name="useraddress" class="form-control" placeholder="Adress">
    </div>
    <div class="form-group">
        <input type="text" name="userphone" class="form-control" placeholder="Phone Number">
    </div>
    <div class="form-group">
        <input type="text" name="useremail" class="form-control" placeholder="E-mail">
    </div>
    <div class="form-group">

        <select name="rolleid" class="form-control" id="exampleFormControlSelect1">
            <option value="">--Please choose an Rolle--</option>
            <?php
            foreach ($query as $row)
                {
                   echo '<option name="rolleidop" value='.$row["rolle_id"].'>'.$row["rolle_name"].'</option>';
                }
            $cnn = null;
            ?>

        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="add_user" class="btn btn-primary" value="Submit">
        <input type="reset"  class="btn btn-danger" value="Clear">

    </div>
    </form>
</div>