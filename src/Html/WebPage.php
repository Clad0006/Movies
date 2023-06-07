<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    private string $head;
    private string $title;
    private string $body;

    /**
     * @param string $title
     */
    public function __construct(string $title="")
    {
        $this->head = "";
        $this->title = $title;
        $this->body = "";
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * @param string $css
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->head .= "<style> $css </style>";
    }

    /**
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead("<link rel='stylesheet' href='$url'/>");
    }

    /**
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->head .= "<script> $js </script>";
    }

    /**
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendToHead("<script type='text/javascript' src=$url></script>");
    }

    /**
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * @return string
     */
    public function toHTML(): string
    {
        return <<<HTML
        <!DOCTYPE html>
        <HTML lang="fr">
        <head>
            $this->head
            <meta charset='UTF-8'>
            <title>$this->title</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
            <body>$this->body</body>
        </HTML>
        HTML;
    }

    /**
     * @param string $string
     * @return string
     */
    public function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_HTML5|ENT_QUOTES);
    }

    public function getLastModification()
    {
        return "Dernière modification : ".date("d/m/Y H:i:s.", getlastmod());
    }
}
