<?php
/**
 * Classe articles
 * 
 * @author : Mimi Dubreuil
 * @version 1.0
 * @update 2014-07-02 
 */
class BD
{
    
    private static $instance = null;
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
    // fonction qui va servir à instancier cette classe 
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
 
}
?>