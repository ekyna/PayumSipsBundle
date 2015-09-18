<?php

namespace Ekyna\Bundle\SitemapBundle\Provider;

/**
 * Interface ProviderInterface
 * @package Ekyna\Bundle\SitemapBundle\Provider
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface ProviderInterface
{
    /**
     * Returns the last update datetime.
     *
     * @return \DateTime
     */
    public function getLastUpdateDate();

    /**
     * Returns the sitemap urls.
     *
     * @return array|\Ekyna\Bundle\SitemapBundle\Url\UrlInterface[]
     */
    public function getUrls();

    /**
     * Returns the sitemap name.
     *
     * @return null|string
     */
    public function getSitemap();

    /**
     * Returns the provider name.
     *
     * @return string
     */
    public function getName();
}
