<?php include "control/connection.php";

$kunde=1;
$mitarbeiter=1;
$gesamtkosten=0;
$last_id=0;
try {
    $query = $conn->prepare("SELECT w.e_id, w.w_id, e.e_name,e.e_preis, e.kategorie_id,e.description  
                    FROM warenkorb as w inner join essen as e on w.e_id = e.e_id ORDER BY w.w_id");
    $query->execute();
    foreach ($query as $row)
    {
        $gesamtkosten += (float)$row['e_preis'];
    }
    $query2 = $conn->prepare("INSERT INTO bestellung (k_id, m_id,gesamtpreis) 
        values (:kunde, :mitarbeiter,:preis)" );
    $query2->execute(array("kunde"=>$kunde, "mitarbeiter"=>$mitarbeiter,"preis"=>$gesamtkosten));
    $last_id = $conn->lastInsertId();


    $query4 = $conn->prepare("SELECT w.e_id, w.w_id, e.e_name,e.e_preis, e.kategorie_id,e.description  
                    FROM warenkorb as w inner join essen as e on w.e_id = e.e_id ORDER BY w.w_id");
    $query4->execute();
    foreach ($query4 as $row4)
    {
        $query3 = $conn->prepare("INSERT INTO bestelltes_essen (b_id, e_id) 
        values (:bestellung, :essen)" );
        $query3->execute(array("bestellung"=>$last_id, "essen"=>$row4['e_id']));
    }

    $query5 = $conn->prepare("DELETE FROM  warenkorb" );
    $query5->execute();

}
catch (PDOException $e) {
    echo "Fehler: " . $e->getMessage();
}

   header("Location:?page=message&thema=bestellung");


