<?php
session_start();
if (isset($_SESSION['rolle'])) {
    $rolle_id = $_SESSION['rolle'];
    $rolle_name = $_GET['rolle_name'];

if($rolle_id == 2 && $rolle_name == 'admin'){
    include ('includes/admin_navi.php');
    }
else{
    include ('includes/public_navi.php');
}

}
else{
    include ('includes/public_navi.php');
} ?>