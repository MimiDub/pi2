<?php
/**
 * Class Modele
 * 
 * @author 
 * @version 1.0
 * @update 2013-05-27 
 */
class BD
{
    
    private static $instance = null;
    private $idbd;
    private $monArticle;
    private $monArtPopulaire;
    
    private function __construct($base, $param){
        
        require_once("./conf/" . $param . ".inc.php");
        $dsn        = "mysql:host=" . HOST . ";dbname=" . $base;
        $user       = USER;
        $pass       = PASS;
        $this->idbd = new PDO($dsn, $user, $pass);
        $this->idbd->exec("SET NAMES UTF8");
        if (!$this->idbd) {
            throw new Exception("Connexion Impossible à la base de données : " . HOST);
        }
    }
    // fonction qui va servir pour instancier cette classe 
    public static function getInstance($base, $param)
    {
        if (is_null(self::$instance)) {
            self::$instance = new BD($base, $param);
        }
        return self::$instance;
    }
    
    public function getBD()
    {
        return $this->idbd;
    }
    
    public function get_article_acceuil(){
        
        $req = $this->getBD()->query("SELECT * FROM articles LIMIT 0,06");

        if (!$req) {
            
            
            throw new Exception("Resultat introuvable sur le serveur : " . HOST . "de get_article_accueil");
            
        } else {
            
            
            while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
                $monArticle[]     = $article;
                $this->monArticle = $monArticle;
            }
            
        }
        
        return $this->monArticle;
        
        
    }

    public function get_article_populaire(){
        
        $reqArtPopul = $this->getBD()->query("SELECT * FROM articles WHERE art_nb_vues > 0 LIMIT 0,04");
        
        
        if (!$reqArtPopul) {
            
            
            throw new Exception("Resultat introuvable sur le serveur : " . HOST . "de get_article_populaire");
            
        } else {
            
            while ($artPopulaire = $reqArtPopul->fetch(PDO::FETCH_ASSOC)) {
                    $monArtPopulaire[]     = $artPopulaire;
                    $this->monArtPopulaire = $monArtPopulaire;
            }
            
        }
        
        return $this->monArtPopulaire;
        
        
    }
    
    public function getData()
    {
        
        //fonction code Jonathan
        
    }
    
    
}
?>