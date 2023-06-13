<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * @param ?string $string
     * @return string
     */
    public function escapeString(?string $string): string
    {
        if ($string==null) {
            return "";
        } else {
            return htmlspecialchars($string, ENT_HTML5|ENT_QUOTES);
        }
    }

    public function stripTagsAndTrim(?string $text): string
    {
        if($text==null){
            return "";
        }
        else{
            $text=strip_tags($text);
            return trim($text);
        }
    }
}
