<?php

namespace Ekyna\Bundle\SitemapBundle\Provider;

/**
 * Interface ProviderRegistryInterface
 * @package Ekyna\Bundle\SitemapBundle\Provider
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface ProviderRegistryInterface
{
    /**
     * Registers the provider.
     *
     * @param ProviderInterface $provider
     *
     * @throws \InvalidArgumentException
     */
    public function addProvider(ProviderInterface $provider);

    /**
     * Returns the registered providers by sitemap.
     *
     * @param string $sitemap
     *
     * @return ProviderInterface[]
     */
    public function getProvidersBySitemap($sitemap);

    /**
     * Returns the registered providers.
     *
     * @return ProviderInterface[]
     */
    public function getProviders();

    /**
     * Returns the sitemaps.
     *
     * @return array
     */
    public function getSitemaps();
}
