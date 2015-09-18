<?php

namespace Ekyna\Bundle\BlogBundle\Entity;

use Ekyna\Bundle\AdminBundle\Model\AbstractTranslation;

/**
 * Class CategoryTranslation
 * @package Ekyna\Bundle\BlogBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryTranslation extends AbstractTranslation
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name; // TODO title

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
     * Sets the name.
     *
     * @param string $name
     * @return CategoryTranslation
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the slug.
     *
     * @param string $slug
     * @return CategoryTranslation
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
