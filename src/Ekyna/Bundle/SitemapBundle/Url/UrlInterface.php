<?php

namespace Ekyna\Bundle\SitemapBundle\Url;

/**
 * Interface UrlInterface
 * @package Ekyna\Bundle\SitemapBundle\Url
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface UrlInterface
{
    /**
     * Returns the location.
     *
     * @return string
     */
    public function getLocation();

    /**
     * Sets the location.
     *
     * @param string $location
     * @return UrlInterface|$this
     */
    public function setLocation($location);

    /**
     * Returns the lastmod.
     *
     * @return string
     */
    public function getLastmod();

    /**
     * Sets the lastmod.
     *
     * @param string $lastmod
     * @return UrlInterface|$this
     */
    public function setLastmod($lastmod);

    /**
     * Returns the changefreq.
     *
     * @return string
     */
    public function getChangefreq();

    /**
     * Sets the changefreq.
     *
     * @param string $changefreq
     * @return UrlInterface|$this
     */
    public function setChangefreq($changefreq);

    /**
     * Returns the priority.
     *
     * @return float
     */
    public function getPriority();

    /**
     * Sets the priority.
     *
     * @param float $priority
     * @return UrlInterface|$this
     */
    public function setPriority($priority);
}
