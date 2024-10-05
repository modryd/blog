<?php

namespace App\Service;

use SimpleXMLElement;

class RSSPostGenerator implements PostGeneratorInterface
{
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function generatePost(): array
    {
        $rssFeed = $this->loadRssFeed();
        $size = count($rssFeed->channel->item);
        $randomIndex = rand(0, $size - 1);
        $item = $rssFeed->channel->item[$randomIndex];

        return [
            'title' => $item->title->__toString(),
            'content' => $item->description->__toString(),
        ];
    }

    private function loadRssFeed(): SimpleXMLElement
    {
        return simplexml_load_file($this->url);
    }
}