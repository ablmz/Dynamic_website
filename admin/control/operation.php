<?php include ('connection.php');
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;}

if(isset($_POST['login'])){
    $user_name=$_POST['login_name'];
    $password=$_POST['login_password'];
    if($user_name && $password)
    {
        try {

            $query = $conn->prepare("SELECT * FROM user u 
    left join rolle r on u.rolle_id = r.rolle_id
    WHERE u.user_name=:user_name and u.password=:password");
            $query->execute(array(
                "user_name" => $user_name,
                "password" => $password));
            if ( $query->rowCount() ){

                foreach( $query as $row ){


                    $_SESSION['user_name']=$row['user_name'];
                    $_SESSION['name']=$row['name'];
                    $_SESSION['surname']=$row['surname'];
                    $_SESSION['rolle']=$row['rolle_id'];
                    $_SESSION['rolle_name']=$row['rolle_name'];
                    $_SESSION['image']=$row['image'];



                }
                $conn = null;
//
                header('Location:../index.php?login=ok&rolle='.$_SESSION['rolle']);
            }


        }
        catch(PDOException $e)
        {
            echo "Fehler: " . $e->getMessage();
        }

    }

}
elseif (isset($_POST['delete_user'])){

        $id=$_POST['id'];
        try{
           $query = $conn->prepare("DELETE FROM user WHERE user_id=:id");
//            $query->bindParam(':user_id',$ad);
//            $query->execute();
            $query->execute(array("id" => $id));
            header('Location:../index.php?rolle_name=admin&page=users');
        }
        catch(PDOException $e)
        {
            echo "Fehler: " . $e->getMessage();
        }


}
elseif (isset($_POST['delete_rolle'])){

    $id=$_POST['id'];
    try{
        $query = $conn->prepare("DELETE FROM rolle WHERE rolle_id=:id");
//
        $query->execute(array("id" => $id));
        header('Location:../index.php?rolle_name=admin&page=rollen');
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}
elseif (isset($_POST['delete_rechte'])){

    $id=$_POST['id'];
    try{
        $query = $conn->prepare("DELETE FROM rechte WHERE rechte_id=:id");
//
        $query->execute(array("id" => $id));
        header('Location:../index.php?rolle_name=admin&page=rechte');
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}
elseif (isset($_POST['add_user'])){

    $usernickname = test_input($_POST["usernickname"]);
    $password = test_input($_POST["password"]);
    $username = test_input($_POST["username"]);
    $usersurname = test_input($_POST["usersurname"]);
    $useraddress = test_input($_POST["useraddress"]);
    $userphone = test_input($_POST["userphone"]);
    $useremail = test_input($_POST["useremail"]);
    $rolleid = test_input($_POST["rolleid"]);
    $image='user_foto.jpg';
    $status=1;

//  echo 'nick:'. $username.' ';
//  echo 'sur:'.$usernickname.' ';
//  echo 'pas:'. $password.' ';
//  echo 'surn:'.$usersurname.' ';
//  echo 'adres:'.$useraddress.' ';
//  echo 'mail:'.$useremail.' ';
//  echo 'rol:'.$rolleid.' ';
//  echo 'fon:'. $userphone.' ';

    try{
        $query = $conn->prepare("INSERT INTO user(user_name, name,
                surname,adress,phone_number,e_mail,rolle_id,status,password,image) VALUES (:user_name, :name,
                :surname,:adress,:phone_number,:e_mail,:rolle_id,:status,:password,:image)");
        $query->execute(array(
            "user_name" => $usernickname,
            "name" => $username,
            "surname" => $usersurname,
            "adress" => $useraddress,
            "phone_number" => $userphone,
            "e_mail" => $useremail,
            "rolle_id"=>$rolleid,
            "status"=>$status,
            "password" => $password,
            "image"=> $image

        ));
        header('Location:../index.php?rolle_name=admin&page=users');
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}
elseif (isset($_POST['add_rolle'])){


    $rolle_name = test_input($_POST["rolle_name"]);

    try{
        $query = $conn->prepare("INSERT INTO rolle(rolle_name) VALUES (:rolle_name)");
        $query->execute(array(
            "rolle_name" => $rolle_name));
        header('Location:../index.php?rolle_name=admin&page=rollen');
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}
elseif (isset($_POST['add_rechte'])){


    $rechte_name = test_input($_POST["rechte_name"]);

    try{
        $query = $conn->prepare("INSERT INTO rechte(rechte_name) VALUES (:rechte_name)");
        $query->execute(array(
            "rechte_name" => $rechte_name));
        header('Location:../index.php?rolle_name=admin&page=rechte');
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}
elseif (isset($_POST['rollen_user'])) {
    $rollen_user = test_input($_POST["id"]);
    try {
        $query= $conn->prepare('SELECT rolle_name FROM rolle WHERE rolle_id=:id');
        $query->execute(array("id"=>$rollen_user));
        foreach ($query as $row)
        {
            $_SESSION['rolle_name']=$row['rolle_name'];
        }

        header('Location:../index.php?rolle_name=admin&page=rollen_user_list&id='.$rollen_user);
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}
elseif (isset($_POST['delete_rolle_user'])){

    $id=$_POST['id'];
    $rolle_id=$_POST['rolle_id'];
    try{
        $query = $conn->prepare("UPDATE user SET rolle_id=12 WHERE user_id=:id");
//
        $query->execute(array("id" => $id));
        header('Location:../index.php?rolle_name=admin&page=rollen_user_list&id='.$rolle_id);
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}
elseif (isset($_POST['update_user'])){

    $user_id = $_POST['user_id'];
    $usernickname = test_input($_POST["usernickname"]);
    $password = test_input($_POST["password"]);
    $username = test_input($_POST["username"]);
    $usersurname = test_input($_POST["usersurname"]);
    $useraddress = test_input($_POST["useraddress"]);
    $userphone = test_input($_POST["userphone"]);
    $useremail = test_input($_POST["useremail"]);
    $rolleid = test_input($_POST["rolleid"]);

    try{
        $query = $conn->prepare("UPDATE user SET user_name=:user_name, name=:name,
                surname=:surname, adress=:adress, phone_number=:phone_number, e_mail=:e_mail, 
                rolle_id=:rolle_id, password=:password WHERE user_id=:user_id");
        $query->execute(array(
            "user_name" => $usernickname,
            "name" => $username,
            "surname" => $usersurname,
            "adress" => $useraddress,
            "phone_number" => $userphone,
            "e_mail" => $useremail,
            "rolle_id"=>$rolleid,
            "password" => $password,
            "user_id"=>$user_id


        ));
        header('Location:../index.php?rolle_name=admin&page=users');
    }
    catch(PDOException $e)
    {
        echo "Fehler: " . $e->getMessage();
    }


}


