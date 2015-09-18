<?php

namespace Ekyna\Bundle\NewsBundle\Model;

use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Interface NewsInterface
 * @package Ekyna\Bundle\NewsBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface NewsInterface extends Core\TimestampableInterface, Core\TaggedEntityInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     * @return NewsInterface|$this
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set title
     *
     * @param string $title
     * @return NewsInterface|$this
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set content
     *
     * @param string $content
     * @return NewsInterface|$this
     */
    public function setContent($content);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set slug
     *
     * @param string $slug
     * @return NewsInterface|$this
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return NewsInterface|$this
     */
    public function setDate(\DateTime $date);

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate();

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return NewsInterface|$this
     */
    public function setEnabled($enabled);

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled();
}
