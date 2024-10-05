<?php
// src/Service/RandomPostGenerator.php

namespace App\Service;

class RandomPostGenerator implements PostGeneratorInterface
{
    public function generateTitle(): string
    {
        $titles = [
            'Exploring the Wonders of the Universe',
            'The Future of Technology',
            'A Journey Through Time',
            'The Secrets of the Ocean',
            'The Art of Mindfulness',
        ];

        return $titles[array_rand($titles)];
    }

    public function generateContent(): string
    {
        $contents = [
            'In this post, we will explore the vast wonders of the universe and the mysteries it holds.',
            'Technology is evolving at a rapid pace, and the future holds many exciting possibilities.',
            'Join us on a journey through time as we explore the history and future of our world.',
            'The ocean is a vast and mysterious place, full of secrets waiting to be discovered.',
            'Mindfulness is an art that can help us find peace and balance in our busy lives.',
        ];

        return $contents[array_rand($contents)];
    }

    public function generatePost(): array
    {
        return [
            'title' => $this->generateTitle(),
            'content' => $this->generateContent(),
        ];
    }
}