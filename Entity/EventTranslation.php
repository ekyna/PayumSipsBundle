<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Ekyna\Bundle\AdminBundle\Model\AbstractTranslation;

/**
 * Class EventTranslation
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventTranslation extends AbstractTranslation
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $slug;

    /**
     * Returns the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the title.
     *
     * @param string $title
     * @return EventTranslation
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Returns the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the content.
     *
     * @param string $content
     * @return EventTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Returns the content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the slug.
     *
     * @param string $slug
     * @return EventTranslation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
