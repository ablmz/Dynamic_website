<?php

if (isset($_SESSION['rolle'])) {
    $rolle = $_SESSION['rolle'];
    include ('user_left_side.php');

}
else{
    include ('login_left_side.php');
}
?>