<?php

namespace Ekyna\Bundle\BlogBundle\Model;

use Ekyna\Bundle\AdminBundle\Model\TranslatableInterface;
use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Interface CategoryInterface
 * @package Ekyna\Bundle\BlogBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface CategoryInterface extends
    Cms\SeoSubjectInterface,
    Cms\ContentSubjectInterface,
    Core\SortableInterface,
    Core\TimestampableInterface,
    Core\TaggedEntityInterface,
    TranslatableInterface
{

    /**
     * Returns the id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Sets the name.
     *
     * @param string $name
     * @return CategoryInterface|$this
     */
    public function setName($name);

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets the enabled.
     *
     * @param boolean $enabled
     * @return CategoryInterface|$this
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
     * @return CategoryInterface|$this
     */
    public function setSlug($slug);

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug();
}