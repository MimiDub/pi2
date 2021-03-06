
<?php
    
include_once('./modeles/article.class.php');

try {
    $bdd = article::getInstance("e1395254", "dbconnect");
    
    
    if (!$bdd) {
        throw new Exception("Connexion Impossible à la base de données : " . HOST);
        
    }
    // Mon article est un Array contenant toutes les données pour l'article demandé sous forme : 
    /* $monArticle = array(  0  "id"                =>$article_ID,
                             1  "date_soumission"  => $date_soumission_fr, 
                             2  "titre"            => $titre, 
                             3  "contenu"          => $contenu,
                             4  "nb_likes"         => $nb_likes, 
                             5  "nb_vues"          => $nb_vues, 
                             6  "nb_comment"       => $nb_comment, 
                             7  "article_image"   => $article_image, 
                             8  "categorie_ID"    => $categorie_ID,
                             9  "membre_ID"       => $membre_ID,
                            10  "financement_ID"  => $financement_ID,
                            11  "brevet_ID"       => $brevet_ID 
                        ); */
    $monArticle = $bdd->getArticle("22");
    
    $ID = $monArticle["article_ID"];
    $date = $monArticle["date_soumission_fr"];
    $titre = $monArticle["article_titre"];
    $contenu = $monArticle["article_contenu"];
    $categorie = $monArticle["categorie_ID"];
    $financement = $monArticle["financement_ID"];
    $brevet = $monArticle["brevet_ID"];
    
    include_once('./vues/content/articleVue.php');
    
}
catch (Exception $e) {
    echo $e->getMessage();
}


	
  