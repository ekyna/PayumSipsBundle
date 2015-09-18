<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\CmsBundle\Model\ContentSubjectInterface;
use Ekyna\Bundle\CmsBundle\Model\ContentSubjectTrait;
use Ekyna\Bundle\CmsBundle\Model\SeoSubjectInterface;
use Ekyna\Bundle\CmsBundle\Model\SeoSubjectTrait;

/**
 * Brand
 */
class Brand implements ContentSubjectInterface, SeoSubjectInterface
{
    use ContentSubjectTrait;
    use SeoSubjectTrait;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var BrandImage
     */
    private $image;


    public function __construct()
    {
        $this->seo = new Seo();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Brand
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the image.
     *
     * @param BrandImage $image
     * @return Brand
     */
    public function setImage(BrandImage $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Returns the image.
     *
     * @return BrandImage
     */
    public function getImage()
    {
        return $this->image;
    }
}
