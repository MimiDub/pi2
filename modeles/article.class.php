<?php

class article {

    private $article;
    private $idbd;

    public function __construct($base, $param) {
    require_once($param.".inc.php");
            $data="mysql:host=".HOST.";dbname=".$base;
            $user=USER;
            $pass=PASS;
            try{
                    return $this->idbd = new PDO($data,$user,$pass);

            } catch(PDOException $pdoe){
                    echo "Échec de la connexion : ",$pdoe->getMessage();
                    return false;
            }
    }
    public function getIdbd(){
            return $this->idbd;
    }

    public function getArticle($articleID){

            $req = $this->getIdbd()->query("SELECT * from articles WHERE article_ID='".$articleID."'");

            if(!$req) {
                // lancer l'exception
                throw new Exception("Échec de la connexion - articleID = $articleID");

            } 
            else {
                while ($article = $req->fetch(PDO::FETCH_ASSOC)) {
                    $this->article = $article;
                }
            }
            // Retourner l'article
            return $this->article; 
    }

}	

?>