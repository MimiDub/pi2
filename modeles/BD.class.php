
<?php
class BD {
    
    private static $instance = null;
    private $idbd;
    
    
    private function __construct($param) {
        require_once(BASE."/conf/".$param.".inc.php");
       
        $dsn  = "mysql:host=".HOST.";dbname=".DATAB;
        $user = USER;
        $pass = PASS;
        $base = DATAB;       

        try {            
		$this->idbd = new PDO($dsn,$user,$pass);
                $this->idbd->exec("SET NAMES UTF8");
                
	} catch(PDOException $pdoe) {
		echo "Echec de la connexion : ",$pdoe->getMessage();
		return FALSE;
		//exit();
	}
    }
    
    public static function getInstance($param) {
        if(is_null(self::$instance)) {
            self::$instance = new BD($param);
        }
        return self::$instance;
    }

    public function getBD(){
        return $this->idbd;
    }
    
    // Inspiré du code de Mireille Dubreuil - Bouchra El Hmidi TP2 - Programmation III
    public function getArticle($article_ID) {
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
                                        WHERE id = ?");
        
        $req->bind_param("i", $article_ID);
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

        $req->fetch();
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
                
        return $article;
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
    // exemple fonction pour vanessa pour la bd
    
     public function get_vanessa() {

            // meme chose presque que get_article 
        // c'est juste la requette qui hange

     }
      // exemple fonction pour olivier pour la bd
     public function get_olivier() {


     }
      // exemple fonction pour mimi pour la bd
    public function get_mimi() {


    }
     // exemple fonction pour jacques pour la bd
     public function get_jacques() {

        // meme chose presque que get_article 
        // c'est juste la requette qui hange
     }





}
?>
