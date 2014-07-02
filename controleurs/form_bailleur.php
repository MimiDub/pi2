<?php


include_once('./modeles/Modele.class.php');

try {
    $bdd = BD::getInstance("eureka", "dbconnect");
    
    
    if (!$bdd) {
        throw new Exception("Connexion Impossible à la base de données : " . HOST);
    }
    // ce que la methode du modele retourn
    //$ceQueTaMethoModeleRetourn = $bdd->get_taMethodeMod();
    
    
    // filtrer le resultat retourné afin de l'envoyer a la vue(acceuil)
    /*for ($i = 0; $i < count($ceQueTaMethoModeleRetourn); $i++) {
        
        // mettre chaque resultat dans un tableau quis sera envoyer a chaque itération
        
       
        
    }*/
    
    include_once('./vues/content/form_bailleur.php');
    
}
catch (Exception $e) {
    echo $e->getMessage();
}



?>




