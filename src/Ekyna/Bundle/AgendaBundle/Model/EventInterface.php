<?php

namespace Ekyna\Bundle\AgendaBundle\Model;

use Ekyna\Bundle\AdminBundle\Model\TranslatableInterface;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Interface EventInterface|$thisInterface
 * @package Ekyna\Bundle\AgendaBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface EventInterface extends Core\TimestampableInterface, Core\TaggedEntityInterface, TranslatableInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set title
     *
     * @param string $title
     * @return EventInterface|$this
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets the content.
     *
     * @param string $content
     * @return EventInterface|$this
     */
    public function setContent($content);

    /**
     * Returns the content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Sets the startDate.
     *
     * @param \DateTime $startDate
     * @return EventInterface|$this
     */
    public function setStartDate(\DateTime $startDate);

    /**
     * Returns the startDate.
     *
     * @return \DateTime
     */
    public function getStartDate();

    /**
     * Sets the endDate.
     *
     * @param \DateTime $endDate
     * @return EventInterface|$this
     */
    public function setEndDate(\DateTime $endDate = null);

    /**
     * Returns the endDate.
     *
     * @return \DateTime
     */
    public function getEndDate();

    /**
     * Sets the enabled.
     *
     * @param boolean $enabled
     * @return EventInterface|$this
     */
    public function setEnabled($enabled);

    /**
     * Returns the enabled.
     *
     * @return boolean
     */
    public function getEnabled();

    /**
     * Sets the slug.
     *
     * @param string $slug
     * @return EventInterface|$this
     */
    public function setSlug($slug);

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug();
}
