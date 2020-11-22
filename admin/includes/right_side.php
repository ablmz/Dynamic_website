<?php

if (isset($_SESSION['rolle'])) {
    $rolle_id = $_SESSION['rolle'];
    $rolle_name = $_GET['rolle_name'];

    if($rolle_id == 2 && $rolle_name == 'admin'){
        include('admin_html/admin_content.php');
    }
    else {
        include('public_html/startseite.php');
    }

}
else {
    include('public_html/startseite.php');
}
?>

