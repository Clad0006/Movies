<?php

namespace Html;
class WebPage{
    private string $head = "";
    private string $title ="";
    private string $body = "";
    private string $footer="";

    /**
     * Constructeur de la classe WebPage.
     *
     *
     * @param string $title Le titre de la page.
     */
    public function __construct(string $title = '') {
        $this->title = $title;
    }

    /**
     * Retourne le contenu de la balise <head>.
     *
     * @return string Le contenu de la balise <head>.
     */
    public function getHead():string{
        return $this->head;
    }

    /**
     * Retourne le titre de la page.
     *
     * @return string Le titre de la page.
     */
    public function getTitle():string{
        return $this->title;
    }

    /**
     * @return string
     */
    public  function getFooter(): string{
        return $this->footer;
    }

    /**
     * Modifie le titre de la page.
     *
     * @param string $title Le nouveau titre de la page.
     * @return void
     */
    public function setTitle(string $title):void{
        $this->title = $title;
    }

    /**
     * Retourne le contenu de la balise <body>.
     *
     * @return string Le contenu de la balise <body>.
     */
    public function getBody():string{
        return $this->body;
    }

    /**
     * Ajoute du contenu à la balise <head>.
     *
     * @param string $content Le contenu à ajouter.
     * @return void
     */
    public function appendToHead(string $content):void{
        $this->head .= $content;
    }

    /**
     * Ajoute du code CSS à la balise <head>.
     *
     * @param string $css Le code CSS à ajouter.
     * @return void
     */
    public function appendCss(string $css):void{
        $this->head .= "<style>$css</style>";
    }

    /**
     * Ajoute un lien vers une feuille de style CSS à la balise <head>.
     *
     * @param string $url L'URL de la feuille de style CSS à ajouter.
     * @return void
     */
    public function appendCssUrl(string $url):void{
        $this->head .= "<link rel='stylesheet' type='text/css' href='$url'>";
    }

    /**
     * Ajoute du code JavaScript à la balise <head>.
     *
     * @param string $js Le code JavaScript à ajouter.
     * @return void
     */
    public function appendJs(string $js):void{
        $this->head .= "<script>$js</script>";
    }

    /**
     * Ajoute un lien vers un fichier JavaScript à la balise <head>.
     *
     * @param string $url L'URL du fichier JavaScript à ajouter.
     * @return void
     */
    public function appendJsUrl(string $url):void{
        $this->head .= "<script src='$url'></script>";
    }

    /**
     * Ajoute du contenu à la balise <body>.
     *
     * @param string $content Le contenu à ajouter.
     * @return void
     */
    public function appendContent(string $content):void{
        $this->body .= $content;
    }

    /**
     * Ajoute du contenu à la balise <footer>.
     *
     * @param string $content Le contenu à ajouter.
     * @return void
     */
    public function appendFooter(string $content):void{
        $this->footer .= $content;
    }

    /**
     * Produire la page Web complète.
     *
     * @return string La page HTML complète
     */
    public function toHTML():string{
        return <<<HTML
    <html lang="fr">
        <head>
         {$this->head}
         <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>{$this->title}</title>
        </head>
        <body>
        {$this->body}
        <div class="footer">{$this->footer}</div> 
        </body>
    </html>
    HTML;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string La chaîne à protéger
     * @return string La chaîne protégée
     */
    public function escapeString(string	$string):string{
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5,'UTF-8');
    }

    /**
     * Donner la date et l'heure de la dernière modification du script principal.
     *
     * @return string La date et l'heure de la dernière modification du script principal.
     */
    public function getLastModif() {
        $lastModified = filemtime($_SERVER['SCRIPT_FILENAME']);
        return date('d/m/Y - H:i:s', $lastModified);
    }
}
