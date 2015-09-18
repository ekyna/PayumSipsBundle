<?php

namespace Ekyna\Bundle\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Bundle\BlogBundle\Model\CategoryInterface;
use Ekyna\Bundle\BlogBundle\Model\PostInterface;
use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Class Post
 * @package Ekyna\Bundle\BlogBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Post implements PostInterface
{
    use Cms\SeoSubjectTrait;
    use Cms\ContentSubjectTrait;
    use Cms\TagsSubjectTrait;
    use Core\TimestampableTrait;
    use Core\TaggedEntityTrait;

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
    protected $subTitle;

    /**
     * @var \DateTime
     */
    protected $publishedAt;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var string
     */
    protected $slug;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->seo = new Seo();
        $this->contents = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * {@inheritdoc}
     */
    public function setPublishedAt(\DateTime $publishedAt = null)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityTags()
    {
        return array($this->getEntityTag(), $this->category->getEntityTag());
    }

    /**
     * {@inheritdoc}
     */
    public static function getEntityTagPrefix()
    {
        return 'ekyna_blog.post';
    }
}
