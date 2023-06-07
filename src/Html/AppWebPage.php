<?php

declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
        $this->appendCssUrl('css/style.css');
    }

    public function toHTML(): string
    {
        return <<<HTML
        <!DOCTYPE html>
        <HTML lang="fr">
        <head>
            {$this->getHead()}
            <meta charset='UTF-8'>
            <title>{$this->getTitle()}</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
        <header class="header">
            <h1>{$this->getTitle()}</h1>
        </header>
        <div class="content">
        {$this->getBody()}
        </div>
        <footer class="footer">
            <a class="footer">{$this->getLastModification()}</a>
        </footer>
        </body>
        </HTML>
        HTML;
    }
}
