<?php 
class ErrorsManager {
    private static $_instance = null;
    private $cssLink;
    private $cssFileId;
    private $cssCode;
    private $errorLevel;
    private $errorHandler = "gestion_erreurs";
    private $shutdown = "shutdown";
    
    private function __construct($cssLink, $errorLevel) {
        echo "<link rel=\"stylesheet\" href=\"$cssLink\" type=\"text/css\" />";
        $this->cssLink = $cssLink;
        $this->errorLevel = $errorLevel;

        error_reporting($this->errorLevel);
        set_error_handler(array($this, $this->errorHandler));
        register_shutdown_function(array($this, $this->shutdown));
    }

    public static function getInstance($codeCss, $errorLevel = 0) {
        if(is_null(self::$_instance)) {
            self::$_instance = new ErrorsManager($codeCss, $errorLevel);
        }
        return self::$_instance;
    }

    private function readCss() {
        if(empty($this->cssCode)){
            $this->cssFileId = fopen($this->cssLink, "r");
            if($this->cssFileId) {
                while($ligneCSS = fread($this->cssFileId, 1000)){
                    $this->cssCode.=$ligneCSS;
                }
            }
        }
    }
   
    private function generateErrorNumber(){
        return time()*rand(543, 9876);
    }    
    public function gestion_erreurs($type, $msg, $file, $line, $context) {
        $id = $this->generateErrorNumber();
        $this->readCss();

        switch ($type) {
            case E_ERROR:
            case E_PARSE:
            case E_CORE_ERROR:
            case E_CORE_WARNING:
            case E_COMPILE_ERROR:
            case E_COMPILE_WARNING:
            case E_USER_ERROR:
                $afficher = true;
                $journaliser = true;
                $envoyer = true;
                $type = "error";
                $description = "Erreur fatale";
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $afficher = true;
                $journaliser = true;
                $envoyer = true;
                $type = "warning";
                $description = "Avertissement";
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
                $afficher = true;
                $journaliser = true;
                $envoyer = false;
                $type = "notice";
                $description = "Remarque";
                break;
            case E_STRICT:
                $afficher = false;
                $journaliser = true;
                $envoyer = true;
                $type = "error";
                $description = "Syntaxe obsolète";
                break;
            default:
                $afficher = false;
                $journaliser = true;
                $envoyer = true;
                $type = "error";
                $description = "Erreur inconnue";
        }
        $this->consignerErreur($afficher, $journaliser, $envoyer,
                $id, $type, $description, $msg, $file, $line, $context);        
    }

    
    public function shutdown(){
        $erreur = error_get_last();
        if(!empty($erreur["type"])) {
            $this->gestion_erreurs($erreur["type"], $erreur["message"], $erreur["file"], $erreur["line"], null);
        }

        echo "</body>\n</html>";
    }
    
    private function consignerErreur($afficher, $journaliser, $envoyer,
                             $idErreur, $type, $description, $message, $fichier, $ligne, $contexte){

        if($afficher)    $this->afficherErreur ($idErreur, $type, $description, $message);
        if($journaliser) $this->journaliserErreur ($idErreur, $description, $message, $fichier, $ligne, $contexte);
        if($envoyer)     $this->emailErreur ($idErreur, $type, $description, $message, $fichier, $ligne, $contexte);
    }
    
    private function afficherErreur($idErreur, $type, $description, $message){
        echo "\n\t<div class=\"errorBox $type\">\n"
             .  "\t\t<span class=\"type\">$description numéro [$idErreur]</span>\n"
             .  "\t\t$message"
             ."\n\t</div>\n";
    }
    private function journaliserErreur($idErreur, $description, $message, $fichier, $ligne, $contexte){
        
        $message = date("d/m/Y H:i:s",time())." - IP : ".$_SERVER['REMOTE_ADDR'].
                   "numéro [$idErreur] $description::$message (dans le fichier : $fichier - ligne : $ligne";
        //Message envoyé au fichier de journalisation par défaut
        error_log($message);
    }
    private function emailErreur($idErreur, $type, $description, $message, $fichier, $ligne, $contexte){
        $corpsCourriel = "<style type=\"text/css\">"
             .  $this->cssCode
             .  "</style>"
             .  "\n\n\t<div class=\"errorBox $type\">\n"
             .  "\t\t<span class=\"type\">$description numéro [$idErreur]</span>\n"
             .  "\t\t$message"
             .  "<br />\n\t\t<span class=\"section\">dans le fichier</span>"
             .  $fichier
             .  "\n\t\t<span class=\"section\"> à la ligne</span>"
             .  $ligne
             ."\n\t</div>\n";
        
        //Message envoyé à une adresse de courriel
        $email   = "b.elhmidi@gmail.com";
        $headers = "subject  :Erreur PHP s'est produite dans les graphes GD\r\n".
                   "MIME-Version: 1.0\r\n".
                   "Content-Type: text/html; charset=UTF-8";
        error_log($corpsCourriel, 1, $email, $headers);
        
    }
}
?>

