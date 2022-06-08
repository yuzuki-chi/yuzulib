<?php
namespace YuzuLib\YuzuLib\Scraping;

class Scraping {
    private $target_url;

    function __construct($url)
    {
        $this->target_url = $url;
    }

    function getContent()
    {
        $html = file_get_contents($this->getTargetUrl());
        var_dump($html);
    }

    function getTargetUrl(): string
    {
        return $this->target_url;
    }
}