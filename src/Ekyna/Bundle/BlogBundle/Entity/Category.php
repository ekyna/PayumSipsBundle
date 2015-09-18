<?php

namespace Ekyna\Bundle\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Bundle\AdminBundle\Model\AbstractTranslatable;
use Ekyna\Bundle\BlogBundle\Model\CategoryInterface;
use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Class Category
 * @package Ekyna\Bundle\BlogBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 *
 * @method CategoryTranslation translate($locale = null, $create = false)
 */
class Category extends AbstractTranslatable implements CategoryInterface
{
    use Cms\SeoSubjectTrait;
    use Cms\ContentSubjectTrait;
    use Core\SortableTrait;
    use Core\TimestampableTrait;
    use Core\TaggedEntityTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var boolean
     */
    protected $enabled;


    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->seo = new Seo();
        $this->contents = new ArrayCollection();
    }

    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
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
    public function setName($name)
    {
        $this->translate()->setName($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->translate()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->translate()->setSlug($slug);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->translate()->getSlug();
    }

    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrentLocale($currentLocale)
    {
        $this->seo->setCurrentLocale($currentLocale);

        return parent::setCurrentLocale($currentLocale);
    }

    /**
     * {@inheritdoc}
     */
    public function setFallbackLocale($fallbackLocale)
    {
        $this->seo->setFallbackLocale($fallbackLocale);

        return parent::setFallbackLocale($fallbackLocale);
    }

    /**
     * {@inheritdoc}
     */
    /*protected function getTranslationClass()
    {
        return get_class($this).'Translation';
    }*/

    /**
     * {@inheritdoc}
     */
    public function getEntityTags()
    {
        return array($this->getEntityTag(), Post::getEntityTagPrefix());
    }

    /**
     * {@inheritdoc}
     */
    public static function getEntityTagPrefix()
    {
        return 'ekyna_blog.category';
    }
}
