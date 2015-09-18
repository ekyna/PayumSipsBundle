<?php

namespace Ekyna\Bundle\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Bundle\DemoBundle\Entity\SmartphoneImage;
use Ekyna\Bundle\MediaBundle\Model\MediaTypes;
use Ekyna\Component\Sale\Product\ProductTypes;

/**
 * Class LoadSmartphoneData
 * @package Ekyna\Bundle\DemoBundle\DataFixtures\ORM
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadSmartphoneData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $om)
    {
        $repo = $this->container->get('ekyna_demo.smartphone.repository');
        $brandRepo = $this->container->get('ekyna_demo.brand.repository');
        $categoryRepo = $this->container->get('ekyna_demo.category.repository');
        $taxRepo = $this->container->get('ekyna_order.tax.repository');
        $seoRepo = $this->container->get('ekyna_cms.seo.repository');

        for ($s = 1; $s < 18; $s++) {

            /** @var \Ekyna\Bundle\DemoBundle\Entity\Brand $brand */
            $brand = $brandRepo->findRandomOneBy([]);

            /** @var \Ekyna\Bundle\DemoBundle\Entity\Category $category */
            $category = $categoryRepo->findRandomOneBy([]);

            /** @var \Ekyna\Bundle\OrderBundle\Entity\Tax $tax */
            $tax = $taxRepo->findRandomOneBy([]);

            /** @var \Ekyna\Bundle\DemoBundle\Entity\Smartphone $smartphone */
            $smartphone = $repo->createNew();
            $smartphone
                ->setName('Smartphone #' . $s)
                ->setBrand($brand)
                ->setCategory($category)
                ->setHtml('<p>' . implode('</p><p>', $this->faker->paragraphs(rand(2,3))) . '</p>')
                ->setDesignation($this->faker->sentence())
                ->setReference($this->faker->bothify('????####'))
                ->setPrice(400)
                ->setWeight(400)
                ->setReleasedAt(new \DateTime())
                ->setTax($tax)
                ->setType(ProductTypes::PHYSICAL)
            ;

            for ($i = 0; $i < rand(2,5); $i++) {
                $image = new SmartphoneImage();
                $image->setMedia($this->getRandomMedia(MediaTypes::IMAGE));
                $smartphone->addImage($image);
            }

            $seo = $seoRepo->createNew();
            $seo
                ->setTitle('Smartphone #' . $s . ' title')
                ->setDescription('Smartphone #' . $s . ' description')
            ;

            $om->persist($smartphone);
        }
        $om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 91;
    }
}