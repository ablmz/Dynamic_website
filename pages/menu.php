
<?php include "control/connection.php";?>

<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
    <div class="container">

        <!-- bring alle Categories aus datenbank-->
        <div class="section-title">
            <h2>Unsere <span>Menü</span></h2>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="menu-flters">
                    <li data-filter="*" class="filter-active">Show All</li>
                    <?php
                    $query= $conn->prepare("SELECT * FROM kategorie");
                    $query->execute();
                    foreach ($query as $row)
                    {
                        echo '<li data-filter=".filter-'.$row["kategorie_id"].'"';
                        echo '>';
                        echo $row['kategorie_name'];
                        echo '</li>';

                    }
                    ?>
                </ul>
            </div>
        </div>

        <!--Categories end-->

        <!-- bring alle essen -->
        <div class="row menu-container">
            <?php
            $query= $conn->prepare("SELECT * FROM essen ORDER BY e_name");
            $query->execute();
            foreach ($query as $row)
            {

                echo'
                <div class="col-lg-6 menu-item filter-'.$row['kategorie_id'].'">
                    <div class="menu-content">                        
                        <a>'.$row['e_name'].'</a><span>€'.$row['e_preis'].'</span>                        
                    </div>
                    <div class="menu-ingredients">'.$row['description'].'<br>
                    <form method="post" action="?page=menu">                    
                    <input type="hidden" name="tokorbessen_id" value="'.$row['e_id'].'">
                    
                    <input type="submit" name="bestellt" class="btn btn-success btn-sm"  value="Bestellen">
                    
                    </form>
                
                </div>
                </div>';

            }
            ?>


        </div>

    </div>
</section>
<!-- End Menu Section -->

<!-- ======= Ihre Bestellungen start hier ======= -->

<hr>
<?php

if(isset($_POST['bestellt'])){
    try {
        $es_id=$_POST['tokorbessen_id'];
        $query = $conn->prepare("INSERT INTO warenkorb (e_id) values (:esid)");
        $query->execute(array("esid" => $es_id));

        if($query){
            try{
                $query2 = $conn->prepare("SELECT w.e_id, w.w_id, e.e_name,e.e_preis  FROM warenkorb as w 
            inner join essen as e on w.e_id = e.e_id ORDER BY w.w_id");
                $query2->execute();

                echo '<div class="container">
        <h1>Ihre Bestellungen</h1>
        
            <table class="table table-hover">    
                <thead>
                       <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Preis</th>
                            <th>Löschen</th>
                       </tr>
                </thead>
                <tbody>';

                foreach ($query2 as $row2) {
                    echo '<tr>
                                    <td scope="col">' . $row2['e_name'] . '</td>
                                    <td scope="col">' . $row2['e_preis'] . '</td>
                                    <td>
                                        <form method="post" action="?page=menu">
                                            <input type="hidden" name="inkorbessen_id" value="'.$row2['e_id'].'">
                                            <input type="submit" name="delete" class="btn btn-danger btn-sm" 
                                            value="Zurücksetzen">        
                                        </form>
                                    </td>
                                </tr>';
                }
            }
            catch (PDOException $e) {
                echo "Fehler: " . $e->getMessage();
            }
            echo '</tbody></table></div>
            <div class="container">
            
            </div>';
        }
    }
    catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
}
if(isset($_POST['delete'])){

    $es_id=$_POST['inkorbessen_id'];


    try {
        $query3 = $conn->prepare("DELETE FROM warenkorb WHERE e_id =:esid");
        $query3->execute(array("esid" => $es_id));


        if($query3) {
            try {

                $query4 = $conn->prepare("SELECT w.e_id, w.w_id, e.e_name,e.e_preis  FROM warenkorb as w 
            inner join essen as e on w.e_id = e.e_id ORDER BY w.w_id");
                $query4->execute();


                echo '<div class="container">
        <h1>Ihre Bestellungen</h1> 
       
            <table class="table table-hover">    
                <thead>
                       <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Preis</th>
                            <th>Löschen</th>
                       </tr>
                </thead>
                <tbody>';

                foreach ($query4 as $row4) {
                    echo '<tr> 
                                    <td scope="col">' . $row4['e_name'] . '</td>
                                    <td scope="col">' . $row4['e_preis'] . '</td>
                                    <td>
                                        <form method="post" action="?page=menu">
                                            <input type="hidden" name="inkorbessen_id" value="' . $row4['e_id'] . '">
                                            <input type="submit" name="delete" class="btn btn-danger btn-sm" 
                                            value="Zurücksetzen">        
                                        </form>
                                    </td>
                                </tr>';
                }
            } catch (PDOException $e) {
                echo "Fehler: " . $e->getMessage();
            }
            echo '</tbody></table></div>';
        }
    }
    catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
}

?>
<div class="container"><a class="btn btn-info btn-lg" href="?page=zahlung">Zahlung</a></div>

<?php $conn = null; ?>
