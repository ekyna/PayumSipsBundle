<?php

namespace Ekyna\Bundle\BlogBundle\Model;

use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Interface PostInterface
 * @package Ekyna\Bundle\BlogBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface PostInterface extends
    Cms\ContentSubjectInterface,
    Cms\SeoSubjectInterface,
    Cms\TagsSubjectInterface,
    Core\TimestampableInterface,
    Core\TaggedEntityInterface
{
    /**
     * Returns the id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Sets the title.
     *
     * @param string $title
     * @return PostInterface|$this
     */
    public function setTitle($title);

    /**
     * Returns the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Sets the subTitle.
     *
     * @param string $subTitle
     * @return PostInterface|$this
     */
    public function setSubTitle($subTitle);

    /**
     * Returns the subTitle.
     *
     * @return string
     */
    public function getSubTitle();

    /**
     * Sets the published at datetime.
     *
     * @param \DateTime $publishedAt
     * @return PostInterface|$this
     */
    public function setPublishedAt(\DateTime $publishedAt = null);

    /**
     * Returns the published at datetime.
     *
     * @return \DateTime
     */
    public function getPublishedAt();

    /**
     * Sets the category.
     *
     * @param CategoryInterface $category
     * @return PostInterface|$this
     */
    public function setCategory(CategoryInterface $category);

    /**
     * Returns the category.
     *
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * Sets the slug.
     *
     * @param string $slug
     * @return PostInterface|$this
     */
    public function setSlug($slug);

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug();
}
