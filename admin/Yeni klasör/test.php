
<?php include "control/connection.php";
function bstEssenDelete($wk_id){

    try {
        $query = $conn->prepare("DELETE FROM warenkorb WHERE e_id =:wkid");
        $query->execute(array("wkid" => $wk_id));

    }
    catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }
}
function bstEssenInsert($e_id){
    $query = $conn->prepare("INSERT INTO warenkorb (e_id) values (:esid)");
    $query->execute(array("esid" => $e_id));
}
function bstWarenKorb(){
    $query = $conn->prepare("SELECT w.e_id, w.w_id, e.e_name,e.e_preis  FROM warenkorb as w 
            inner join essen as e on w.e_id = e.e_id ORDER BY w.w_id");
    $query->execute();
    return $query;
}
?>

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
            $query= $conn->prepare("SELECT * FROM essen ");
            $query->execute();
            foreach ($query as $row)
            {
                echo'<div class="col-lg-6 menu-item filter-'.$row['kategorie_id'].'">
                    <div class="menu-content">
                        <a>'.$row['e_name'].'</a><span>€'.$row['e_preis'].'</span>
                    </div>
                    <div class="menu-ingredients">'.$row['description'].'<br>
                    <form method="post" action="'.$_SERVER['PHP_SELF'].'?page=menu">
                    <input type="hidden" name="insert_id" value="'.$row['e_id'].'">
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

<!-- Ihre Bestellungen start hier-->
<hr>
<?php
// <!-- Bestellungen tabelle show ---- => POST = 'delete' hier-->

if(isset($_POST['delete'])){
    $wrnkrbeid= $_POST['wrnkrbeid'];
    try {
        $query3 = $conn->prepare("DELETE FROM warenkorb WHERE e_id =:wrnkrbeid");
        $query3->execute(array("wrnkrbeid" => $wrnkrbeid));
        //header("Location:".$_SERVER['PHP_SELF']."?page=menu");
    }
    catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }}

if(isset($_POST['bestellt']))
{
    echo '<div class="container">
<h1>Ihre Bestellungen</h1>
        <table class="table table-hover">
    
    <thead>
    <tr>
        <th scope="col">Product</th>
        <th scope="col">Preis</th>
        <th>Löschen</th>
    </tr></thead><tbody>';

    //
    $insert_id = $_POST['insert_id'];
    try {
        if(){
            $query1 = $conn->prepare("INSERT INTO warenkorb (e_id) values (:e_id)");
            $query1->execute(array("e_id" => $insert_id));
        }

        $query2 = $conn->prepare("SELECT w.e_id, w.w_id, e.e_name,e.e_preis  FROM warenkorb as w 
            inner join essen as e on w.e_id = e.e_id ORDER BY w.w_id");
        $query2->execute();
        foreach ($query2 as $row2) {
            echo '<tr>
                    <td scope="col">' . $row2['e_name'] . '</td>
                    <td scope="col">' . $row2['e_preis'] . '</td>
                    <td>
         <form method="post" action="'.$_SERVER['PHP_SELF'].'?page=menu">
        <input type="hidden" name="wrnkrbeid" value="'.$row2['e_id'].'">
        <input type="submit" name="delete" class="btn btn-danger btn-sm" value="Zurücksetzen">        
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
<button class="btn btn-info btn-lg">Zahlen</button>
</div>';
}



?>


<?php $conn = null; ?>

<?php
