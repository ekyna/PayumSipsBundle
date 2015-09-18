<?php

namespace Ekyna\Bundle\BlogBundle\Tests\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Tests\Controller\ResourceControllerTest;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Form;

/**
 * Class PostControllerTest
 * @package Ekyna\Bundle\BlogBundle\Tests\Controller\Admin
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PostControllerTest extends ResourceControllerTest
{
    /**
     * @var string
     */
    protected $configurationId = 'ekyna_blog.post.configuration';

    /**
     * {@inheritdoc}
     */
    protected function assertList(Crawler $crawler)
    {
        $this->assertCount(11, $crawler->filter('a:contains("Blog post")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function fillNewForm(Form $form)
    {
        // General
        $form['ekyna_blog_post[title]'] = 'Test new post title';
        $form['ekyna_blog_post[subTitle]'] = 'Test new post subtitle';
        $form['ekyna_blog_post[category]']->select(2);
        $publishedAt = new \DateTime();
        $form['ekyna_blog_post[publishedAt]'] = $publishedAt->format('d/m/Y H:i');

        // Seo
        $form['ekyna_blog_post[seo][title]'] = 'Test new post seo title';
        $form['ekyna_blog_post[seo][description]'] = 'Test new post seo description';
    }

    /**
     * {@inheritdoc}
     */
    protected function assertShowAfterNew(Crawler $crawler)
    {
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test new post title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test new post subtitle")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Blog category 1")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test new post seo title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test new post seo description")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function assertShow(Crawler $crawler)
    {
        $this->assertGreaterThan(1, $crawler->filter('div.show-widget:contains("Blog post test")')->count());
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Blog post test seo title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Blog post test seo description")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function fillEditForm(Form $form)
    {
        // General
        $form['ekyna_blog_post[title]'] = 'Test edit post title';
        $form['ekyna_blog_post[subTitle]'] = 'Test edit post subtitle';
        $form['ekyna_blog_post[category]']->select(3);

        // Seo
        $form['ekyna_blog_post[seo][title]'] = 'Test edit post seo title';
        $form['ekyna_blog_post[seo][description]'] = 'Test edit post seo description';

    }

    /**
     * {@inheritdoc}
     */
    protected function assertShowAfterEdit(Crawler $crawler)
    {
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test edit post title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test edit post subtitle")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Blog category 2")'));

        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test edit post seo title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test edit post seo description")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function assertListAfterRemove(Crawler $crawler)
    {
        $this->assertCount(0, $crawler->filter('a:contains("Test edit post title")'));
    }
}
