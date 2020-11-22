<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'menu':include "pages/menu.php"; break;
        case 'admin':include "admin/admin.php"; break;
        case 'update':include "admin/update-eseen.php"; break;
        case 'zahlung':include "pages/zahlung.php"; break;
        case 'message':include "pages/message.php"; break;
        case 'operations':include "control/operations.php"; break;

        default:
            include "pages/startseite.php";
    }
}
else{
    include "pages/startseite.php";
}
?>
