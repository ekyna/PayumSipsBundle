<?php

namespace Ekyna\Bundle\BlogBundle\Tests\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Tests\Controller\ResourceControllerTest;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Form;

/**
 * Class CategoryControllerTest
 * @package Ekyna\Bundle\BlogBundle\Tests\Controller\Admin
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryControllerTest extends ResourceControllerTest
{
    /**
     * @var string
     */
    protected $configurationId = 'ekyna_blog.category.configuration';

    /**
     * {@inheritdoc}
     */
    protected function assertList(Crawler $crawler)
    {
        $this->assertCount(1, $crawler->filter('a:contains("Blog category 1")'));
        $this->assertCount(1, $crawler->filter('a:contains("Blog category 2")'));
        $this->assertCount(1, $crawler->filter('a:contains("Blog category 3")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function fillNewForm(Form $form)
    {
        // General
        $form['ekyna_blog_category[name]'] = 'Test new category name';
        $form['ekyna_blog_category[enabled]']->tick();

        // Seo
        $form['ekyna_blog_category[seo][title]'] = 'Test new category seo title';
        $form['ekyna_blog_category[seo][description]'] = 'Test new category seo description';
    }

    /**
     * {@inheritdoc}
     */
    protected function assertShowAfterNew(Crawler $crawler)
    {
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test new category name")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test new category seo title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test new category seo description")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function assertShow(Crawler $crawler)
    {
        $this->assertGreaterThan(1, $crawler->filter('div.show-widget:contains("Blog category test")')->count());
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Blog category test seo title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Blog category test seo description")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function fillEditForm(Form $form)
    {
        // General
        $form['ekyna_blog_category[name]'] = 'Test edit category name';

        // Seo
        $form['ekyna_blog_category[seo][title]'] = 'Test edit category seo title';
        $form['ekyna_blog_category[seo][description]'] = 'Test edit category seo description';

    }

    /**
     * {@inheritdoc}
     */
    protected function assertShowAfterEdit(Crawler $crawler)
    {
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test edit category name")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test edit category seo title")'));
        $this->assertCount(1, $crawler->filter('div.show-widget:contains("Test edit category seo description")'));
    }

    /**
     * {@inheritdoc}
     */
    protected function assertListAfterRemove(Crawler $crawler)
    {
        $this->assertCount(0, $crawler->filter('a:contains("Test edit category name")'));
    }
}
