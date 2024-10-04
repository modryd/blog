<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlogPostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $blogPosts = [
            [
                'title' => 'The Future of AI: Trends to Watch',
                'content' => 'Artificial Intelligence (AI) is rapidly evolving, and its impact on various industries is undeniable. From healthcare to finance, AI is transforming the way we live and work. In this blog post, we explore the top trends in AI that you should keep an eye on in the coming years.',
                'createdAt' => new \DateTime('2023-10-01 10:00:00')
            ],
            [
                'title' => 'A Beginner\'s Guide to Web Development',
                'content' => 'Web development is a dynamic and exciting field that offers numerous opportunities for creativity and innovation. Whether you\'re looking to build your own website or start a career in tech, this guide will provide you with the essential knowledge and tools to get started.',
                'createdAt' => new \DateTime('2023-10-02 11:00:00')
            ],
            [
                'title' => '10 Tips for Effective Remote Work',
                'content' => 'Remote work has become increasingly popular, especially in the wake of the COVID-19 pandemic. While working from home offers flexibility and convenience, it also comes with its own set of challenges. Here are ten tips to help you stay productive and maintain a healthy work-life balance while working remotely.',
                'createdAt' => new \DateTime('2023-10-03 12:00:00')
            ],
            [
                'title' => 'Exploring the Wonders of Space: A Journey Through the Cosmos',
                'content' => 'Space exploration has always fascinated humanity, and recent advancements in technology have made it possible to explore the cosmos like never before. In this blog post, we take you on a journey through the wonders of space, from the mysteries of black holes to the search for extraterrestrial life.',
                'createdAt' => new \DateTime('2023-10-04 13:00:00')
            ],
            [
                'title' => 'The Importance of Mental Health Awareness',
                'content' => 'Mental health is a crucial aspect of overall well-being, yet it is often overlooked or stigmatized. In this blog post, we discuss the importance of mental health awareness, the common challenges people face, and the steps we can take to support ourselves and others in maintaining good mental health.',
                'createdAt' => new \DateTime('2023-10-05 14:00:00')
            ]
        ];

        foreach ($blogPosts as $postData) {
            $blogPost = new BlogPost();
            $blogPost->setTitle($postData['title']);
            $blogPost->setContent($postData['content']);
            $blogPost->setCreatedAt($postData['createdAt']);

            $manager->persist($blogPost);
        }

        $manager->flush();
    }
}