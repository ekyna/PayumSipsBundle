<?php

namespace Ekyna\Bundle\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Bundle\MediaBundle\Model\MediaTypes;

/**
 * Class LoadCategoryData
 * @package Ekyna\Bundle\DemoBundle\DataFixtures\ORM
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadCategoryData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $om)
    {
        $repo = $this->container->get('ekyna_demo.category.repository');
        $seoRepo = $this->container->get('ekyna_cms.seo.repository');

        for ($c = 1; $c < 6; $c++) {
            /** @var \Ekyna\Bundle\DemoBundle\Entity\Category $category */
            $category = $repo->createNew();
            $category
                ->setColor('#ffffff')
                ->setName('Category #' . $c)
                ->setHtml('<p>' . implode('</p><p>', $this->faker->paragraphs(rand(2,3))) . '</p>')
                ->setMedia($this->getRandomMedia(MediaTypes::IMAGE))
            ;

            $seo = $seoRepo->createNew();
            $seo
                ->setTitle('Category #' . $c . ' title')
                ->setDescription('Category #' . $c . ' description')
            ;

            $om->persist($category);
        }
        $om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 90;
    }
}