<?php

if(isset($_GET['page'])){
    $thema = $_GET['thema'];
    switch ($thema) {
        case 'bestellung':echo '<div class="alert alert-success container" role="alert">
<h6>....: Bestellungen erfolgreich :....</h6>
</div>';break;
    }
}
