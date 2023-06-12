<?php

namespace Html;

class AppWebPage extends WebPage
{
    /**
     * Constructeur de la classe AppWebPage.
     *
     *
     * @param string $title Le titre de la page.
     */
    public function __construct(string $title = ''){
        parent::__construct($title);
        $this->appendCssUrl("/css/style.css");

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
         {$this->getHead()}
         <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>{$this->getTitle()}</title>
        </head>
        <body>
        <div class='header'>
            <h1>{$this->getTitle()}</h1>
        </div>
        <div class='content'>
            <div class='list'>
                {$this->getBody()}
            </div>
        </div>
        <div class="footer">{$this->getFooter()}</div>            
        </body>
    </html>
    HTML;
    }
}