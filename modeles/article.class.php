<?php

class article {
    private static $instance = null;
    private $article;
    private $idbd;
            
    private function __construct($base, $param){
        
        require_once("./conf/" . $param . ".inc.php");
        $dsn        = "mysql:host=" . HOST . ";dbname=" . $base;
        $user       = USER;
        $pass       = PASS;
        $this->idbd = new PDO($dsn, $user, $pass);
        $this->idbd->exec("SET NAMES UTF8");
        if (!$this->idbd) {
            throw new Exception("Connexion impossible à la base de données : " . $base);
        }
    }
    // fonction qui va servir pour instancier cette classe 
    public static function getInstance($base, $param)
    {
        if (is_null(self::$instance)) {
            self::$instance = new article($base, $param);
        }
        return self::$instance;
    }
    
    public function getBD()
    {
        return $this->idbd;
    }

    public function getArticle($article_ID) {
        echo "<br />Au début de getArticle, article_ID =".$article_ID."<br />";
        $req = $this->getBD()->query("SELECT article_ID,
                                               DATE_FORMAT(art_date_soumis, '%d/%m/%Y à %Hh%imin%ss')
                                                    AS date_soumission_fr,
                                               article_titre,
                                               article_contenu,
                                               art_nb_likes,
                                               art_nb_vues,
                                               art_nb_comment,
                                               article_image,
                                               categorie_ID,
                                               membre_ID,
                                               financement_ID,
                                               brevet_ID
                                        FROM articles
                                        WHERE article_ID = $article_ID");
        
        if (!$req) {
            
            
            throw new Exception("Resultat introuvable sur le serveur : " . HOST . " de article=> getArticle");
            
        } else {
            
           
            while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
                $monArticle = $article;
                $this->monArticle = $monArticle;
            }
            
        }
        
        return $this->monArticle;
/*
        
        $article = array("id"              =>$article_ID,
                         "date_soumission" => $date_soumission_fr, 
                         "titre"    => $titre, 
                         "contenu"  => $contenu,
                         "nb_likes" => $nb_likes, 
                         "nb_vues"  => $nb_vues, 
                         "nb_comment" => $nb_comment, 
                          "article_image" => $article_image, 
                          "categorie_ID" => $categorie_ID,
                          "membre_ID" => $membre_ID,
                          "financement_ID" => $financement_ID,
                          "brevet_ID" => $brevet_ID 
                        );
                
        return $article; */
    }
    public function get_articles($offset, $limit) {

        $offset = (int) $offset;
        $limit = (int) $limit;
    
        $req = $this->getBD()->prepare("SELECT article_ID,
                                               DATE_FORMAT(art_date_soumis, '%d/%m/%Y à %Hh%imin%ss')
                                                    AS date_soumission_fr,
                                               article_titre,
                                               article_contenu,
                                               art_nb_likes,
                                               art_nb_vues,
                                               art_nb_comment,
                                               article_image,
                                               categorie_ID,
                                               membre_ID,
                                               financement_ID,
                                               brevet_ID
                                        FROM articles
                                        ORDER BY art_date_soumis
                                        DESC
                                        LIMIT ?, ?");
        $req->bind_param("ii", $offset, $limit);
        $req->execute();
        $req->bind_result($article_ID, 
                          $date_soumission_fr, 
                          $titre, 
                          $contenu,
                          $nb_likes, 
                          $nb_vues, 
                          $nb_comment, 
                          $article_image, 
                          $categorie_ID,
                          $membre_ID,
                          $financement_ID,
                          $brevet_ID 
                ) ;
        while($req->fetch()) {
            $article = array("id"          =>$article_ID,
                         "date_soumission" => $date_soumission_fr, 
                         "titre"           => $titre, 
                         "contenu"         => $contenu,
                         "nb_likes"        => $nb_likes, 
                         "nb_vues"         => $nb_vues, 
                         "nb_comment"      => $nb_comment, 
                          "article_image"  => $article_image, 
                          "categorie_ID"   => $categorie_ID,
                          "membre_ID"      => $membre_ID,
                          "financement_ID" => $financement_ID,
                          "brevet_ID"      => $brevet_ID 
                        );
            $articles[] = $article;
        }
        return $articles;
    }
}	

?>