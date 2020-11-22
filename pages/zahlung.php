<?php include "control/connection.php";?>

<!-- bring alle essen -->
<section id="menu" class="menu">
    <div class="container">
<div class="row menu-container">
    <?php
    $gesamtkosten=0;
    try {
        $query = $conn->prepare("SELECT w.e_id, w.w_id, e.e_name,e.e_preis, e.kategorie_id,e.description  FROM warenkorb as w 
            inner join essen as e on w.e_id = e.e_id ORDER BY w.w_id");
        $query->execute();
        foreach ($query as $row) {
            $gesamtkosten += (float)$row['e_preis'];
            echo '
                <div class="col-lg-6 menu-item filter-' . $row['kategorie_id'] . '">
                    <div class="menu-content">                        
                        <a>' . $row['e_name'] . '</a><span>€' . $row['e_preis'] . '</span>                        
                    </div>
                    <div class="menu-ingredients">' . $row['description'] . '<br>
                   
                
                </div>
                </div>';

        }
    }
    catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
    ?>


</div>

        <hr>

        <h1 style="float: left">Ihre gesamten Kosten: </h1>
        <span class="btn btn-lg btn-success float-lg-right">€ <?php echo $gesamtkosten ?></span>
        <div style="clear: both">
        <a class="btn btn-lg btn-primary float-lg-right" href="?page=operations">Bestellen</a>
        </div>
    </div>

