<?php

namespace Ekyna\Bundle\SitemapBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SitemapControllerTest
 * @package Ekyna\Bundle\SitemapBundle\Tests\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SitemapControllerTest extends WebTestCase
{
    /**
     * Test sitemap index.
     */
    public function testIndexAction()
    {
        $client = static::createClient();

        $client->request('GET', '/sitemap.xml');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
