<?php
if($_SESSION['rolle_name']!='Admin'){
    header('Location:../index.php');
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'user_add':include('admin_html/user_add.php'); break;
        case 'rolle_add':include('admin_html/rolle_add.php');break;
        case 'rechte_add':include('admin_html/rechte_add.php');break;
        case 'users':include('admin_html/users.php');break;
        case 'rollen':include('admin_html/rollen.php');break;
        case 'rechte':include('admin_html/rechte.php');break;
        case 'rollen_user_list':include ('admin_html/rollen_user_list.php');break;
        case 'user_update':include('admin_html/user_update.php');break;
        case 'bestellungdelete':include('admin_html/bestellungdelete.php');break;
        case 'bestellungupdate':include('admin_html/bestellungupdate.php');break;
        case 'essendelete':include('admin_html/essendelete.php');break;
        default:include('admin_html/admin_startseite.php');
    }
    }
else{
    include('admin_html/admin_startseite.php');
}
    /*
     * <a href="?rolle_name=admin&page=home">Home  |</a>
    <a href="?rolle_name=admin&page=users">Benutzer</a>
    <a href="?rolle_name=admin&page=user_add">Benutzer Hinzufügen |</a>
    <a href="?rolle_name=admin&page=rollen">Rollen</a>
    <a href="?rolle_name=admin&page=rolle_add">Rolle Hinzufügen  |</a>
    <a href="?rolle_name=admin&page=rechte">Rechte</a>
    <a href="?rolle_name=admin&page=rechte_add">Recht Hinzufügen</a>

    <?php

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case 'home':
                include('pages/home.php');
                break;
            case 'users':
                include('pages/users.php');
                break;
            case 'user_add':
                include('pages/user_add.php');
                break;
            case 'rollen':
                include('pages/rollen.php');
                break;
            case 'rechte':
                include('pages/rechte.php');
                break;
            case 'rolle_add':
                include('pages/rolle_add.php');
                break;
            case 'rechte_add':
                include('pages/rechte_add.php');
                break;
            case 'operation':
                include('operation.php');
                break;
            case 'exit':
                include('pages/exit.php');
                break;
            case 'login':
                include('pages/login.php');
                break;


        }
        }
    else
        {
            include("pages/login.php");
        }









     */
