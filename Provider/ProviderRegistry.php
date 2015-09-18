<?php

namespace Ekyna\Bundle\SitemapBundle\Provider;

/**
 * Class ProviderRegistry
 * @package Ekyna\Bundle\SitemapBundle\Provider
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ProviderRegistry implements ProviderRegistryInterface
{
    /**
     * @var array|ProviderInterface[]
     */
    private $providers;

    /**
     * @var array
     */
    private $sitemaps;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->providers = [];
        $this->sitemaps = [];
    }

    /**
     * {@inheritdoc}
     */
    public function addProvider(ProviderInterface $provider)
    {
        if (array_key_exists($provider->getName(), $this->providers)) {
            throw new \InvalidArgumentException(sprintf('Provider "%s" is already registered.', $provider->getName()));
        }
        if (!in_array($provider->getSitemap(), $this->sitemaps)) {
            $this->sitemaps[] = $provider->getSitemap();
        }
        $this->providers[$provider->getName()] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function getProvidersBySitemap($sitemap)
    {
        $providers = [];
        foreach($this->providers as $provider) {
            if ($provider->getSitemap() === $sitemap) {
                $providers[] = $provider;
            }
        }
        return $providers;
    }

    /**
     * {@inheritdoc}
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * {@inheritdoc}
     */
    public function getSitemaps()
    {
        return $this->sitemaps;
    }
}
