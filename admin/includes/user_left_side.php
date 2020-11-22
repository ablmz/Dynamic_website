<?php

if(!isset($_SESSION['rolle'])){
    header('Location:index.ph');
}
?>
<br>

<form class="m-1 p-1">
    <div class="form-group">
        <div class="form-group p-2">
            <img src="static/images/users/<?php echo $_SESSION['image']; ?>" style="width: 160px; height: 180px; border-radius: 90px" alt="Guest">
        </div>
        <div class="form-group">
            <h6><?php echo $_SESSION['name']." ".$_SESSION['surname']."<p>".$_SESSION['rolle_name']."</p>" ?></h6>

        </div>



        <p><a class="badge badge-danger" href="control/logout.php" role="button">Log Out</a></p>
<br><br>
</form>
<?php if($_SESSION['rolle'] == 2){
    //$_SESSION['rolle']='admin';
    echo '<p><a class="btn btn-primary btn-block" href="index.php?rolle_name=admin">Admin Page</a></p>';
    echo '<p><a class="btn btn-primary btn-block" href="index.php?">Public Page</a></p>';

} ?>



