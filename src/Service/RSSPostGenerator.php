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
        try {
            $rssFeed = $this->loadRssFeed();
            $size = count($rssFeed->channel->item);
            $randomIndex = \rand(0, $size - 1);
            $item = $rssFeed->channel->item[$randomIndex];
            $post = [
                'title' => (string) $item->title,
                'content' => (string) $item->description,
            ];
        } catch (\Exception $e) {
            $msg = 'An error occurred while loading the RSS feed.' . PHP_EOL;
            $msg.= htmlspecialchars_decode($e->getMessage());
            $post = [
                'title' => 'Error loading RSS feed from: ' . $this->url,
                'content' => $msg,
            ];
        }

        return $post;
    }

    private function loadRssFeed(): SimpleXMLElement
    {
        return simplexml_load_file($this->url);
    }
}