<?php

namespace Ekyna\Bundle\SitemapBundle\Provider;

/**
 * Class AbstractProvider
 * @package Ekyna\Bundle\SitemapBundle\Provider
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function getLastUpdateDate();

    /**
     * {@inheritdoc}
     */
    abstract public function getUrls();

    /**
     * {@inheritdoc}
     */
    public function getSitemap()
    {
        return 'default';
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getName();
}
