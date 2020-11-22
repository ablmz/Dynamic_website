<?php
if($_SESSION['rolle_name']!='Admin'){
header('Location:../index.php');}
include ('control/connection.php');

if(isset($_POST['update_user'])) {
    $id = $_POST['user_id'];
}
    try {
        $query = $conn->prepare("SELECT u.*, r.rolle_name FROM user as u left join rolle as r ON u.rolle_id =r.rolle_id where u.user_id=:id");
        $query->execute(array("id" => $id));
        $result=$query->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }
?>

<div class="container">

    <h2>Benutzer Update</h2>

    <form class="m-1 p-1"  method="post" action="control/operation.php">

        <div class="form-group">

            <input type="text" name="usernickname" class="form-control" value="<?php echo $result['user_name'] ?>">
        </div>
        <div class="form-group">

            <input type="password" name="password" class="form-control" value="<?php echo $result['password'] ?>" >
        </div>
        <div class="form-group">

            <input type="text" name="username" class="form-control" value="<?php echo $result['name'] ?>">
        </div>
        <div class="form-group">

            <input type="text" name="usersurname" class="form-control" value="<?php echo $result['surname'] ?>">
        </div>
        <div class="form-group">

            <input type="text" name="useraddress" class="form-control" value="<?php echo $result['adress'] ?>">
        </div>
        <div class="form-group">
            <input type="text" name="userphone" class="form-control" value="<?php echo $result['phone_number'] ?>">
        </div>
        <div class="form-group">
            <input type="text" name="useremail" class="form-control" value="<?php echo $result['e_mail'] ?>">
        </div>
        <div class="form-group">

            <select name="rolleid" class="form-control" id="exampleFormControlSelect1">
                <option value="<?php echo $result['rolle_id'] ?>"><?php echo $result['rolle_name'] ?></option>

                <?php
                try{
                    $query2 = $conn->prepare("SELECT * FROM rolle");
                    $query2->execute();
                    foreach ($query2 as $row2)
                    {
                        echo '<option name="rolleidop" value='.$row2["rolle_id"].'>'.$row2["rolle_name"].'</option>';
                    }
                    $cnn = null;

                }catch(PDOException $e)
                {
                    echo "Fehler: " . $e->getMessage();
                }

                ?>

            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="update_user" class="btn btn-primary" value="Submit">
            <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'] ?>">
            <input type="reset"  class="btn btn-danger" value="Clear">

        </div>
    </form>
</div>
