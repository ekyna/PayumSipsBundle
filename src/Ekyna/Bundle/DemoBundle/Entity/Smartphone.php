<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\CoreBundle\Model as Core;
use Ekyna\Bundle\MediaBundle\Model as Media;
use Ekyna\Bundle\ProductBundle\Entity\AbstractProduct;

/**
 * Class Smartphone
 * @package Ekyna\Bundle\DemoBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Smartphone
    extends AbstractProduct
    implements Cms\ContentSubjectInterface,
        Cms\SeoSubjectInterface,
        Cms\TagsSubjectInterface,
        Core\TaggedEntityInterface
{
    use Cms\ContentSubjectTrait,
        Cms\SeoSubjectTrait,
        Cms\TagsSubjectTrait,
        Core\TaggedEntityTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Brand
     */
    protected $brand;

    /**
     * @var string
     */
    protected $html;

    /**
     * @var ArrayCollection|SmartphoneImage[]
     */
    protected $images;

    /**
     * @var Media\MediaInterface
     */
    protected $document;

    /**
     * @var \DateTime
     */
    protected $releasedAt;

    /**
     * @var ArrayCollection|SmartphoneVariant[]
     */
    protected $variants;

    /**
     * @var SmartphoneCharacteristics
     */
    protected $characteristics;


    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->contents = new ArrayCollection();
        $this->variants = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->seo = new Seo();
        $this->setCharacteristics(new SmartphoneCharacteristics());
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Smartphone
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the category.
     *
     * @param Category $category
     * 
     * @return Smartphone
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Returns the category.
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the brand.
     *
     * @param Brand $brand
     *
     * @return Smartphone
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Returns the brand.
     *
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return Smartphone
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set releasedAt
     *
     * @param \DateTime $releasedAt
     * @return Smartphone
     */
    public function setReleasedAt(\DateTime $releasedAt = null)
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    /**
     * Get releasedAt
     *
     * @return \DateTime 
     */
    public function getReleasedAt()
    {
        return $this->releasedAt;
    }

    /**
     * Sets the variants.
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $variants
     * @return Smartphone
     */
    public function setVariants($variants)
    {
        foreach($variants as $variant) {
            $variant->setSmartphone($this);
        }
        $this->variants = $variants;

        return $this;
    }

    /**
     * Adds a variant.
     * @param SmartphoneVariant $variant
     * @return Smartphone
     */
    public function addVariant(SmartphoneVariant $variant)
    {
        if (!$this->variants->contains($variant)) {
            $variant->setSmartphone($this);
            $this->variants->add($variant);
        }

        return $this;
    }

    /**
     * Removes a variant.
     *
     * @param SmartphoneVariant $variant
     * @return Smartphone
     */
    public function removeVariant(SmartphoneVariant $variant)
    {
        if ($this->variants->contains($variant)) {
            $this->variants->removeElement($variant);
        }

        return $this;
    }

    /**
     * Returns the variants.
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * Sets the images.
     *
     * @param SmartphoneImage[] $images
     * @return Smartphone
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasImage(SmartphoneImage $image)
    {
        return $this->images->contains($image);
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(SmartphoneImage $image)
    {
        if (!$this->hasImage($image)) {
            $image->setSmartphone($this);
            $this->images->add($image);
            $this->setUpdatedAt(new \DateTime());
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(SmartphoneImage $image)
    {
        if ($this->hasImage($image)) {
            $image->setSmartphone(null);
            $this->images->removeElement($image);
            $this->setUpdatedAt(new \DateTime());
        }
        return $this;
    }
    
    /**
     * Returns the images.
     *
     * @return SmartphoneImage[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the document.
     *
     * @param Media\MediaInterface $document
     * @return Smartphone
     */
    public function setDocument(Media\MediaInterface $document = null)
    {
        $this->document = $document;
        return $this;
    }

    /**
     * Returns the document.
     *
     * @return Media\MediaInterface
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param SmartphoneCharacteristics $characteristics
     * @return Smartphone
     */
    public function setCharacteristics(SmartphoneCharacteristics $characteristics)
    {
        $characteristics->setSmartphone($this);
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * @return SmartphoneCharacteristics
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityTags()
    {
        $tags = [$this->getEntityTag()];
        /*if (null !== $this->images) {

        }*/
        if (null !== $this->seo) {
            $tags[] = $this->seo->getEntityTag();
        }
        // TODO Brand, Characteristics, Variants ...
        return $tags;
    }

    /**
     * @return mixed
     */
    public static function getEntityTagPrefix()
    {
        return 'ekyna_demo.product';
    }
}
